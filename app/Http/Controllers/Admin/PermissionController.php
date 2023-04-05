<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this -> role = $role;
        $this -> permission = $permission;
    }

    public function list()
    {
        $roles = $this->role->paginate(6);
        return view('Admin.Permission.list', compact('roles'));
    }

    public function create()
    {
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        // dd($permissionsParent);
        return view('Admin.Permission.create', compact('permissionsParent'));
    }

    public function store(Request $request)
    {
        $role= $this->role->create(
            [
                'name' => $request->name,
                'display_name'=>$request->display_name
            ]
        );
        $role->permissions()->attach($request->permission_id);
        // dd($role);
        return redirect()->route('admin.permission.list')->with('success', 'Create successfully');
    }

    public function edit($id)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $pemissionsChecked = $role->permissions;
        return view('Admin.Permission.edit', compact('permissionsParent', 'role', 'pemissionsChecked'));
    }

    public function update(Request $request, $id)
    {
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.permission.list');
    }

}
