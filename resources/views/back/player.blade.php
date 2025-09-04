@extends('layouts.back_layout')

@section('title', 'Joueurs')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-32 mb-10">
    <!-- En-tête avec action -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestion des joueurs</h1>
        <a href="{{ route('back.player.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark focus:ring-4 focus:ring-primary/30 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nouveau joueur
        </a>
    </div>

    <!-- Section Mes Joueurs -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
        <div class="p-5 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Mes joueurs</h2>
        </div>

        @if($mesJoueurs->isEmpty())
            <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p>Vous n'avez pas encore de joueurs enregistrés.</p>
                <a href="{{ route('back.player.create') }}" class="mt-2 inline-block text-primary hover:underline">Ajouter votre premier joueur</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joueur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Détails</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($mesJoueurs as $joueur)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if(optional($joueur->photo)->src)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($joueur->photo->src) }}" alt="{{ $joueur->nom }}" />
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-sm font-medium text-primary">
                                                    {{ strtoupper(substr($joueur->prenom ?? $joueur->nom, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $joueur->prenom }} {{ $joueur->nom }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $joueur->age }} ans • {{ $joueur->pays }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $joueur->phone }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $joueur->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $joueur->equipe ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                            {{ $joueur->equipe ? $joueur->equipe->nom : 'Sans équipe' }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ optional($joueur->position)->position ?? 'N/A' }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                            {{ optional($joueur->genre)->genre ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('back.player.show', $joueur->id) }}" class="text-primary hover:text-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" class="text-red-500 hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                                                <div class="flex items-center justify-center min-h-screen px-4">
                                                    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50" @click="open = false"></div>
                                                    <div class="relative bg-white dark:bg-gray-800 w-full max-w-md p-6 mx-auto rounded-lg shadow-xl overflow-hidden">
                                                        <div class="text-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Confirmer la suppression</h3>
                                                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                                                Souhaitez-vous vraiment supprimer le joueur {{ $joueur->prenom }} {{ $joueur->nom }} ? Cette action est irréversible.
                                                            </p>
                                                        </div>
                                                        <div class="mt-6 flex justify-end space-x-3">
                                                            <button @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                                                                Annuler
                                                            </button>
                                                            <form method="POST" action="{{ route('back.player.destroy', $joueur->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700">
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Liste des autres joueurs (pour admin et coach) -->
    @can('isAdminorCoach')
    <div class="mt-10 space-y-8">
        @if($joueursParRoleEtUser->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center text-gray-500">
                <p>Aucun autre joueur enregistré dans le système.</p>
            </div>
        @else
            @foreach($joueursParRoleEtUser as $role => $groupUsers)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                            @switch($role)
                                @case('user') Utilisateurs @break
                                @case('coach') Coaches @break
                                @case('sans_user') Joueurs sans utilisateur associé @break
                                @default {{ ucfirst($role) }} @break
                            @endswitch
                        </h2>
                    </div>

                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($groupUsers as $userId => $joueurs)
                            <div>
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50">
                                    <h3 class="font-medium text-gray-700 dark:text-gray-300">
                                        {{ $joueurs->first()->user->nom ?? 'Sans utilisateur' }} {{ $joueurs->first()->user->prenom ?? '' }}
                                        <span class="text-sm text-gray-500 dark:text-gray-400 font-normal ml-2">({{ count($joueurs) }} joueur{{ count($joueurs) > 1 ? 's' : '' }})</span>
                                    </h3>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Joueur</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Détails</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($joueurs as $joueur)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                @if(optional($joueur->photo)->src)
                                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($joueur->photo->src) }}" alt="{{ $joueur->nom }}" />
                                                                @else
                                                                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-sm font-medium text-primary">
                                                                        {{ strtoupper(substr($joueur->prenom ?? $joueur->nom, 0, 1)) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ $joueur->prenom }} {{ $joueur->nom }}
                                                                </div>
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    {{ $joueur->age }} ans • {{ $joueur->pays }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 dark:text-white">{{ $joueur->phone }}</div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $joueur->email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex space-x-2">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $joueur->equipe ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                                {{ $joueur->equipe ? $joueur->equipe->nom : 'Sans équipe' }}
                                                            </span>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                                {{ optional($joueur->position)->position ?? 'N/A' }}
                                                            </span>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                                                {{ optional($joueur->genre)->genre ?? 'N/A' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('back.player.show', $joueur->id) }}" class="text-primary hover:text-primary-dark">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                                </svg>
                                                            </a>
                                                            <div x-data="{ open: false }">
                                                                <button @click="open = true" class="text-red-500 hover:text-red-700">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </button>

                                                                <!-- Modal de confirmation -->
                                                                <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                                                                    <div class="flex items-center justify-center min-h-screen px-4">
                                                                        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50" @click="open = false"></div>
                                                                        <div class="relative bg-white dark:bg-gray-800 w-full max-w-md p-6 mx-auto rounded-lg shadow-xl overflow-hidden">
                                                                            <div class="text-center">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                                </svg>
                                                                                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Confirmer la suppression</h3>
                                                                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                                                                    Souhaitez-vous vraiment supprimer le joueur {{ $joueur->prenom }} {{ $joueur->nom }} ? Cette action est irréversible.
                                                                                </p>
                                                                            </div>
                                                                            <div class="mt-6 flex justify-end space-x-3">
                                                                                <button @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                                                                                    Annuler
                                                                                </button>
                                                                                <form method="POST" action="{{ route('back.player.destroy', $joueur->id) }}">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700">
                                                                                        Supprimer
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @endcan
</div>
@endsection