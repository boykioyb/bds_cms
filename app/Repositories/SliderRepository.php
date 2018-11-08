<?php

namespace App\Repositories;

use App\Models\Slider;
use MongoDB\BSON\ObjectId;

class SliderRepository extends BaseRepository
{
    private $where;
    private $orWhere;
    const PAGE_DEFAULT = 0;
    const LIMIT_DEFAULT = 10;

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

    public function paginate($option, $operator = null, $page = null, $limit = null)
    {
        if (empty($page)) {
            $page = self::PAGE_DEFAULT;
        }
        if (empty($limit)) {
            $limit = self::LIMIT_DEFAULT;
        }
        $this->makeModel();
        $result = $this->model();

        if (empty($option)) {
            return $result::limit($limit)->offset($page)->get();
        }

        $this->_dataNormalization($result::SCHEMAS(), $option);
        $i = 0;
        foreach ($option as $k => $value) {
            if ($i == 0) {
                $result = $result::where($k, $value);
            } else {
                $result = $result->where($k, $value);
            }
            $i++;
        }
        return $result->limit($limit)->offset($page)->get();
    }

    private function _dataNormalization($schema, &$option)
    {
        foreach ($schema as $k => $val) {
            switch ($val['type']) {
                case 'int';
                    if (!empty($option[$k])) {
                        $option[$k] = (int)$option[$k];
                    }
                    break;
            }
        }
    }
}
