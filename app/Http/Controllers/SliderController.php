<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SliderController extends Controller
{
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function index()
    {
        $breadcrumb = [
            array(
                'url' => 'sliders',
                'label' => 'Danh sách Slider',
            ),
        ];
        return view('slider.index', compact('breadcrumb'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod("POST")) {
            $req = $request->request->all();
            $req['files'] = json_decode($req['files']);
            $req['name_ascii'] = $this->convert_vi_to_en($req['name']);
            $req['res'] = ';da';
            $this->sliderRepository->create($req);
            $request->session()->flash('success', 'Tạo mới slider thành công');
            return redirect()->route('sliders');
        }
        /**Thêm cấu hình trang**/
        $page_title = "Thêm mới Slider";
        $breadcrumb = [
            array(
                'url' => "/sliders",
                'label' => 'Danh sách Slider',
            ),
            array(
                'url' => '#',
                'label' => 'Thêm mới Slider',
            )
        ];
        /**end cấu hình trang**/

        return view('slider.add', compact(
            'breadcrumb',
            'page_title'
        ));
    }

    public function edit($id, Request $request)
    {
        $findId = $this->sliderRepository->findById($id);
        if (empty($findId)) {
            $request->session()->flash('error', $id . ' không tồn tại');
            return redirect()->route('sliders');
        }
        $titleBreadCrumb = \AppClass::pageTitleAndBreadCrumb('Slider', 'sliders', 1);
//        $decode = json_decode($findId);
        return view('slider.add', [
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

        $dataJson = $this->sliderRepository->paginate($options,null,$page,$limit);
        $dataJson =$this->formatData($dataJson);
        $total = $this->sliderRepository->findAll()->count();


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
            $arr['code'] = $v->code;
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
