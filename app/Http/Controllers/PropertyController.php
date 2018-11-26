<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Repositories\ProjectSaleRepository;
use App\Repositories\PropertyRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MongoDB\BSON\ObjectId;
use App\Repositories\CategoryRepository;

class PropertyController extends Controller
{
    const TITLE = 'chi tiết dự án';
    const URL_HOME = 'properties';
    const  VIEW = 'property';
    private $repository;
    private $projectSaleRepository;
    private $categoryRepository;

    public function __construct(PropertyRepository $repository, ProjectSaleRepository $projectSaleRepository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->projectSaleRepository = $projectSaleRepository;
        $this->categoryRepository = $categoryRepository;
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
            if (!empty($req['start_date'])) {
                $req['start_date'] = $this->convertDateISO($req['start_date']);
            }
            if (!empty($req['end_date'])) {
                $req['end_date'] = $this->convertDateISO($req['end_date']);
            }

            $req['files'] = json_decode($req['files']);
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            if (!empty($req['price'])) {
                $req['price'] = (int)str_replace(',', '', $req['price']);
            }
            if (!empty($req['price_sale'])) {
                $req['price_sale'] = (int)str_replace(',', '', $req['price_sale']);
            }
            $this->dataNormalization(Property::SCHEMAS(),$req);

            $this->repository->create($req);
            $request->session()->flash('success', 'Tạo mới ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }
        $project_sale = $this->projectSaleRepository->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $categories = $this->categoryRepository->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME, 1);
        return view(self::VIEW . '.add', [
            'project_sale' => $project_sale,
            'categories' => $categories,
            'page_title' => $titleBreadCrumb['page_title'],
            'breadcrumb' => $titleBreadCrumb['breadcrumb']
        ]);
    }

    public function edit(string $id, Request $request)
    {
        $findId = $this->repository->findById($id);
        if (empty($findId)) {
            $request->session()->flash('error', $id . ' không tồn tại');
            return redirect()->route(self::URL_HOME);
        }
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb(self::TITLE, self::URL_HOME, 2);
        $project_sale = $this->projectSaleRepository->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        $categories = $this->categoryRepository->where(['lang_code' => app()->getLocale(), 'status' => STATUS_ACTIVE])->get();
        if ($request->isMethod('POST')) {
            $req = $request->request->all();
            if (!empty($req['start_date'])) {
                $req['start_date'] = $this->convertDateISO($req['start_date']);
            }
            if (!empty($req['end_date'])) {
                $req['end_date'] = $this->convertDateISO($req['end_date']);
            }

            $req['files'] = json_decode($req['files']);
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            if (!empty($req['price'])) {
                $req['price'] = (int)str_replace(',', '', $req['price']);
            }
            if (!empty($req['price_sale'])) {
                $req['price_sale'] = (int)str_replace(',', '', $req['price_sale']);
            }

            $this->dataNormalization(Property::SCHEMAS(),$req);

//            dump($req);die;
            $this->repository->update($req, $id);

            $request->session()->flash('success', 'cập nhật ' . self::TITLE . ' thành công');
            return redirect()->route(self::URL_HOME);
        }

        return view(self::VIEW . '.add', [
            'data' => $findId,
            'project_sale' => $project_sale,
            'categories' => $categories,
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
            $arr['categories'] = $v->categories;
            $arr['project_sales'] = $v->project_sales;
            $arr['lang_code'] = $v->lang_code;
            $arr['weight'] = $v->weight;
            $arr['status'] = $v->status;
            $arr['name'] = $v->name;
            $arr['name_ascii'] = $v->name_ascii;
            $arr['url_alias'] = $v->url_alias;
            $arr['short_description'] = $v->short_description;
            $arr['description'] = $v->description;
            $arr['priority'] = $v->priority;
            $arr['meta_title'] = $v->meta_title;
            $arr['meta_description'] = $v->meta_description;
            $arr['meta_keyword'] = $v->meta_keyword;
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
            foreach ($find as $val) {
                $district = $val->district;
            }
            return new Response(json_encode($district));
        }
        return new Response(false);
    }
}
