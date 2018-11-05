<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Facade;

class AppClass
{

    public function checkLangExist($data = array())
    {
        $isExist = false;
        foreach (LANGUAGE as $k => $val) {
            if (array_key_exists($k, $data)) {
                $isExist = true;
                break;
            }
        }
        return $isExist;
    }

    public function pageTitleAndBreadCrumb($title,$urlHome,$checkShow = 0){
        $data = array();
        if ($checkShow == 0){
            $data['page_title'] = "Thêm mới ".$title;
            $data['breadcrumb'] = [
                array(
                    'url' => $urlHome,
                    'label' => 'Danh sách '.$title,
                ),
                array(
                    'url' => '#',
                    'label' => 'Thêm mới Slider',
                )
            ];
        }elseif($checkShow == 1){
            $data['page_title'] = "Cập nhật ".$title;
            $data['breadcrumb'] = [
                array(
                    'url' => $urlHome,
                    'label' => 'Danh sách '.$title,
                ),
                array(
                    'url' => '#',
                    'label' => 'Cập nhật '. $title,
                )
            ];
        }
        return $data;
    }
}
