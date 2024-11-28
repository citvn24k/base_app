<?php

namespace App\Console\Commands;

use App\Core\Acl\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Core\Acl\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:per';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var RoleRepository
     */
    private $roleRepo;
    /**
     * @var PermissionRepository
     */
    private $perRepo;

    /**
     * Create a new command instance.
     *
     * @param RoleRepository $roleRepo
     * @param PermissionRepository $perRepo
     */
    public function __construct(RoleRepository $roleRepo, PermissionRepository $perRepo)
    {
        parent::__construct();
        $this->roleRepo = $roleRepo;
        $this->perRepo = $perRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Syncing permission in admin...');
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action)) {
                $action = explode('@', $action['controller']);
                $path = $action[0];
                if (preg_match('/(Admin)/', $path)) {
                    $this->storePermission($path);
                }
            }
        }
        $this->info('Success!');
    }

    public function storePermission($path)
    {
        $data = [];
        $root = $this->getControllerName($path);
        foreach (PermissionRepository::PERMISSION_DEFAULT as $key => $value) {
            $data[$root . '_' . $key] = $value;
        }
        $per_avail = $this->getAvailablePermission($path);
        if (is_array($per_avail) && count($per_avail) > 0) {
            foreach ($per_avail as $key => $name) {
                if (!empty($name)) {
                    $data[$root . '_' . $key] = $name;
                } else {
                    $data[$root . '_' . $key] = $root . '_' . $key;
                }
            }

        }

        $permission = $this->perRepo->updateOrCreate(['name' => $root], ['name' => $root]);
        if (empty($permission->title)) {
            $permission->title = $root;
        }
        if (is_null($permission->status)) {
            $permission->status = 1;
        }
        if (is_null($permission->is_show)) {
            $permission->is_show = 1;
        }
        $permission->save();
        foreach ($data as $name => $title) {
            $perm = $this->perRepo->updateOrCreate(['name' => $name], ['name' => $name, 'parent_id' => $permission->id]);
            if (empty($perm->title)) {
                $perm->title = $title;
            }
            if (is_null($perm->status)) {
                $perm->status = 1;
            }
            if (is_null($perm->is_show)) {
                $perm->is_show = 1;
            }
            $perm->save();
        }
        $this->perRepo->makeModel();
    }

    public function getControllerName($path)
    {
        return Str::lower($this->parseName($path));
    }

    public function parseName($string)
    {
        return str_replace('Controller', '', last(explode('\\', $string)));
    }

    protected function getAvailablePermission($path)
    {
        try {
            $controller = app($path);
            if (isset($controller->permissions)) {
                return $controller->permissions;
            }
        } catch (\Exception $exception) {
        }
    }
}
