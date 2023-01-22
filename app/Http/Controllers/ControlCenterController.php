<?php

namespace App\Http\Controllers;

use App\Models\ControlCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlCenterController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'on_duty')->get();
        $control_centers = ControlCenter::with('users')->get();
        $leitstelle = User::where('leitstelle', 1)->first();
        $auth = Auth::user();

        return response()->json([
            'users' => $users,
            'control_centers' => $control_centers,
            'leitstelle' => $leitstelle ?? null,
            'auth' => $auth
        ]);
    }

    public function resetLeitstelle()
    {
        \DB::table('control_center_user')->delete();
    }

    public function takeLeitstelle()
    {
        $leitstelle = User::where('leitstelle', 1)->first();
        if($leitstelle) {
            $leitstelle->update([
                'leitstelle' => 0
            ]);
        }

        \auth()->user()->update([
            'leitstelle' => 1
        ]);
    }

    public function giveLeitstelle()
    {
        \auth()->user()->update([
            'leitstelle' => 0
        ]);
    }

    public function classifyUser(Request $request)
    {
        $control_center = ControlCenter::find($request->area_id);
        foreach ($request->classified_user as $user) {
            $control_center->users()->attach($user['id']);
        }
    }

    public function resetArea(ControlCenter $controlCenter)
    {
        \DB::table('control_center_user')->where('control_center_id', $controlCenter->id)->delete();
    }

    public function destroy(ControlCenter $controlCenter)
    {
        $controlCenter->delete();
    }

    public function store(Request $request)
    {
        ControlCenter::create([
            'label' => $request->name,
            'max_user' => $request->max
        ]);
    }

}
