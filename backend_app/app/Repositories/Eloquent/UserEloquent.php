<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Base\BaseEloquent;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class UserEloquent extends BaseEloquent implements UserRepository
{
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    public function model()
    {
        return User::class;
    }
}
