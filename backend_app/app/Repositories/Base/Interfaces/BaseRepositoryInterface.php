<?php

namespace App\Repositories\Base\Interfaces;

interface BaseRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes, int $id);

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    public function find(int $id);

    public function findOneOrFail(int $id);

    public function findBy(array $data);

    public function findOneBy(array $data);

    public function whereIn($column, array $data);

    public function whereBetween($column, array $data);

    public function findOneByOrFail(array $data);

    public function delete(int $id);

    public function paginate($perPage = 15, $columns = array('*'));

    public function noEagerLoads();

    public function orderBy(string $orderBy = 'id', string $sortBy = 'desc');

    public function with(array $relationships = []);

    public function updateOrCreate(array $filter, array $data);

    public function pluck($attribute, $key = null);

    public function withCount($relationships);

    public function limit($limit);
}
