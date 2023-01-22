<?php

namespace App\Http\Controllers;

use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json([
            'roles' => Role::with('permissions')->orderBy('priority')->where('hidden', false)->get(),
            'permissions' => Permission::orderBy('label')->get()
        ]);
    }


    public function getRoles()
    {
        return response()->json([
            'roles' => Role::orderBy('priority')->get(),
        ]);
    }

    public function update($id, Request $request)
    {
        $role = Role::findById($id);

        if ($role->name == 'Developer') {
            $role->syncPermissions(Permission::all());
        } else {
            $role->givePermissionTo($request->permissions);
        }
    }

    public function removePermission($role, $permission)
    {
        $role = Role::findById($role);
        if ($role->name == 'Developer') {
            $role->syncPermissions(Permission::all());
        } else {
            $role->revokePermissionTo($permission);
        }
    }

    public function assign($id)
    {
        $role = Role::findById($id);

        $role->syncPermissions(Permission::all());
    }

    public function edit($id)
    {
        try {
            $role = Role::findById($id);

            return response()->json([
                'role' => $role,
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            $error = "Die Rolle wurde nicht gefunden";

            return response()->json([
                'error' => $error,
                'success' => false,
            ]);
        }
    }

    public function updateRole($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'priority' => 'required'
        ]);

        try {
            $role = Role::findById($id);
            $role->update([
                'name' => $request->name,
                'priority' => $request->priority,
                'hidden' => $request->hidden,
            ]);
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'priority' => 'required'
        ]);

        Role::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'hidden' => $request->hidden,
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        try {
            $role = Role::findById($id);
            $user = $role->users()->exists();
            if (!$user) {
                $role->delete();
            }
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
