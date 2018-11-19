<?php

namespace App\Models;

use App\BaseModel;
use MongoDB\BSON\ObjectId;

class Property extends BaseModel
{
    public $collection = 'properties';
    protected $guarded = [];

    public static function SCHEMAS()
    {
        return [
            'project_sales' => ['type' => ObjectId::class, 'default' =>null],
            'lang_code' => ['type' => 'string', 'default' => null],
            'name' => ['type' => 'string', 'default' => null],
            'name_ascii' => ['type' => 'string', 'default' => null],
            'url_alias' => ['type' => 'string', 'default' => null],
            'tags' => ['type' => 'array(string)', 'default' => null],
            'short_description' => ['type' => 'string', 'default' => null],
            'description' => ['type' => 'string', 'default' => null],
            'priority' => ['type' => 'int', 'default' => null],
            'meta_title' => ['type' => 'string', 'default' => null],
            'meta_description' => ['type' => 'string', 'default' => null],
            'meta_keywords' => ['type' => 'string', 'default' => null],
            'weight' => ['type' => 'int', 'default' => null],
            'status' => ['type' => 'int', 'default' => 0],
            'price' => ['type' => 'int', 'default' => 0],
            'price_sale' => ['type' => 'int', 'default' => 0],
            'beds' => ['type' => 'int', 'default' => 0],
            'baths' => ['type' => 'int', 'default' => 0],
            'acreage' => ['type' => 'int', 'default' => 0],
            'garages' => ['type' => 'int', 'default' => 0],
            'kitchen' => ['type' => 'int', 'default' => 0],
            'balcony' => ['type' => 'int', 'default' => 0],
            'start_date' => ['type' => 'date', 'default' => null],
            'end_date' => ['type' => 'date', 'default' => null],
            'owner' => ['type' => 'string', 'default' => null],
            'files' => ['type' => 'array(string)', 'default' => null],
        ];
    }
}
