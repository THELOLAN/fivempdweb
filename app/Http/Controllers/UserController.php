<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class USerController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::with('roles', 'civilian_entries', 'investigations')->orderBy('priority')->where('isAdmin', 0)->get(),
            'roles' => Role::orderBy('priority')->get()
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::where('slug', $id)->first();

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'sex' => $request->sex
        ]);

        $user->syncRoles($request->role);
    }

    public function destroy($id)
    {
        $user = User::where('slug', $id)->first();

        $user->delete();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'sex' => 'required|not_in:0',
            'role' => 'required|not_in:0'
        ]);

        $role = Role::findById($request->role);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'sex' => $request->sex,
            'priority' => $role->priority,
            'status' => 'off_duty'
        ]);
        if ($role->name == 'Developer') {
            $user->update([
                'isAdmin' => true,
            ]);
        }

        $user->assignRole($request->role);
    }
}
