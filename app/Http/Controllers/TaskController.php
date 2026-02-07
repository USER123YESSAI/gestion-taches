<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
    $tasks = auth()->user()->tasks; // Sécurité : uniquement les tâches de l'utilisateur connecté
    return view('dashboard', compact('tasks'));
}
}
