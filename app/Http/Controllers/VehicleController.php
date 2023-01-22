<?php

namespace App\Http\Controllers;

use App\Models\Civilian;
use App\Models\CivilianVehicle;
use App\Models\VehicleColor;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = CivilianVehicle::with('owner')->paginate(10);

        $colors = VehicleColor::all();

        return response()->json([
            'vehicles' => $vehicles,
            'colors' => $colors
        ]);
    }

    public function search(Request $request)
    {
        $query = CivilianVehicle::when(!empty($request->search), function ($query) use ($request) {
            return $query->where('plate', 'LIKE', '%'.$request->search.'%');
        })
            ->paginate(10);

        return response()->json([
            'query' => $query
        ]);
    }
}
