<?php


namespace App\Repositories\Criteria;


use App\Repositories\Base\BaseCriteria;
use App\Repositories\Base\BaseEloquent;

class UserCriteria extends BaseCriteria
{

    public function apply($model, BaseEloquent $repository)
    {
        $this->searchByName($model);
        return $model;
    }

    public function searchByName(&$model)
    {
        $value = request()->get('name');
        if (!empty($value)) {
            $model = $model->where('name', 'LIKE', '%' . $value . '%');
        }
    }
}
