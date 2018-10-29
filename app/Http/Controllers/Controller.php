<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function makeRequest($uri = "/",$option = [],$method = "POST"){
        $client = new Client(['base_uri' => getenv('BASE_URL')]);
        $request = $client->request($method,$uri,$option);
        return json_decode($request->getBody());
    }

}
