<?php

namespace App\Http\Controllers;

use App\Models\Civilian;
use App\Models\Investigation;
use App\Models\InvestigationEntry;
use App\Models\User;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    public function index()
    {
        $investigations = Investigation::with('users')->orderByDesc('created_at')->get();
        $civilians = cache()->remember('civilians', 60*60*24, function() {
            return Civilian::all();
        });
        $users = User::all();

        return response()->json([
            'investigations' => $investigations,
            'civilians' => $civilians,
            'users' => $users,
        ]);
    }

    public function active()
    {
        $investigations = Investigation::with('users')->where('status', '=', 'active')->get();

        return response()->json([
            'investigations' => $investigations
        ]);
    }

    public function inactive()
    {
        $investigations = Investigation::with('users')->where('status', '=','inactive')->get();

        return response()->json([
            'investigations' => $investigations
        ]);
    }

    public function close(Investigation $investigation)
    {
        $investigation->update([
            'status' => 'inactive'
        ]);
    }

    public function show($id)
    {
        $investigation = Investigation::with('users', 'entries.user', 'civilians')->find($id);
        return response()->json([
            'investigation' => $investigation
        ]);
    }

    public function createEntry(Investigation $investigation, Request $request)
    {
        $investigation->entries()->create([
            'text' => $request->text,
            'user_id' => auth()->user()->id,
        ]);


    }

    public function deleteEntry($id)
    {
        $entry = InvestigationEntry::find($id);

        $entry->delete();
    }

    public function create(Request $request)
    {

        $request->validate([
            'users' => 'required|not_in:0',
            'civilians' => 'required|not_in:0',
            'text' => 'required'
        ]);

        $investigation = Investigation::create([
            'text' => $request->text,
            'reference' => rand(10000, 99999),
            'label' => $request->label,
        ]);

        foreach($request->users as $user) {
            $investigation->users()->attach([
                'user_id' => $user['id'],
            ]);
        }

        foreach($request->civilians as $civilian) {
            $investigation->civilians()->attach([
                'civilian_identifier' => $civilian['identifier'],
            ]);
        }
    }

    public function destroy(Investigation $investigation)
    {
        $investigation->delete();
    }
}
