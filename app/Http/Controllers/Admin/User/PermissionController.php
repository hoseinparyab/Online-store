<?php

namespace App\Http\Controllers\admin\user;

use Illuminate\Http\Request;
use App\Models\User\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.user.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.user.permission.create');
    }

    public function store(PermissionRequest $request)  // تغییر Request به PermissionRequest
    {
        $inputs = $request->validated();  // تغییر all() به validated()
        $permission = Permission::create($inputs);
        return redirect()
            ->route('admin.user.permission.index')
            ->with('swal-success', 'دسترسی جدید با موفقیت ثبت شد');
    }

    public function edit(Permission $permission)
    {
        return view('admin.user.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)  // تغییر Request به PermissionRequest
    {
        $inputs = $request->validated();  // تغییر all() به validated()
        $permission->update($inputs);
        return redirect()
            ->route('admin.user.permission.index')
            ->with('swal-success', 'دسترسی شما با موفقیت ویرایش شد');
    }

    public function destroy(Permission $permission)
    {
        $result = $permission->delete();
        return redirect()
            ->route('admin.user.permission.index')
            ->with('swal-success', 'دسترسی شما با موفقیت حذف شد');
    }
}
