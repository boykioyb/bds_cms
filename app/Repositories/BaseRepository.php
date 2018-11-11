<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Container\Container as App;
abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $app;
    public function __construct()
    {
        $this->app = new App();
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        return $this->model = $model;
    }
}
