<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Repositories\InvestorRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvestorController extends Controller
{
    const TITLE = 'nhà đầu tư';
    const URL_HOME = 'investors';
    const  VIEW = 'investor';
    private $repository;

    public function __construct(InvestorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME);
        return view(self::VIEW . '.index', [
            'page_title' => $titleBreadCrumb['page_title'],
            'breadcrumb' => $titleBreadCrumb['breadcrumb']
        ]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod("POST")) {

            $req = $request->request->all();
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            $this->dataNormalization(Investor::SCHEMAS(), $req);

            $this->repository->create($req);
            $request->session()->flash('success', 'Tạo mới ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }

        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME, 1);

        return view(self::VIEW . '.add', [
            'page_title' => $titleBreadCrumb['page_title'],
            'breadcrumb' => $titleBreadCrumb['breadcrumb']
        ]);
    }

    public function edit($id, Request $request)
    {
        $findId = $this->repository->findById($id);
        if (empty($findId)) {
            $request->session()->flash('error', $id . ' không tồn tại');
            return redirect()->route(self::URL_HOME);
        }
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME, 2);
//        $decode = json_decode($findId);

        if ($request->isMethod('POST')) {
            $req = $request->request->all();
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
//            dump($req);die;
            $this->dataNormalization(Investor::SCHEMAS(), $req);

            $this->repository->update($req, $id);
            $request->session()->flash('success', 'cập nhật ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }
        return view(self::VIEW . '.add', [
            'data' => $findId,
            'lang_code' => LANGUAGE,
            'page_title' => $titleBreadCrumb['page_title'],
            'breadcrumb' => $titleBreadCrumb['breadcrumb']
        ]);
    }

    public function dataTable()
    {
        $options = $this->searchOption($_REQUEST['columns']);

        $page = (int)$_REQUEST['start'];
        $limit = (int)$_REQUEST['length'];

        $dataJson = $this->repository->paginate($options, null, $page, $limit);
        $dataJson = $this->formatData($dataJson);
        if (empty($options)) {
            $total = $this->repository->findAll()->count();
        } else {
            $total = count($dataJson);
        }


        $secho = 0;
        if (isset($_REQUEST['sEcho'])) {
            $secho = intval($_REQUEST['sEcho']);
        }

        $result = [
            'iTotalRecords' => $total,
            'page' => $page,
            'limit' => $limit,
            'iTotalDisplayRecords' => $total,
            'sEcho' => $secho,
            'sColumns' => '',
            'aaData' => $dataJson,
        ];

        return new Response(json_encode($result, JSON_PRETTY_PRINT));
    }

    private function formatData($data = array())
    {
        if (empty($data)) {
            return null;
        }
        $result = array();
        foreach ($data as $k => $v) {
            $arr['_id'] = $v->_id;
            $arr['phone'] = $v->phone;
            $arr['address'] = $v->address;
            $arr['lang_code'] = $v->lang_code;
            $arr['name'] = $v->name;
            $arr['name_ascii'] = $v->name_ascii;
            $arr['url_alias'] = $v->url_alias;
            $arr['description'] = $v->description;
            $arr['weight'] = $v->weight;
            $arr['status'] = $v->status;
            $arr['files'] = json_encode($v->files);
            $arr['created_at'] = Carbon::parse($v->created_at)->format('d-m-Y');
            $arr['updated_at'] = Carbon::parse($v->updated_at)->format('d-m-Y');
            $result[] = $arr;
        }
        return $result;
    }

}
