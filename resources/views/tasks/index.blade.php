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
                        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                                        <div class="flex items-center space-x-3">
                                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="checkbox" 
                                                    {{ $task->is_completed ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                    class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                                            </form>
                                            <span class="{{ $task->is_completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
                                                {{ $task->title }}
                                            </span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                                Modifier
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded"
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
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Vous n'avez aucune tâche.</p>
                            <a href="{{ route('tasks.create') }}" 
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Créer votre première tâche
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
