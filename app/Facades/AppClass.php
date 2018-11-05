<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AppClass extends Facade{

    protected static function getFacadeAccessor() { return 'appclass'; }
}
