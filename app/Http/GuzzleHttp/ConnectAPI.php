<?php

namespace App\GuzzleHttp;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Filesystem\Filesystem;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConnectAPI
{
    protected $uri;
    protected $method;
    protected $langCode;
    protected $client;
    protected $session;
    protected $logger;
    protected $cachePath;
    protected $fs;
    protected $rawBody;

    const METHOD = 'POST';
    const LANG_CODE = 'vi';
    const SESSION_CACHE = 'session';
    const FILE_CACHE = 'file';
    const DEFAULT_TTL = 60;
    const CACHE_DIR = 'bds_backend';
    const TOKEN_KEY = 'bds_token';
    const TOKEN_HEADER_KEY = 'BDS-TOKEN';
    const EXPIRED_TOKEN_ERROR_CODE = 'TOKEN_INVALID';


    protected $options = [
        'set_token' => 1,
        'refresh_token' => 0,
    ];

    public function __construct(
        array $options,
        $uri,
        $method,
        $langCode,
        SessionInterface $session,
        LoggerInterface $logger,
        Filesystem $fs,
        $cacheDir
    )
    {
        $client = new Client(['base_uri' => getenv('BASE_URL')]);
        $this->client = $client;
        $this->options = $options;
        $this->uri = $uri;
        $this->method = $method ?? self::METHOD;
        $this->langCode = $langCode ?? self::LANG_CODE;
//        $this->client = $client;
        $this->session = $session;
        $this->logger = $logger;
        $this->fs = $fs;
        $this->cachePath = $cacheDir . DIRECTORY_SEPARATOR . self::CACHE_DIR;

    }

    public function request($data = null, $options = [])
    {
        $this->options = array_merge($this->options, $options);

        if (empty($this->options['cache'])) {
            return $this->makeRequest($data);
        }

        $cacheKey = $this->makeCacheKey($data);
        if ($this->options['cache'] == self::SESSION_CACHE) {

            if (!$this->session->get($cacheKey)) {
                $this->logger->info(sprintf('SET_SESSION_CACHE: %s Set data to session cache from api', $this->uri), [
                    'http_method' => $this->method,
                    'uri' => $this->uri,
                    'cache_key' => $cacheKey,
                ]);

                $data = $this->makeRequest($data);
                $this->session->set($cacheKey, $data);
            }

            $this->logger->info(sprintf('GET_SESSION_CACHE: %s Get data from session cache', $this->uri), [
                'cache_key' => $cacheKey,
                'data' => $this->castStdClassToArray($this->session->get($cacheKey)),
                'uri' => $this->uri,
            ]);

            return $this->session->get($cacheKey);
        }

        if ($this->options['cache'] == self::FILE_CACHE) {
            $ttl = isset($this->options['ttl']) ? $this->options['ttl'] : self::DEFAULT_TTL;
            $cacheFile = $this->cachePath . DIRECTORY_SEPARATOR . $cacheKey;
            if (file_exists($cacheFile)) {
                $lastModified = filemtime($cacheFile);
                if ($lastModified + $ttl < time()) {
                    unlink($cacheFile);
                    $this->writeCacheFile($cacheFile, $data);
                }
            } else {
                $this->writeCacheFile($cacheFile, $data);
            }

            $cacheData = $this->readCacheFile($cacheFile);

            $this->logger->info(sprintf('GET_FILE_CACHE: %s Get data from file cache', $this->uri), [
                'cache_file' => $cacheFile,
                'data' => $this->castStdClassToArray($cacheData),
                'uri' => $this->uri,
            ]);

            return $cacheData;
        }
        return $this->makeRequest($data);
    }

    public function getRawBody()
    {
        return $this->rawBody;
    }

    public function getDecodedBody()
    {
        return json_decode($this->rawBody);
    }

    protected function readCacheFile($cacheFile)
    {
        $cacheContent = file_get_contents($cacheFile);
        $data = json_decode($cacheContent);

        return $data;
    }

    protected function writeCacheFile($cacheFile, $data)
    {
        $this->logger->info(sprintf('SET_FILE_CACHE: %s Set data to file cache from api', $this->uri), [
            'cache_file' => $cacheFile,
            'uri' => $this->uri,
        ]);

        $data = $this->makeRequest($data);
        $this->fs->mkdir(dirname($cacheFile));
        file_put_contents($cacheFile, json_encode($data));
    }

    protected function makeRequest($data)
    {
        $requestData = $this->formatRequestData($data);
        if (!empty($this->options['set_token'])) {
            $requestData = $this->setTokenHeader($requestData);
        }

        $this->logger->info(sprintf('BDS_BACKEND_REQUEST: %s Make bds api request', $this->uri), [
            'http_method' => $this->method,
            'uri' => $this->uri,
            'data' => $requestData,
        ]);
        $res = $this->client->request($this->method, $this->uri, $requestData);

        $data = $this->getData($res);

        if (!empty($this->options['refresh_token'])) {
            $this->refreshToken($data);
        }

        return $data;
    }

    protected function makeCacheKey($data)
    {
        return empty($data) ?
            hash('sha256', $this->uri) : hash('sha256', $this->uri . serialize($data));
    }

    protected function getData(Response $res)
    {
        $this->rawBody = $res->getBody()->getContents();

        $exception = !empty($this->options['exception']) ? 1 : 0;

        $bodyDecoded = json_decode($res->getBody());

        if (empty($bodyDecoded) || $bodyDecoded->success === false) {
            $this->logger->error(sprintf('BDS_BACKEND_RESPONSE_ERROR: %s Have error when make bds api request', $this->uri), [
                'raw' => $this->rawBody,
                'uri' => $this->uri,
            ]);

            if ($exception) {
                throw new NotFoundHttpException(
                    sprintf('Invalid BDS BACKEND api response, uri="%s".', $this->uri));
            }

            if (!empty($bodyDecoded->errorCode) && $bodyDecoded->errorCode === self::EXPIRED_TOKEN_ERROR_CODE) {
                throw new AuthenticationException();
            }

            return null;
        }

        $this->logger->info(sprintf('BDS_BACKEND_RESPONSE: %s Get response from BDS api request', $this->uri), [
            'data' => !empty($bodyDecoded->data) ? $this->castStdClassToArray($bodyDecoded->data) : null,
            'raw' => $this->rawBody,
            'uri' => $this->uri,
        ]);

        return !empty($bodyDecoded->data) ? $bodyDecoded->data : null;
    }

    protected function castStdClassToArray($stdClass)
    {
        return json_decode(json_encode($stdClass), true);
    }

    protected function formatRequestData($data)
    {
        $query = [];
        if (!empty($data['query'])) {
            $query = $data['query'];
            unset($data['query']);
        }

        $formatRequestData = [
            'json' => $data,
            'query' => $query,
        ];

        return $formatRequestData;
    }


    protected function refreshToken($data)
    {
        if (empty($data->token)) {
            throw new AuthenticationException(sprintf('Cant refresh token because bds api response has not token.'));
        }

        return $this->saveToken($data->token);
    }

    protected function setTokenHeader($data)
    {
        $token = $this->token();
        $data['headers'][self::TOKEN_HEADER_KEY] = $token;

        return $data;
    }

    public function token()
    {
        return $this->session->get(self::TOKEN_KEY);
    }

    public function saveToken($token)
    {
        return $this->session->set(self::TOKEN_KEY, $token);
    }
    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

}
