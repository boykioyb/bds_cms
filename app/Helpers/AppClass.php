<?php


namespace App\Helpers;
class AppClass
{

    public function checkLangExist($repository, $lang = null, $name_ascii = "")
    {
        $find = $repository->where('lang', $lang)->where('name_ascii', $name_ascii);
        dump($find);
        die;
    }

    public function pageTitleAndBreadCrumb($title, $urlHome, $checkShow = 0)
    {
        $data = array();
        switch ($checkShow) {
            case 0:
                $data['page_title'] = "Danh sách " . $title;
                $data['breadcrumb'] = [
                    array(
                        'url' => $urlHome,
                        'label' => 'Danh sách ' . $title,
                    )
                ];
                break;
            case 1:
                $data['page_title'] = "Thêm mới " . $title;
                $data['breadcrumb'] = [
                    array(
                        'url' => $urlHome,
                        'label' => 'Danh sách ' . $title,
                    ),
                    array(
                        'url' => '#',
                        'label' => 'Thêm mới '. $title,
                    )
                ];
                break;
            case 2:
                $data['page_title'] = "Cập nhật " . $title;
                $data['breadcrumb'] = [
                    array(
                        'url' => $urlHome,
                        'label' => 'Danh sách ' . $title,
                    ),
                    array(
                        'url' => '#',
                        'label' => 'Cập nhật ' . $title,
                    )
                ];
                break;
            case 3:
                $data['page_title'] = "Chi Tiết " . $title;
                $data['breadcrumb'] = [
                    array(
                        'url' => $urlHome,
                        'label' => 'Danh sách ' . $title,
                    ),
                    array(
                        'url' => '#',
                        'label' => 'Chi tiết ' . $title,
                    )
                ];
                break;
            default:
                $data['page_title'] = "Danh sách " . $title;
                $data['breadcrumb'] = [
                    array(
                        'url' => $urlHome,
                        'label' => 'Danh sách ' . $title,
                    )
                ];
                break;
        }

        return $data;
    }
}
