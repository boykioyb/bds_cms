<?php

namespace App\Models;

use App\BaseModel;

class City extends BaseModel
{
    public $collection = 'cities';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'code' => '',
        'name' => '',
        'district' => '',
        'status' => 0,
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}
