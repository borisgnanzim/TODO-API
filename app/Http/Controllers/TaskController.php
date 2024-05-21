<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'date_due' => 'nullable|date',
        ]);
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $task = Task::findOrFail($id);
        return response()->json($task);

    }
    /**
     * Afficher les détails d'une tâche spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'date_due' => 'nullable|date',
        ]);
        $task->update($validatedData);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    /**
     * Supprimer une tâche spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Tâche supprimée avec succès']);
    }
}
