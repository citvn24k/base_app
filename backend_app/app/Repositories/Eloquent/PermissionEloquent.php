<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Base\BaseEloquent;
use App\Repositories\PermissionRepository;

class PermissionEloquent extends BaseEloquent implements PermissionRepository
{
    public function model()
    {
        return Permission::class;
    }

    public function doesntHave($relationships = '', string $boolean = 'and', $callback = null)
    {
        $this->query = $this->query->doesntHave($relationships, $boolean, $callback);
        return $this;
    }

    public function toggleStatus($id)
    {
        //
    }

    public function updateBatch($column, $ids, $data)
    {
        return $this->query->whereIn($column, $ids)->update($data);
    }

    public function restoreData($data)
    {
        return $this->query->update($data);
    }
}
