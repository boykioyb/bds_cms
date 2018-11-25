<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function findAll();

    public function findById(string $id);

    public function create(array $data);

    public function update(array $data, string $id, string $attribute = 'id', bool $withSoftDeletes = false);

    public function delete(string $id);

    public function where(array $conditions, string $operator = null, string $value = null);

    public function count();

    public function paginate(array  $option,string $operator = null, int $page = null, int $limit = null);
}
