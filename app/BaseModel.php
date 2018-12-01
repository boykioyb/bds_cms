<?php

namespace App;

use Suren\LaravelMongoModelSchema\MongoModel;

class BaseModel extends MongoModel
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->_dataNormalization($model::SCHEMAS(), $model->attributes);
        });

        static::updating(function ($model) {
            $model->_dataNormalization($model::SCHEMAS(), $model->attributes);
        });
    }

    public function _dataNormalization($schema, &$option)
    {
        foreach ($schema as $k => $val) {
            switch ($val['type']) {
                case 'int';
                    if ($option[$k] != '') {
                        $option[$k] = (int)$option[$k];
                    }
                    break;
                case "MongoDB\BSON\ObjectId";
                    if (!empty($option[$k])) {
                        $option[$k] = new ObjectId($option[$k]);
                    }
                    break;
            }
        }
    }
}
