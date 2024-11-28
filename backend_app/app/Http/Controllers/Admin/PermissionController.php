<?php

namespace App\Http\Controllers\Admin;

use App\Core\Acl\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionRepo;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepo
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function index(Request $request)
    {
        return view('admin.permission.index', [
                'data' => $this->permissionRepo->with(['children'])->doesntHave('parent')->all()
        ]);
    }

    public function update(Request $request)
    {
        $this->permissionRepo->restoreData(['status' => false, 'is_show' => false]);
        if ($request->input('status') != '') {
            $status = $request->input('status');
            $ids = [];
            foreach ($status as $st) {
                $ids[] = $st;
            }
            $this->permissionRepo->updateBatch('id', $ids, ['status' => true]);
        }

        if ($request->input('show') != '') {
            $show = $request->input('show');
            $ids = [];
            foreach ($show as $sh) {
                $ids[] = $sh;
            }
            $this->permissionRepo->updateBatch('id', $ids, ['is_show' => true]);
        }

        return redirect()->route('permissions.index')->with('message', 'Cập nhật trạng thái thành công');
    }

    public function updateTitle(Request $request)
    {
        $title = $request->input('value');
        $id = $request->input('pk');
        try {
            $this->permissionRepo->update(['title' => $title], $id);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        try {
            $this->permissionRepo->update(['status' => $this->convertStatus($status)], $id);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function updateShow(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        try {
            $this->permissionRepo->update(['is_show' => $this->convertStatus($status)], $id);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function show()
    {
        dd(1);
    }

    public function sync()
    {
        \Artisan::call('sync:per');
        flash('Đồng bộ thành công');
        return redirect()->route('permissions.index');
    }

    public function convertStatus($status)
    {
        return $status == 'true' ? true : false;
    }

}
