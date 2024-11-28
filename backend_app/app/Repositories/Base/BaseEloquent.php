<?php

namespace App\Repositories\Base;

use App\Repositories\Base\Interfaces\BaseCriteriaInterface;
use App\Repositories\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Mockery\Exception;

abstract class BaseEloquent implements
    BaseRepositoryInterface,
    BaseCriteriaInterface
{
    protected $model;
    private $app;
    protected $criteria;
    protected $skipCriteria;
    protected $query;

    public function __construct(App $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->query = $model->newQuery();

        return $this->model = $model;
    }

    public function paginate(
        $perPage = 20,
        $columns = array('*'),
        string $orderBy = 'id',
        string $sortBy = 'desc',
        $pageName = 'page'
    ) {
        $this->applyCriteria();

        if ($orderBy && $sortBy) {
            return $this->query->orderBy($orderBy, $sortBy)->paginate($perPage, $columns, $pageName);
        }

        return $this->query->paginate($perPage, $columns, $pageName);
    }

    public function groupBy($column)
    {
        $this->query->groupBy($column);
        return $this;
    }

    public function orderBy(string $orderBy = 'id', string $sortBy = 'desc')
    {
        $this->applyCriteria();
        $this->query->orderBy($orderBy, $sortBy);
        return $this;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function updateOrCreate(array $filter, array $data)
    {
        return $this->model->updateOrCreate($filter, $data);
    }

    public function insert(array $attributes)
    {
        return $this->model->insert($attributes);
    }

    public function update(array $attributes, int $id)
    {
        $object = $this->model->find($id);
        if ($object) {
            return $object->update($attributes) ? $object : false;
        }

        return false;
    }

    public function noEagerLoads()
    {
        $this->model = $this->model->setEagerLoads([]);
        return $this;
    }

    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc')
    {
        $this->applyCriteria();
        return $this->query->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function find(int $id)
    {
        $this->applyCriteria();
        return $this->query->find($id);
    }

    public function findOneOrFail(int $id)
    {
        $this->applyCriteria();
        return $this->query->findOrFail($id);
    }

    public function findBy(array $data)
    {
        $this->applyCriteria();
        return $this->query->where($data)->get();
    }

    public function findOneByAndOrderBy(array $data, string $orderBy = 'id', string $sortBy = 'desc')
    {
        $this->applyCriteria();
        return $this->query->where($data)->orderBy($orderBy, $sortBy)->first();
    }

    public function whereIn($column, array $data)
    {
        $this->applyCriteria();
        return $this->query->whereIn($column, $data)->get();
    }

    public function whereBetween($column, array $data)
    {
        $this->applyCriteria();
        return $this->query->whereBetween($column, $data)->get();
    }

    public function findOneBy(array $data)
    {
        $this->applyCriteria();
        return $this->query->where($data)->first();
    }

    public function firstOrCreate(array $attribute)
    {
        return $this->query->firstOrCreate($attribute);
    }

    public function findOneByOrFail(array $data)
    {
        $this->applyCriteria();
        return $this->query->where($data)->firstOrFail();
    }

    public function delete(int $id)
    {
        try {
            return $this->query->find($id)->delete();
        } catch (\Exception $e) {
            throw new Exception('Can not delete record: ' . $id);
        }
    }

    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function getByCriteria(BaseCriteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function pushCriteria(BaseCriteria $criteria)
    {
        $this->criteria->push($criteria);
        return $this;
    }

    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            $this->makeModel();
            return $this;
        }

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof BaseCriteria) {
                $this->query = $criteria->apply($this->query, $this);
            }
        }

        return $this;
    }

    public function with(array $relationships = [])
    {
//        $this->applyCriteria();
        $this->query = $this->query->with($relationships);
        return $this;
    }

    public function withCount($relationships)
    {
//        $this->applyCriteria();
        $this->query = $this->query->withCount($relationships);
        return $this;
    }

    public function getAllValOfAttribute($colum, $pr_key = 'id')
    {
        return $this->model->select($colum)->groupBy($pr_key)->get()->toArray();
    }

    public function isJoined($table)
    {
        return collect($this->query->getQuery()->joins)->pluck('table')->contains(
            function ($value, $key) use ($table) {
                return preg_match('/(' . $table . ')/', $value);
            }
        );
    }

    public function pluck($attribute, $key = null)
    {
        return $this->query->pluck($attribute, $key);
    }

    public function limit($limit)
    {
        $this->query = $this->query->limit($limit);
        return $this;
    }

}
