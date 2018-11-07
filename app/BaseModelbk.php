<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;

class BaseModelbk extends EloquentModel
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // do stuff
            $model->formatDataForSchema($model->customSchema, $model->attributes, $model->asciiFields);
        });

        static::updating(function ($model) {
            // do stuff
        });
    }

    //format data theo schema
    public function formatDataForSchema($schema = array(), &$dataReq = array(), $asciiFields = array())
    {
        // chuẩn hóa dữ liệu
        $dataReq = $this->_dataNormalization($schema, $dataReq, $asciiFields);
        foreach ($dataReq as $key => $val) {
            // nếu không giống schema thì xóa luôn hỏi nhiều.
            if (!array_key_exists($key, $schema)) {
                $isExisted = false;
                if (!empty(LANGUAGE)) {
                    foreach (LANGUAGE as $k => $lang) {
                        if ($key == $k) {
                            $isExisted = true;
                            break;
                        }
                    }
                }
                if (!$isExisted) {
                    unset($dataReq[$key]);
                }
            }
        }

        return $dataReq;
    }

    /**
     * convert_vi_to_en method
     * hàm chuyền đổi tiếng việt có dấu sang tiếng việt không dấu
     * @param string $str
     * @return string
     */
    public function convert_vi_to_en($str)
    {

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ|Ð)/", 'D', $str);

        return $str;
    }

    /**
     * Chuẩn hóa dữ liệu
     * @param array $schema
     * @param array $dataReq
     * @param  array $asciiField
     * @return mixed
     */
    private function _dataNormalization($schema = array(), &$dataReq = array(), $asciiField = array())
    {
        foreach ($schema as $key => $value) {
            $datatype = gettype($value);
            switch ($datatype) {
                case "integer":
                    if (empty($dataReq[$key])) {
                        $dataReq[$key] = $value;
                    } else {
                        $dataReq[$key] = (int)$dataReq[$key];
                    }

                    break;
                case "double":
                    if (empty($dataReq[$key])) {
                        $dataReq[$key] = $value;
                    } else {
                        $dataReq[$key] = (double)$dataReq[$key];
                    }
                    break;
                case "string" :
                    if (empty($dataReq[$key])) {
                        $dataReq[$key] = '';
                    } else if ($key != "password") {

//                            	$dataReq[$key] = trim($dataReq[$key]);
                        $dataReq[$key] = $dataReq[$key];

                    }
                    break;

                case "array" ://Cấp 2
                    if ($key == "data_locale") {
                        if (!empty(LANGUAGE)) {
                            foreach (LANGUAGE as $k => $lang) {
                                if (empty($dataReq[$k])) {
                                    continue;
                                }
                                $this->_dataNormalization($value, $dataReq[$k]);
                                $this->convertToAscii($dataReq[$k], $asciiField);
                            }
                        }
                    } else {
                        $this->_dataNormalization($schema[$key], $dataReq[$key]);
                        $this->_dataNormalization($value, $dataReq[$key]);

                    }
                    break;

                default:
                    if (empty($dataReq[$key])) {
                        $dataReq[$key] = $value;
                    }
                    break;
            }
        }
        return $dataReq;
    }


    private function convertToAscii(&$data = array(), $asciiField = array())
    {

        foreach ($asciiField as $val) {
            if (array_key_exists($val, $data)) {
                $data[$val . '_ascii'] = $this->convert_vi_to_en($data[$val]);
            }
        }
    }
}
