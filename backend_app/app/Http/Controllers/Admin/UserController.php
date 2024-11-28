<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepo;
    /**
     * @var RoleRepository
     */
    private $roleRepo;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => $this->userRepo->with(['roles'])->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => $this->roleRepo->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ];
            $role = $request->input('role');
            if (!empty($request->input('password'))) {
                $data['password'] = bcrypt($request->input('password'));
            }

            $user = $this->userRepo->create($data);
            $user->assignRole($role);
            flash('Tạo mới thành công');
            DB::commit();

            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            flash($exception->getMessage());

            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.user.edit', [
            'user' => $this->userRepo->with(['roles'])->findOneOrFail($id),
            'roles' =>  $this->roleRepo->pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ];
            $role = $request->input('role');
            if (!empty($request->input('password'))) {
                $data['password'] = bcrypt($request->input('password'));
            }
            $user = $this->userRepo->update($data, $id);
            $user->syncRoles($role);
            flash('Cập nhật thành công');
            DB::commit();

            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            flash($exception->getMessage());

            return redirect()->route('posts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepo->delete($id);
        flash('Xóa thành công');

        return redirect()->route('users.index');
    }
}
