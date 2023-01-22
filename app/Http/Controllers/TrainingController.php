<?php

namespace App\Http\Controllers;

use App\Models\ApprovedTraining;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TrainingController extends Controller
{
    public function index()
    {
        return response()->json([
            'trainings' => Training::with('users', 'roles')->get(),
            'roles' => Role::all(),
        ]);
    }

    public function show($id)
    {
        $training = Training::with('users.roles', 'roles', 'user')->where('slug', $id)->first()->toArray();
        $roles = Role::all()->values();

        return response()->json([
            'training' => $training,
            'roles' => $roles,
        ]);
    }

    public function changeStatus(Training $training, Request $request)
    {
        $user = User::where('slug', $request->user)->first();
        if ($request->status == 'approved') {

            $approvedTraining = ApprovedTraining::where('user_id', $user->id)->where('training_id', $training->id)->first();
            if (!$approvedTraining) {
                ApprovedTraining::create([
                    'user_id' => $user->id,
                    'training_id' => $training->id,
                ]);
            }
            $training->users()->detach($user);
        } else {
            $training->users()->detach($user);
        }

        return response()->json([
            'name' => $user->name,
        ]);
    }

    public function removeOfficer(Training $training, User $user)
    {
        $training->users()->detach($user);

        return response()->json([
            'name' => $user->name,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'roles' => 'required|not_in:0',
            'text' => 'required'
        ]);

        $training = Training::create([
            'reference' => 'A' . rand(10000, 99999),
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => auth()->user()->id,
            'status' => 'active'
        ]);

        foreach ($request->roles as $role) {
            $training->roles()->attach($role['id']);
        }
    }

    public function applyTraining($id)
    {
        $training = Training::where('slug', $id)->first();


        $check = $training->roles()->where('role_id', auth()->user()->roles->first()->id)->exists();


        if ($check) {

            $sql = $training->users()->where('user_id', auth()->user()->id)->exists();

            if ($sql) {
                return response()->json([
                    'success' => false,
                    'message' => 'Du bist dieser Ausbildung bereits beigetreten!'
                ]);
            } else {
                $training->users()->attach(auth()->user()->id);

                return response()->json([
                    'success' => true,
                    'message' => 'Du hast dich erfolgreich für die Ausbildung eingetragen'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Du besitzt nicht den benötigten Rang, um an dieser Ausbildung teilnehmen zu können.'
            ]);
        }
    }

    public function status($id)
    {
        $training = Training::where('slug', $id)->first();

        $training->update([
            'status' => $training->status == 'active' ? 'inactive' : 'active'
        ]);
    }

    public function destroy($id)
    {
        $training = Training::where('slug', $id)->first();

        $training->delete();
    }

    public function update($id, Request $request)
    {
        $training = Training::where('slug', $id)->first();

        $training->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        foreach ($request->roles as $role) {
            $training->roles()->sync($role['id']);
        }
    }
}
