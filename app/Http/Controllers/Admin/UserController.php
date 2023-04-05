<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function list()
    {
        $users = $this->user->paginate(7);
        return view('Admin.Users.list', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('Admin.Users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:users,name|max:100',
                'email' => 'required|unique:users,email',
                'password' => 'required|max:20|min:5',
            ]
        );
        try {
            DB::beginTransaction();
            $user = $this->user->create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]
            );
            $user->roles()->attach($request->role_id);
            DB::commit();

            return redirect()->route('admin.user.list')->with('success', 'Create user successfully');
        } catch (\Exception $exeption) {
            DB::rollBack();
            Log::error('Message' . $exeption->getMessage() . 'Line: ' . $exeption->getLine());
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;

        return view('Admin.Users.edit', compact('roles', 'user', 'rolesOfUser'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);

        $user->roles()->sync($request->role_id);
        return redirect()->route('admin.user.list')->with('success', 'update roles successfully');
    }

    public function delete($id)
    {
        $this->user->find($id)->delete();
        return redirect()->route('admin.user.list');
    }

    public function showSoftDelete()
    {
        $userSoftDelete = $this->user->onlyTrashed()->get();

        return view('Admin.Users.listSoftDelete', compact('userSoftDelete'));
    }

    public function restoreUser($id)
    {
        $this->user->withTrashed()->find($id)->restore();
        return redirect()->route('admin.user.list')->with('success', 'restore successfully');
    }

    public function deleteTrash($id)
    {
        $deleteTrash = $this->user->withTrashed()->find($id);
        $deleteTrash->roles()->detach();
        
        $deleteTrash->forceDelete();

        return redirect()->route('admin.user.deletesoft')->with('success', 'Delete user successfully');
    }

}
