<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">Ma Liste de Tâches</h3>

                <form action="{{ route('tasks.store') }}" method="POST" class="mb-6 flex gap-2">
                    @csrf
                    <input type="text" name="title" placeholder="Qu'y a-t-il à faire ?"
                           class="border-gray-300 rounded-md shadow-sm flex-1 focus:ring-blue-500 focus:border-blue-500" required>
                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-semibold uppercase tracking-wide">
                        Ajouter
                    </button>
                </form>
              
                <hr class="mb-6">

                <ul class="space-y-3">
                    @forelse($tasks as $task)
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center gap-3">
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf 
                                    @method('PATCH')
                                    <button type="submit" class="flex items-center group">
                                        @if($task->is_completed)
                                            <span class="text-green-500 font-bold text-xl">✔</span>
                                            <span class="ml-2 line-through text-gray-400 font-medium">{{ $task->title }}</span>
                                        @else
                                            <span class="text-gray-300 group-hover:text-blue-500 text-xl font-bold">○</span>
                                            <span class="ml-2 text-gray-800 font-medium">{{ $task->title }}</span>
                                        @endif
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center gap-4">
                                <button onclick="editTask({{ $task->id }}, '{{ addslashes($task->title) }}')"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold uppercase tracking-wider">
                                    Modifier
                                </button>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette tâche ?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold uppercase tracking-wider">
                                        Supprimer
                                    </button>
                                </form>  
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500 text-center py-6 bg-gray-50 rounded-lg border-2 border-dashed">
                            Aucune tâche pour le moment. Commencez par en ajouter une !
                        </li>
                    @endforelse
                </ul>

            </div>
        </div>
    </div>
    
    <script>
        /**
         * Fonction pour modifier une tâche via un prompt JavaScript
         * et envoyer les données en PATCH
         */
        function editTask(id, currentTitle) {
            let newTitle = prompt("Modifier le nom de la tâche :", currentTitle);
            if (newTitle && newTitle.trim() !== "" && newTitle !== currentTitle) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = `/tasks/${id}`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="title" value="${newTitle}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>
