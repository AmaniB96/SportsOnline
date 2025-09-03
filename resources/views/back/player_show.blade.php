@extends('layouts.back_layout')

@section('title', "edit $joueur->nom")

@section('content')
<section class="mt-10 mb-5 p-5">
    <div class="min-h-screen flex items-center justify-center m-5">

        <form action="{{ route('back.player.update', $joueur->id) }}" method="POST" enctype="multipart/form-data" class="bg-[rgb(31,41,55)] shadow-lg rounded-2xl p-8 w-full max-w-md space-y-6">
            @csrf
            @method('PUT')
    
            <h2 class="text-2xl font-bold text-center text-white">Modifier le {{ $joueur->nom }}</h2>
    
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
                <label for="position_id" class="block text-sm font-medium text-whitetext-white">Position</label>
                <select id="position_id" name="position_id"
                    class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <option value="">-- Sélectionner --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" @selected(old('position_id', $joueur->position_id) == $position->id)>
                            {{ ucfirst($position->nom) }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="equipe_id" class="block text-sm font-medium text-gray-700">Équipe</label>
                <select id="equipe_id" name="equipe_id"
                    class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <option value="">-- Sélectionner --</option>
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
    
            <div class="pt-4">
                <button type="submit"
                    class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-white font-semibold shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
