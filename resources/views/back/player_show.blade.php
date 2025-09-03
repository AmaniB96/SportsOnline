@extends('layouts.back_layout')

@section('title', "edit $joueur->nom")

@section('content')
<section class="mt-20 mb-5 p-5">
    <div>
        @if (session('success'))
        <div class="bg-green-600">
            {{session('success')}}
        </div>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif
    </div>
    <div class="min-h-screen flex items-center justify-center m-5">
        <div class="bg-[rgb(31,41,55)] shadow-lg rounded-2xl p-8 w-full max-w-md space-y-6">
            <div class="w-full flex justify-center">
                <img src="{{ asset($joueur->photo->src) }}" alt="image de {{ $joueur->prenom }}" class="rounded ">
            </div>
            <form action="{{ route('back.player.update', $joueur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2 class="text-2xl font-bold text-center text-white mb-10">Modifier {{ $joueur->nom }} {{$joueur->prenom}}</h2>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-white">Nom</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $joueur->nom) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-white">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $joueur->prenom) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-white">Âge</label>
                        <input type="number" id="age" name="age" value="{{ old('age', $joueur->age) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $joueur->phone) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $joueur->email) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="pays" class="block text-sm font-medium text-white">Pays</label>
                        <input type="text" id="pays" name="pays" value="{{ old('pays', $joueur->pays) }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-white">Position</label>
                        <select id="position_id" name="position_id"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 text-black">
                            <option value="">-- Sélectionner --</option>
                            @foreach($positions as $position)
                                <option class="text-black" value="{{ $position->id }}" @selected(old('position_id', $joueur->position_id) == $position->id)>
                                    {{ ucfirst($position->position) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="equipe_id" class="block text-sm font-medium text-white">Équipe</label>
                        <select id="equipe_id" name="equipe_id"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            <option value="">joueur disponible</option>
                            @foreach($equipes as $equipe)
                                <option value="{{ $equipe->id }}" @selected(old('equipe_id', $joueur->equipe_id) == $equipe->id)>
                                    {{ ucfirst($equipe->nom) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="genre_id" class="block text-sm font-medium text-white">Genre</label>
                        <select id="genre_id" name="genre_id"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            <option value="">-- Sélectionner --</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" @selected(old('genre_id', $joueur->genre_id) == $genre->id)>
                                    {{ ucfirst($genre->genre) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-white">image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full text-white rounded-xl border border-gray-300 p-2 focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-white font-semibold shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Enregistrer
                    </button>
                </div>
            </form>
            <div x-data="{ open: false }" class="inline">
                <button @click="open = true" class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 w-full rounded-xl mt-5">
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
        </div>
    </div>
</section>
@endsection
