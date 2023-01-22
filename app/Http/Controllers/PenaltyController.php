<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with('children')->orderBy('paragraph')->get()->toTree();

        return response()->json([
            'penalties' => $penalties
        ]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        if ($request->parent != null) {
            $request->validate([
                'paragraph' => 'required|string',
                'label' => 'required|string',
                'fine' => 'required|numeric',
                'imprisonment' => 'required|numeric',
            ]);
            $law = Penalty::create([
                'paragraph' => $request->paragraph,
                'label' => $request->label,
                'fine' => $request->fine,
                'imprisonment' => $request->imprisonment,
                'additional' => $request->text,
                'parent_id' => $request->parent
            ]);
        } else {
            $request->validate([
                'paragraph' => 'required|string',
                'label' => 'required|string',
            ]);
            $law = Penalty::create([
                'paragraph' => $request->paragraph,
                'label' => $request->label,
            ]);
        }

        if ($law) {
            return response()->json([
                'success' => true,
                'message' => 'Du hast den Eintrag im Strafkatalog erfolgreich erstellt.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ein Fehler ist aufgetreten! Bitte versuche es später erneut!'
            ]);
        }
    }

    public function destroy($id)
    {
        $penalty = Penalty::find($id);

        $penalty->delete();
        $penalties = Penalty::with('children')->orderBy('paragraph')->get()->toTree();

        return response()->json([
            'penalties' => $penalties
        ]);
    }

    public function update($id, Request $request)
    {
        $penalty = Penalty::find($id);

        $penalty->update([
            'paragraph' => $request->paragraph,
            'label' => $request->label,
            'fine' => $request->fine,
            'imprisonment' => $request->imprisonment,
            'additional' => $request->text,
            'parent_id' => $request->parent
        ]);
    }

    public function edit($id)
    {
        $penalty = Penalty::find($id);
        $penalties = Penalty::orderBy('paragraph')->get()->toTree();
        return response()->json([
            'penalty' => $penalty,
            'penalties' => $penalties
        ]);
    }
}
