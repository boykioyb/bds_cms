<?php

namespace App\Models;

use App\BaseModel;

class Category extends BaseModel
{
    public $collection = 'categories';
    protected $guarded = [];

    public static function SCHEMAS()
    {
        return [
            'code' => ['type' => 'string', 'default' => null],
            'lang_code' => ['type' => 'string', 'default' => null],
            'name' => ['type' => 'string', 'default' => null],
            'name_ascii' => ['type' => 'string', 'default' => null],
            'url_alias' => ['type' => 'string', 'default' => null],
            'description' => ['type' => 'string', 'default' => null],
            'weight' => ['type' => 'int', 'default' => null],
            'status' => ['type' => 'int', 'default' => 0],
            'owner' => ['type' => 'string', 'default' => null],
        ];
    }

}
