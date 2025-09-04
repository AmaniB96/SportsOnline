@extends('layouts.back_layout')

@section('title','liste Equipe')

@section('content')
    <section class="ms-5 mt-32 mb-5">
        <div>
            <a href="{{ route('back.equipe.create') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Crée une nouvelle equipe
            </a>
        </div>
    </section>
    <section class="m-5">
         @if($mesEquipes->isEmpty())
            <p class="text-gray-500">Aucune equipe enregistré.</p>
        @else
            <div class="title mb-5">
                <h1 class="mb-5">Mes equipes</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center">
                @foreach ($mesEquipes as $equipe)
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-center items-center p-4">
                            <img 
                                class="rounded-t-lg w-24 h-24 sm:w-32 sm:h-32 object-contain" 
                                src="{{ asset($equipe->logo) }}" 
                                alt="{{ $equipe->nom }}" 
                            />
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $equipe->nom }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nbr de joueur: {{ $equipe->joueurs->count() }}</p>
                            <div class="flex gap-3">
                                <a href="{{ route('back.equipe.show',$equipe->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                                <div x-data="{ open: false }" class="inline">
                                    <button @click="open = true" class="text-red-600 hover:underline">
                                        Supprimer
                                    </button>

                                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                                            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Confirmer la suppression</h2>
                                            <p class="mb-4 text-gray-700 dark:text-gray-300">Voulez-vous vraiment supprimer {{ $equipe->nom }} ?</p>
                                            <div class="flex justify-end gap-2">
                                                <button @click="open = false" class="px-4 py-2 text-black bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                                                <form :action="'{{ route('back.equipe.destroy', $equipe->id) }}'" method="POST">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </section>
    @can('isAdmin')
        <section class="m-5">
            <div class="title mb-5">
                <h1 class="mb-5">Liste des equipes</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center">
                @foreach ($equipes as $equipe)
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-center items-center p-4">
                            <img 
                                class="rounded-t-lg w-24 h-24 sm:w-32 sm:h-32 object-contain" 
                                src="{{ asset($equipe->logo) }}" 
                                alt="{{ $equipe->nom }}" 
                            />
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $equipe->nom }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nbr de joueur: {{ $equipe->joueurs->count() }}</p>
                            <div class="flex gap-3">
                                <a href="{{ route('back.equipe.show',$equipe->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                                <div x-data="{ open: false }" class="inline">
                                    <button @click="open = true" class="text-red-600 hover:underline">
                                        Supprimer
                                    </button>

                                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                                            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Confirmer la suppression</h2>
                                            <p class="mb-4 text-gray-700 dark:text-gray-300">Voulez-vous vraiment supprimer {{ $equipe->nom }} ?</p>
                                            <div class="flex justify-end gap-2">
                                                <button @click="open = false" class="px-4 py-2 text-black bg-gray-300 rounded hover:bg-gray-400">Annuler</button>
                                                <form :action="'{{ route('back.equipe.destroy', $equipe->id) }}'" method="POST">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endcan
   
@endsection