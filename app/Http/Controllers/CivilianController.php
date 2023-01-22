<?php

namespace App\Http\Controllers;

use App\Models\Bolo;
use App\Models\Civilian;
use App\Models\CivilianEntry;
use App\Models\CivilianLicense;
use App\Models\CivilianVehicle;
use App\Models\Penalty;
use App\Models\VehicleColor;
use App\Models\VehicleHash;
use Illuminate\Http\Request;

class CivilianController extends Controller
{
    public function index()
    {
        $bolos = Bolo::where('status', 'active')->get();

        $currentPage = \request()->get('page', 1);

        $civilian = cache()->remember('civilians-'.$currentPage, 60*60*24,function () {
            return Civilian::orderBy('lastname')->paginate(10);
        });


        return response()->json([
            'civilian' => $civilian,
            'bolos' => $bolos,
        ]);
    }

    public function search(Request $request)
    {
        $input = explode(" ", $request->name);
        $input[1] = $input[1] ?? '';
        $query = Civilian::when(!empty($request->name), function ($query) use ($input) {
            return $query->where('firstname', 'LIKE', '%'.$input[0].'%')
                ->where('lastname', 'LIKE', '%'.$input[1].'%')
                ->orWhere('lastname', 'LIKE', '%'.$input[0].'%');
        })
            ->when(!empty($request->sex), function ($query) use ($request) {
                $query->where('sex', '=',$request->sex);
            })
            ->paginate(10);

        return response()->json([
            'query' => $query
        ]);
    }

    public function show($civilian)
    {
        $civilian = Civilian::with('licenses', 'entries', 'entries.users', 'entries.penalties')->find($civilian);

//        $vehicles = cache()->remember('civilian_vehicles'.$civilian, 60*60, function () use ($civilian) {
//            return CivilianVehicle::where('owner', $civilian)->get();
//        });
        $vehicles = CivilianVehicle::where('owner', $civilian->identifier)->get();

        $hashes = cache()->remember('vehiclehash', 60*60*24, function () {
            return VehicleHash::all();
        });
        $colors = cache()->remember('vehiclecolor', 60*60*24, function () {
            return VehicleColor::all();
        });

        $create_entry = auth()->user()->hasPermissionTo('user.create.entry');
        $removeLicense = auth()->user()->hasPermissionTo('user.remove.license');
        $editEntry = auth()->user()->hasPermissionTo('user.edit.entry');
        $deleteEntry = auth()->user()->hasPermissionTo('user.delete.entry');

        return response()->json([
            'civilian' => $civilian,
            'vehicles' => $vehicles,
            'hashes' => $hashes,
            'colors' => $colors,
        ]);
    }

    public function create()
    {
        $penalties = Penalty::get()->toTree();
        return response()->json([
            'penalties' => $penalties
        ]);
    }

    public function sendBolo(Request $request)
    {
        $request->validate([
            'reason' => 'required|min:20',
        ]);

        $active_bolo = Bolo::where('civilian_id', $request->civilian)->where('status', 'active')->first();

        if (!$active_bolo) {
            $bolo = Bolo::create([
                'user_id' => \Auth::id(),
                'civilian_id' => $request->civilian,
                'reason' => $request->reason,
                'status' => 'active',
                'type' => 'civilian'
            ]);
        } else {
            $bolo = false;
        }

        if ($bolo) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'exists_already' => true,
            ]);
        }
    }

    public function removeLicense(Request $request)
    {

        $civilian = Civilian::find($request->civ);

        $civilian
            ->licenses()
            ->where('owner', $request->civ)
            ->where('type', $request->lic)
            ->delete();

        cache()->forget('civilian_'.$request->civ);
    }

    public function createEntry($id, Request $request)
    {

        $civilian = Civilian::find($id);

        $entry = $civilian->entries()->create([
            'reference' => 'U'.rand(10000,99999),
            'text' => $request->text,
            'status' => $request->status,
        ]);

        if ($request->status == 2) {
            Bolo::create([
                'user_id' => auth()->user()->id,
                'civilian_id' => $civilian->identifier,
                'reason' => $request->text,
                'type' => 'civilian',
                'status' => 'active'
            ]);
        }

        $e = CivilianEntry::find($entry->id);

        $e->penalties()->attach($request->penalties);

        $entry->update([
            'fine' => $e->penalties()->sum('fine'),
            'imprisonment' => $e->penalties()->sum('imprisonment')
        ]);

        return response()->json([
            'fine' => number_format($e->penalties()->sum('fine'), 2),
            'imprisonment' => $e->penalties()->sum('imprisonment')
        ]);
    }

    public function deleteEntry($id)
    {

        $entry = CivilianEntry::find($id);

        $entry->delete();
    }
}
