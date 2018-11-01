<?php

namespace App\Models;

use App\BaseModel;

class Media extends BaseModel
{
    public $collection = 'medias';
    protected $guarded = [];

    public $customSchema = array(
        'date' => null,
        'lang' => '',
        'file_url' => '',
        'owner' => '',
    );

}
