<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function findAll();

    public function findById($id);

    public function create($data);

    public function update(array $data, $id, $attribute = 'id', $withSoftDeletes = false);

    public function delete($id);

    public function where($conditions, $operator = null, $value = null);

    public function orWhere($conditions, $operator = null, $value = null);

    public function count();

    public function paginate($option, $operator = null, $page = null, $limit = null);
}
