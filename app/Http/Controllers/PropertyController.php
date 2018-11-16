<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectSaleRepository;
use App\Repositories\PropertyRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MongoDB\BSON\ObjectId;

class PropertyController extends Controller
{
    const TITLE = 'chi tiết dự án';
    const URL_HOME = 'properties';
    const  VIEW = 'property';
    private $repository;
    private $projectSaleRepository;

    public function __construct(PropertyRepository $repository,ProjectSaleRepository $projectSaleRepository)
    {
        $this->repository = $repository;
        $this->projectSaleRepository = $projectSaleRepository;
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
            $req['files'] = json_decode($req['files']);
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            $this->repository->create($req);
            $request->session()->flash('success', 'Tạo mới ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }
        $project_sale = $this->projectSaleRepository->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME, 1);
        return view(self::VIEW . '.add', [
            'project_sale' => $project_sale,
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
        $investors = $this->investor->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $city = $this->city->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $findDistrict = $this->city->where(['name' => $findId->city])->first();

        if ($request->isMethod('POST')) {
            $req = $request->request->all();
            $req['investor'] = new ObjectId($req['investor']);
            $req['files'] = json_decode($req['files']);
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            $this->repository->update($req, $id);
            $request->session()->flash('success', 'cập nhật ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }
        return view(self::VIEW . '.add', [
            'data' => $findId,
            'investors' => $investors,
            'city' => $city,
            'district' => $findDistrict->district,
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
            $arr['lang_code'] = $v->lang_code;
            $arr['weight'] = $v->weight;
            $arr['status'] = $v->status;
            $arr['name'] = $v->name;
            $arr['name_ascii'] = $v->name_ascii;
            $arr['url_alias'] = $v->url_alias;
            $arr['short_description'] = $v->short_description;
            $arr['description'] = $v->description;
            $arr['city'] = $v->city;
            $arr['district'] = $v->district;
            $arr['address'] = $v->address;
            $arr['type'] = $v->type;
            $arr['scale'] = $v->scale;
            $arr['functional'] = $v->functional;
            $arr['design_consultancy'] = $v->design_consultancy;
            $arr['pm_mc'] = $v->pm_mc;
            $arr['priority'] = $v->priority;
            $arr['area'] = $v->area;
            $arr['meta_title'] = $v->meta_title;
            $arr['meta_description'] = $v->meta_description;
            $arr['meta_keyword'] = $v->meta_keyword;
            $arr['land_area_of_study'] = $v->land_area_of_study;
            $arr['construction_land_area'] = $v->construction_land_area;
            $arr['construction_density'] = $v->construction_density;
            $arr['tags'] = json_encode($v->tags);
            $arr['files'] = json_encode($v->files);
            $arr['created_at'] = Carbon::parse($v->created_at)->format('d-m-Y');
            $arr['updated_at'] = Carbon::parse($v->updated_at)->format('d-m-Y');
            $result[] = $arr;
        }
        return $result;
    }

    public function getDistrict(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->request->get('name');
            $find = $this->city->where(['name' => $name])->get();
            $district = array();
            foreach ($find as $val){
                $district = $val->district;
            }
            return new Response(json_encode($district));
        }
        return new Response(false);
    }
}
