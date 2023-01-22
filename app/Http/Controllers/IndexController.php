<?php

namespace App\Http\Controllers;

use App\Models\Civilian;
use App\Models\CivilianEntry;
use App\Models\CivilianVehicle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
    public function getUser()
    {
        $user = \Auth::user();

        return response()->json([
            'user' => $user
        ]);
    }

    public function getData(\GeneralSettings $settings)
    {
        return response()->json([
            'site_name' => $settings->site_name,
            'footer' => $settings->footer_copyright,
        ]);
    }

    public function index(\GeneralSettings $settings)
    {
        return view('index', [
            'site_name' => $settings->site_name,
            'footer' => $settings->footer_copyright,
        ]);
    }

    public function empty(\GeneralSettings $settings)
    {
        return view('settings.empty', [
            'site_name' => $settings->site_name
        ]);
    }

    public function postData(Request $request)
    {

        $this->validate($request ,[
            'main_host' => 'required',
            'main_name' => 'required',
            'main_user' => 'required',
            'ingame_host' => 'required',
            'ingame_name' => 'required',
            'ingame_user' => 'required',
        ]);

        setting([
            'database.main.host' => $request->input('main_host'),
            'database.main.name' => $request->input('main_name'),
            'database.main.user' => $request->input('main_user'),
            'database.main.password' => $request->input('main_password'),
            'database.ingame.host' => $request->input('ingame_host'),
            'database.ingame.name' => $request->input('ingame_name'),
            'database.ingame.user' => $request->input('ingame_user'),
            'database.ingame.password' => $request->input('ingame_password')

        ]);
        setting()->save();
        Artisan::call('config:cache');
        Artisan::call('config:clear');

    }

    public function sidebar(\PageSettings $settings)
    {
        return response()->json([
            "user" => \Auth::user(),
            "civilian_database" => $settings->civilian_database,
            "vehicle_database" => $settings->vehicle_database,
            "law_books" => $settings->law_books,
            "managment_center" => $settings->managment_center,
            "instructions" => $settings->instructions,
            "bolo" => $settings->bolo,
            "investigations" => $settings->investigations,
            "trainings" => $settings->trainings,
            "officer" => $settings->officer,
            "logs" => $settings->logs,
            "role" => $settings->role,
        ]);
    }

    public function toggleStatus()
    {
        auth()->user()->update([
            'status' => auth()->user()->status == 'on_duty' ? 'off_duty' : 'on_duty',
        ]);
    }

    public function checkPermission($role, $permission)
    {
        $role = Role::findById($role);
        if ($role->hasPermissionTo($permission)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function dashboard()
    {
        $civilians = Civilian::count();
        $vehicles = CivilianVehicle::count();
        $users = User::where('status', 'on_duty')->get();
        $civilian_entries = CivilianEntry::with('civilian', 'users')->orderBy('created_at')->take(5)->get();

        $entries_week = CivilianEntry::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $entries_month = CivilianEntry::whereMonth('created_at', '>=', Carbon::now()->month)->count();

        return response()->json([
            'civilians' => $civilians,
            'vehicles' => $vehicles,
            'users' => $users,
            'civilian_entries' => $civilian_entries,
            'entries_week' => $entries_week,
            'entries_month' => $entries_month
        ]);
    }

    public function password(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password'
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);
    }
}
