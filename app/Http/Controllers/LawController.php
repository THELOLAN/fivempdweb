<?php

namespace App\Http\Controllers;

use App\Models\Law;
use Illuminate\Http\Request;

class LawController extends Controller
{
    public function index()
    {
        $laws = Law::orderBy('paragraph')->get()->toTree();

        return response()->json([
            'laws' => $laws
        ]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        if ($request->parent != null) {
            $request->validate([
                'paragraph' => 'required|string',
                'title' => 'required|string',
                'text' => 'required|string',
            ]);
            $law = Law::create([
                'paragraph' => $request->paragraph,
                'label' => $request->title,
                'text' => $request->text,
                'parent_id' => $request->parent
            ]);
        } else {
            $request->validate([
                'paragraph' => 'required|string',
                'title' => 'required|string',
            ]);
            $law = Law::create([
                'paragraph' => $request->paragraph,
                'label' => $request->title,
            ]);
        }

        if ($law) {
            return response()->json([
                'success' => true,
                'message' => 'Du hast den Gesetzeseintrag erfolgreich erstellt.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ein Fehler ist aufgetreten! Bitte versuche es später erneut!'
            ]);
        }
    }

    public function destroy(Law $law)
    {
        $law->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function edit(Law $law)
    {
        $laws = Law::get()->toTree();

        return response()->json([
            'law' => $law,
            'laws' => $laws
        ]);
    }

    public function update(Request $request, Law $law)
    {
        $request->validate([
            'paragraph' => 'required',
            'title' => 'required',
        ]);

        $law->update([
            'paragraph' => $request->paragraph,
            'label' => $request->title,
            'text' => $request->text,
            'parent_id' => $request->parent,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sie haben den Gesetzeseintrag <b>§'.$law->paragraph.'.0 '.$law->label.'</b> erfolgreich aktualisiert.'
        ]);
    }
}
