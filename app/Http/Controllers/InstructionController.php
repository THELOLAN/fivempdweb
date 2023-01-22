<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructionController extends Controller
{
    public function index()
    {
        $instructions = Instruction::with('user')->orderByDesc('created_at')->get();
        $create = auth()->user()->hasPermissionTo('instructions.create');
        $edit = auth()->user()->hasPermissionTo('instructions.edit');
        $delete = auth()->user()->hasPermissionTo('instructions.delete');

        return response()->json([
            'instructions' => $instructions,
            'permissions' => [
                'create' => $create,
                'edit' => $edit,
                'delete' => $delete
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'required|min:20|string'
        ]);

        Instruction::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function edit(Instruction $instruction)
    {
        return response()->json([
            'instruction' => $instruction,
        ]);
    }

    public function update(Request $request, Instruction $instruction)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'required|min:20|string'
        ]);

        $instruction->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Instruction $instruction)
    {
//        if (auth()->user()->hasPermissionTo('instructions.delete')) {
            $instruction->delete();
            return response()->json([
                'success' => true
            ]);
//        } else {
//            return response()->json([
//                'success' => false
//            ]);
//        }
    }
}
