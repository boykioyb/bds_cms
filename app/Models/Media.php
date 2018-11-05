<?php

namespace App\Models;

use App\BaseModel;

class Media extends BaseModel
{
    public $collection = 'medias';
    protected $guarded = [];

    public $customSchema = array(
        'name' => '',
        'size' => 0,
        'mime' => '',
        'file_url' => '',
        'owner' => '',
    );

}
