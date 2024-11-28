<?php

namespace App\Repositories\Base;

abstract class BaseCriteria
{
    abstract public function apply($model, BaseEloquent $repository);

    public function isJoined($model, $table)
    {
        $joins = $model->getQuery()->joins;
        if ($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }
}
