<?php

namespace App\Http\Controllers;

use App\Settings\ServerSettings;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\ServiceLocatorTrait;

class SettingController extends Controller
{
    public function index(\GeneralSettings $settings)
    {
        return response()->json([
            'site_name' => $settings->site_name,
        ]);
    }

    public function saveGeneral(\GeneralSettings $settings, Request $request)
    {
        $settings->site_name = $request->site_name;
        $settings->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function getSites(\PageSettings $settings): \Illuminate\Http\JsonResponse
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
        ]);
    }

    public function updateSites(\PageSettings $settings, Request $request)
    {
        $val = $request->name;
        $settings->$val = $request->check;

        $settings->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function getServer(ServerSettings $settings)
    {
        return response()->json([
            'cd_garage' => $settings->cd_garage,
        ]);
    }

    public function updateServer(Request $request, ServerSettings $settings)
    {
        $settings->cd_garage = $request->cd_garage;

        $settings->save();

        return response()->json([
            'success' => true
        ]);
    }
}
