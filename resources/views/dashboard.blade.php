<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Gestionnaire de Tâches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-8">
                    <h3 class="text-lg font-medium mb-4">Ajouter une nouvelle tâche</h3>
                    <form action="{{ route('tasks.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="title" placeholder="Qu'avez-vous à faire ?" 
                               class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shrink-0">
                            Ajouter
                        </button>
                    </form>
                </div>

                <hr class="my-6">

                <div>
                    <h3 class="text-lg font-medium mb-4">Mes Tâches en cours</h3>
                    <div class="space-y-3">
                        @forelse($tasks as $task)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center">
                                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="mr-3">
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }} 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    </form>
                                    <span class="{{ $task->is_completed ? 'line-through text-gray-400' : 'text-gray-700' }} font-medium">
                                        {{ $task->title }}
                                    </span>
                                </div>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Aucune tâche pour le moment. Félicitations !</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>