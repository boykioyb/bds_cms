<?php

namespace App\Models;

use App\BaseModel;
use MongoDB\BSON\ObjectId;

class ProjectSale extends BaseModel
{
    public $collection = 'project_sales';
    protected $guarded = [];

    public static function SCHEMAS()
    {
        return [
            'investor' => ['type' => ObjectId::class, 'default' => new ObjectId()],
            'lang_code' => ['type' => 'string', 'default' => null],
            'name' => ['type' => 'string', 'default' => null],
            'name_ascii' => ['type' => 'string', 'default' => null],
            'url_alias' => ['type' => 'string', 'default' => null],
            'city' => ['type' => 'string', 'default' => null],
            'district' => ['type' => 'string', 'default' => null],
            'address' => ['type' => 'string', 'default' => null],
            'tags' => ['type' => 'array(string)'],
            'short_description' => ['type' => 'string', 'default' => null],
            'description' => ['type' => 'string', 'default' => null],
            'type' => ['type' => 'string', 'default' => null],
            'scale' => ['type' => 'string', 'default' => null],
            'functional' => ['type' => 'string', 'default' => null],
            'design_consultancy' => ['type' => 'string', 'default' => null],
            'pm_mc' => ['type' => 'string', 'default' => null],
            'priority' => ['type' => 'int', 'default' => null],
            'area' => ['type' => 'int', 'default' => null],
            'loc' => ['type' => 'array(float)', 'default' => null],
            'meta_title' => ['type' => 'string', 'default' => null],
            'meta_description' => ['type' => 'string', 'default' => null],
            'meta_keywords' => ['type' => 'string', 'default' => null],
            'weight' => ['type' => 'int', 'default' => null],
            'status' => ['type' => 'int', 'default' => 0],
            'land_area_of_study' => ['type' => 'int', 'default' => 0],
            'construction_land_area' => ['type' => 'int', 'default' => 0],
            'construction_density' => ['type' => 'int', 'default' => 0],
            'owner' => ['type' => 'string', 'default' => null],
            'files' => ['type' => 'array(string)'],
            'image' => ['type' => 'array(string)'],
            'video' => ['type' => 'array(string)'],
        ];
    }

}
