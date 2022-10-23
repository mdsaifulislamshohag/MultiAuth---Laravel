<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Illuminate\Http\Request;
use Bitfumes\Multiauth\Model\Role;
use Illuminate\Routing\Controller;
use Bitfumes\Multiauth\Model\Admin;
use Crypt;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super');
    }

    public function index()
    {
        $roles = Role::all();

        return view('multiauth::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('multiauth::roles.create');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        return view('multiauth::roles.edit', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Role::create($request->all());

        return redirect(route('admin.roles'))->with('message', 'New Role is stored successfully');
    }

    public function update(Role $role, Request $request)
    {
        $request->validate(['name' => 'required']);

        $role->update($request->all());

        return redirect(route('admin.roles'))->with('message', 'You have updated Role successfully');
    }

    public function destroy(Role $role)
    {
        if ($role->admins()->count() > 0) {
            return redirect()->back()->with('custom_error', 'Can not delete. Admin assigned with this role');
        }
        else{
            $role->delete();
            return redirect()->back()->with('message', 'Role deleted');
        }
        
    }
}
