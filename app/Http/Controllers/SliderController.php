<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{

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

    public function add()
    {
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
        if (empty($lang)){
            $lang = config('app.locale');
        }

        return view('slider.lang',compact('lang','STATUS'));
    }
}
