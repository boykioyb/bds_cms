<?php

namespace App\Models;

use App\BaseModel;

class Slider extends BaseModel
{
    public $collection = 'sliders';
    protected $guarded = [];


    public $customSchema = array(
        'code' => '',
        'data_locale' => [
            'name' => '',
            'name_ascii' => '',
            'url_alias' => '',
            'description' => '',
            'weight' => 0,
            'status' => 0,
            'files' => null,
        ],
        'owner' => null,
    );
    public $asciiFields = array(
        'name',
    );

}
