<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

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
            dump($req);die;
            if (!\AppClass::checkLangExist($req['data'])) {
                $request->session()->flash('error', 'Hãy chọn ngôn ngữ');
                return redirect()->route('sliders.add');
            }
            $this->sliderRepository->create($req['data']);
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

    public function addLang(Request $request)
    {
        $lang = $request->request->get('lang_code');
        if (empty($lang)) {
            $lang = config('app.locale');
        }


        return view( 'slider.lang', compact('lang', 'STATUS'));
    }

    public function edit($id,Request $request)
    {
        $findId = $this->sliderRepository->findById($id);
        if (empty($findId)){
            $request->session()->flash('error',$id. ' không tồn tại');
            return redirect()->route('sliders');
        }
        $titleBreadCrumb  = \AppClass::pageTitleAndBreadCrumb('Slider','sliders',1);
//        $decode = json_decode($findId);
        return view('slider.add',[
            'data' => $findId,
            'lang_code' => LANGUAGE,
            'page_title' => $titleBreadCrumb['page_title'],
            'breadcrumb' => $titleBreadCrumb['breadcrumb']
        ]);
    }
}
