<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes Tâches
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Liste des tâches</h3>
                        <a href="{{ route('tasks.create') }}" class="btn-primary">
                            Nouvelle tâche
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($tasks->count() > 0)
                        <div class="space-y-2">
                            @foreach($tasks as $task)
                                <div class="border rounded-lg p-4 {{ $task->is_completed ? 'bg-gray-50' : 'bg-white' }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="checkbox" 
                                                    {{ $task->is_completed ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                            </form>
                                            <span class="{{ $task->is_completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
                                                {{ $task->title }}
                                            </span>
                                        </div>
                                        <div class="flex space-x-3">
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn-warning">
                                                Modifier
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="task-empty-state">
                            <p class="task-empty-text">Vous n'avez aucune tâche.</p>
                            <div class="task-button-container">
                                <a href="{{ route('tasks.create') }}" class="btn-success">
                                    Créer votre première tâche
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
