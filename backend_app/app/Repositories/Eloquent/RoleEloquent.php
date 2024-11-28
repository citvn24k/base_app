<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Base\BaseEloquent;
use App\Repositories\RoleRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class RoleEloquent extends BaseEloquent implements RoleRepository
{
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    public function model()
    {
        return Role::class;
    }
}
