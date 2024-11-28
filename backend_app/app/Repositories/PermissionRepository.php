<?php

namespace App\Repositories;

use App\Repositories\Base\Interfaces\BaseRepositoryInterface;

interface PermissionRepository extends BaseRepositoryInterface
{
    const PERMISSION_DEFAULT = [
        'view' => 'Xem',
        'create' => 'Tạo',
        'edit' => 'Sửa',
        'delete' => 'Xóa'
    ];
    public function doesntHave($relationships = '', string $boolean = 'and', $callback = null);

    public function updateBatch($column, $ids, $data);

    public function restoreData($data);

    public function toggleStatus($id);
}
