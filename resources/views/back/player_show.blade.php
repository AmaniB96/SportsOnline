@extends('layouts.back_layout')

@section('title','{{ $joueur->nom }}')

@section('content')
    <section>
        <div>
            <h1>Vous etes dans la page backPlayerShow</h1>
        </div>
        <div class="min-h-screen flex items-center justify-center bg-[rgb(31,41,55)]">
            <form class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md space-y-6">
                <h2 class="text-2xl font-bold text-center text-gray-800">Ajouter une entrée</h2>

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ $joueur->nom }}"
                        class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" 
                    />
                </div>

                <div>
                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ $joueur->ville }}"
                        class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" 
                    />
                </div>

                <div>
                <label for="continent_id" class="block text-sm font-medium text-gray-700">Continent</label>
                <select id="continent_id" name="continent_id"
                    class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                >
                    <option value="">-- Sélectionner --</option>
                    <option value="1" {{ $joueur->continent->nom=='europe'? }}>Europe</option>
                    <option value="2">Asie</option>
                    <option value="3">Afrique</option>
                    <option value="4">Amérique</option>
                    <option value="5">Océanie</option>
                </select>
                </div>

                <div>
                <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                <select id="genre_id" name="genre_id"
                    class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                    <option value="">-- Sélectionner --</option>
                    <option value="1">Homme</option>
                    <option value="2">Femme</option>
                    <option value="3">Autre</option>
                </select>
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" id="logo" name="logo" accept="image/*"
                        class="mt-1 block w-full text-gray-700 rounded-xl border border-gray-300 p-2 focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" 
                    />
                </div>

                <div class="pt-4">
                <button type="submit"
                    class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-white font-semibold shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    Enregistrer
                </button>
                </div>
            </form>
        </div>
    </section>
@endsection