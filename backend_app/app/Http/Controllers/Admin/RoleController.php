<?php

namespace App\Http\Controllers\Admin;

use App\Core\Acl\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Core\Acl\Repositories\Interfaces\RoleRepositoryInterface;
use App\Core\Acl\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $roleRepo;
    private $permissionRepo;

    /**
     * RoleController constructor.
     * @param RoleRepository $roleRepo
     * @param PermissionRepository $permissionRepo
     */
    public function __construct(RoleRepository $roleRepo, PermissionRepository $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index(Request $request)
    {
        return view('admin.role.index', [
            'data' => $this->roleRepo->withCount(['users'])->paginate(10)
        ]);
    }

    public function create()
    {
        $permissions = $this->permissionRepo->with(['children'])->withCount(['children'])->doesntHave('parent')->all();

        return view('admin.role.create', ['permissions' => $permissions]);
    }

    public function store(RoleRequest $request)
    {
        return $this->storeData($request);
    }

    public function show($id)
    {
        $permissions = $this->permissionRepo->with(['children'])->withCount(['children'])->doesntHave('parent')->all();
        $role = $this->roleRepo->with(['permissions'])->findOneOrFail($id);
        $permActive = $role->permissions->pluck('id');

        return view('adminlte.role.show', compact('role', 'permissions', 'permActive'));
    }

    public function edit($id)
    {
        $permissions = $this->permissionRepo->with(['children'])->withCount(['children'])->doesntHave('parent')->all();
        $role = $this->roleRepo->findOneOrFail($id);

        return view('admin.role.edit', compact('permissions', 'role'));
    }

    public function update(RoleRequest $request, $id)
    {
        return $this->storeData($request, $id);
    }

    public function storeData($request, $id = 0)
    {
        DB::beginTransaction();
        try {
            $permissions = $request->get('permissions', []);
            if ($id == 0) {
                $role = $this->roleRepo->create(['name' => $request->input('name')]);
                $message = 'Thêm mới vai trò thành công';
            } else {
                $role = $this->roleRepo->update(['name' => $request->input('name')], $id);
                $message = 'Cập nhật vai trò thành công';
            }
            $role->syncPermissions($permissions);
            DB::commit();
            flash($message);

            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash('Có lỗi xảy ra - ' . $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        $role = $this->roleRepo->withCount(['users'])->findOneOrFail($id);
        if ($role->users_count > 0) {
            flash()->error('Bạn không thể xoá vai trò đang tồn tại người dùng. Vui lòng kiểm tra lại');

            return redirect()->back();
        }
        $this->roleRepo->delete($id);
        flash('Xóa vai trò thành công');

        return redirect()->route('role.index');
    }
}
