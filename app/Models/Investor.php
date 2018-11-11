<?php

namespace App\Models;

use App\BaseModel;

class Investor extends BaseModel
{
    public $collection = 'investors';
    protected $guarded = [];
    public static function SCHEMAS()
    {
        return [
            'lang_code' => ['type' => 'string', 'default' => null],
            'name' => ['type' => 'string', 'default' => null],
            'name_ascii' => ['type' => 'string', 'default' => null],
            'url_alias' => ['type' => 'string', 'default' => null],
            'address' => ['type' => 'string', 'default' => null],
            'phone' => ['type' => 'string', 'default' => null],
            'tags' => ['type' => 'array(string)'],
            'description' => ['type' => 'string', 'default' => null],
            'meta_title' => ['type' => 'string', 'default' => null],
            'meta_description' => ['type' => 'string', 'default' => null],
            'meta_keywords' => ['type' => 'string', 'default' => null],
            'weight' => ['type' => 'int', 'default' => null],
            'status' => ['type' => 'int', 'default' => 0],
            'owner' => ['type' => 'string', 'default' => null],
        ];
    }
}
