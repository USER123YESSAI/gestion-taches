<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   public function index()
{
    // On récupère les tâches de l'utilisateur connecté
    $tasks = auth()->user()->tasks;

    // On envoie la variable à la vue dashboard
    return view('dashboard', compact('tasks'));
}

    public function store(Request $request) {
        $request->validate(['title' => 'required']);
        Auth::user()->tasks()->create(['title' => $request->title]);
        return back();
    }

    // UPDATE : Cocher une tâche comme faite
    public function update(Request $request, Task $task) {
    if ($request->has('title')) {
        // Si on reçoit un titre via le script JS (bouton Modifier)
        $task->update(['title' => $request->title]);
    } else {
        // Si on clique sur le rond/check (changement de statut)
        $task->update(['is_completed' => !$task->is_completed]);
    }
    return back();
}

    // DELETE : Supprimer une tâche
    public function destroy(Task $task) {
        $task->delete();
        return back();
    }
}
