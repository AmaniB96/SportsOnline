@extends('layouts.back_layout')

@section('title', 'Liste des Joueurs')

@section('content')
    <section class="m-10 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 p-4">
            <h1 class="text-xl font-bold mb-4 text-gray-700 dark:text-gray-200">Liste des Joueurs</h1>

            @if($joueurs->isEmpty())
                <p class="text-gray-500">Aucun joueur enregistré.</p>
            @else
                <table class="w-full border-collapse text-gray-700 dark:text-gray-200">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                            <th class="p-2 border">Nom</th>
                            <th class="p-2 border">Prénom</th>
                            <th class="p-2 border">Âge</th>
                            <th class="p-2 border">Téléphone</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Pays</th>
                            <th class="p-2 border">Position</th>
                            <th class="p-2 border">Équipe</th>
                            <th class="p-2 border">Genre</th>
                            <th class="p-2 border">Utilisateur</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($joueurs as $joueur)
                            <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-2 border">{{ $joueur->nom }}</td>
                                <td class="p-2 border">{{ $joueur->prenom }}</td>
                                <td class="p-2 border">{{ $joueur->age }}</td>
                                <td class="p-2 border">{{ $joueur->phone }}</td>
                                <td class="p-2 border">{{ $joueur->email }}</td>
                                <td class="p-2 border">{{ $joueur->pays }}</td>
                                <td class="p-2 border">{{ $joueur->position->nom }}</td>
                                <td class="p-2 border">{{ $joueur->equipe->nom ?? '-' }}</td>
                                <td class="p-2 border">{{ $joueur->genre->genre }}</td>
                                <td class="p-2 border">{{ $joueur->user->name ?? '-' }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('back.player.show', $joueur->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Modifier</a>
                                    |
                                    <div x-data="{ open: false }" class="inline">
                                        <button @click="open = true" class="text-red-600 hover:underline">
                                            Supprimer
                                        </button>

                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Confirmer la suppression</h2>
                                                <p class="mb-4 text-gray-700 dark:text-gray-300">Voulez-vous vraiment supprimer {{ $joueur->nom }} {{$joueur->prenom}}</p>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="open = false" class="px-4 text-black py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                                                    <form :action="'{{ route('back.player.destroy', $joueur->id) }}'" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
        </div>
    </section>
@endsection
