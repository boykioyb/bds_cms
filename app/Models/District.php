<?php

namespace App\Models;

use App\BaseModel;

class District extends BaseModel
{
    public $collection = 'district';
    public $fillable = [
        'status',
    ];


    public $customSchema = array(
        'id' => null,
        'code' => '',
        'name' => '',
        'status' => 0,
        'owner' => '',
        'created' => null,
        'modified' => null,
    );
    public $asciiFields = array(
        'data_locale.name',
    );

}
