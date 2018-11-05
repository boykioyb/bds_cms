<?php

namespace App\Repositories;

use App\Models\Slider;
use MongoDB\BSON\ObjectId;

class SliderRepository extends BaseRepository
{
    private $where;
    private $orWhere;

    public function model()
    {
        return Slider::class;
    }

    public function findAll()
    {
        $this->makeModel();
        return $this->model()::all();
    }

    public function findById($id)
    {
        $this->makeModel();
        return $this->model()::find($id);
    }

    public function create($data)
    {
        $this->makeModel();

        return $this->model::create($data);
    }

    public function update($data, $id, $attribute = 'id', $withSoftDeletes = false)
    {
        if ($withSoftDeletes) {
            $this->newQuery()->eagerLoadTrashed();
        }

        $this->makeModel();
        $this->model->where($attribute, '=', $id)->update($data);

        return $this->findBy($attribute, $id);
    }

    public function delete($id)
    {
        $this->makeModel();

        return $this->model()->destroy($id);
    }

    public function where($conditions, $operator = null, $value = null)
    {
        if (func_num_args() == 2) {
            list($value, $operator) = [$operator, '='];
        }

        $this->where[] = [$conditions, $operator, $value];

        return $this;
    }

    public function orWhere($conditions, $operator = null, $value = null)
    {
        if (func_num_args() == 2) {
            list($value, $operator) = [$operator, '='];
        }

        $this->orWhere[] = [$conditions, $operator, $value];

        return $this;
    }

    public function count()
    {
        $this->newQuery()
            ->loadWhere();

        return $this->model->count();
    }

    private function loadWhere()
    {
        if (count($this->where)) {
            foreach ($this->where as $where) {
                if (is_array($where[0])) {
                    $this->model->where($where[0]);
                } else {
                    if (count($where) == 3) {
                        $this->model->where($where[0], $where[1], $where[2]);
                    } else {
                        $this->model->where($where[0], '=', $where[1]);
                    }
                }
            }
        }
        if (count($this->orWhere)) {
            foreach ($this->orWhere as $orWhere) {
                if (is_array($orWhere[0])) {
                    $this->model->orWhere($orWhere[0]);
                } else {
                    if (count($orWhere) == 3) {
                        $this->model->orWhere($orWhere[0], $orWhere[1], $orWhere[2]);
                    } else {
                        $this->model->orWhere($orWhere[0], '=', $orWhere[1]);
                    }
                }
            }
        }
    }


}
