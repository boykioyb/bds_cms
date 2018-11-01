<?php

namespace App\Models;

class Property extends BaseModel
{
    public $collection = 'properties';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'categories' => null,
        'project_sales' => null,
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'tags' => '',
            'short_description' => '',
            'description' => '',
            'meta_title' => '',
            'meta_description' => '',
            'meta_tags' => '',
            'meta_keywords' => '',
            'weight' => 0,
            'status' => 0,
            'priority' => 0,
        ],
        'mode' => 0,
        'price' => 0,
        'price_sale' => 0,
        'detail_room' => array(
            'beds' => 0, // số phòng ngủ
            'baths' => 0, // số phòng tắm
            'acreage' => 0, //diện tích,
            'garages' => 0, // gara ô tô
            'kitchen' => 0, //phòng bếp
            'balcony' => 0, // ban công
        ),
        'start_date' => '',
        'end_date' => '',
        'files' => [
            'logo' => null,
            'image' => null,
            'video' => null
        ],
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
        'data_locale.tags',
    );

}