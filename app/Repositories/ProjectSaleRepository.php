<?php

namespace App\Repositories;

use App\Models\ProjectSale;
use MongoDB\BSON\ObjectId;

class ProjectSaleRepository extends BaseRepository
{
    const PAGE_DEFAULT = 0;
    const LIMIT_DEFAULT = 10;

    public function model()
    {
        return ProjectSale::class;
    }

    public function findAll()
    {
        $this->makeModel();
        return $this->model()::all();
    }

    public function findById(string $id)
    {
        $this->makeModel();
        return $this->model()::find($id);
    }

    public function create(array $data)
    {
        $this->makeModel();
        unset($data['_token']);
        return $this->model::create($data);
    }

    public function update(array $data,string $id, string $attribute = '_id', bool $withSoftDeletes = false)
    {
        unset($data['_token']);
        if ($withSoftDeletes) {
            $this->newQuery()->eagerLoadTrashed();
        }

        $this->makeModel();
        $this->model->where($attribute, '=', $id)->update($data);

        return $this->model::find($id);
    }

    public function delete(string $id)
    {
        $this->makeModel();

        return $this->model()->destroy($id);
    }

    public function where(array $conditions,string $operator = null,string $value = null)
    {
        $this->makeModel();
        $result = $this->model();
        $i = 0;
        foreach ($conditions as $k => $val) {
            if ($i == 0) {
                $result = $result::where($k, '=', $val);
            } else {
                $result = $result->where($k, '=', $val);
            }
            $i++;
        }
        return $result;
    }

    public function count()
    {
        $this->newQuery()
            ->loadWhere();

        return $this->model->count();
    }

    public function paginate(array $option, string $operator = null, int $page = null, int $limit = null)
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

    public function dataNormalization($schema, &$option)
    {
        foreach ($schema as $k => $val) {
            switch ($val['type']) {
                case 'int';
                    if ($option[$k] != '') {
                        $option[$k] = (int)$option[$k];
                    }
                    break;
                case "MongoDB\BSON\ObjectId";
                    if (!empty($option[$k])) {
                        $option[$k] = new ObjectId($option[$k]);
                    }
                    break;
            }
        }
    }
}
