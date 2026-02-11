<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'is_completed', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function store(Request $request)
{
    $request->validate(['title' => 'required|string|max:255']);

    auth()->user()->tasks()->create([
        'title' => $request->title,
    ]);

    return redirect()->route('dashboard')->with('success', 'Tâche ajoutée !');
}
}