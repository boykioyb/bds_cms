<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // do stuff
            $model->formatDataForSchema($model->customSchema,$model->attributes,$model->asciiFields);

        });

        static::updating(function ($model) {
            // do stuff
        });
    }

    //format data theo schema
    public function formatDataForSchema($schema = array(), &$dataReq = array(), $asciiFields = array())
    {
        // chuẩn hóa dữ liệu
        $dataReq = $this->_dataNormalization($schema, $dataReq);
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
     * Chuẩn hóa dữ liệu
     * @param array $schema
     * @param array $dataReq
     * @return mixed
     */
    private function _dataNormalization($schema = array(), $dataReq = array())
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
                                if (empty($dataReq[$lang])) {
                                    continue;
                                }
                                $this->_dataNormalization($value, $dataReq[$lang]);
                            }
                        }
                    } else {
                        $this->_dataNormalization($schema[$key], $dataReq[$key]);
                    }
                    break;  //END Cấp 2

                default:
                    if (empty($dataReq[$key])) {
                        $dataReq[$key] = $value;
                    }
                    break;
            }
        }
        return $dataReq;
    }
}
