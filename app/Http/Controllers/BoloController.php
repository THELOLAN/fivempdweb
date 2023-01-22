<?php

namespace App\Http\Controllers;

use App\Models\Bolo;
use Illuminate\Http\Request;

class BoloController extends Controller
{
    public function index()
    {
        $bolos = Bolo::with('civilian')->get();

        return response()->json([
            'bolos' => $bolos
        ]);
    }

    public function stopBolo(Bolo $bolo)
    {
        return $bolo->delete();
    }
}
