@extends('layouts.back_layout')

@section('title','{{ $equipe->nom }}')

@section('content')
    <section class="m-10 p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 p-4">
            <div class="flex justify-center items-center mb-4">
                <img 
                    class="rounded-t-lg w-24 h-24 sm:w-32 sm:h-32 object-contain" 
                    src="{{ asset($equipe->logo) }}" 
                    alt="{{ $equipe->nom }}" 
                />
            </div>

            <form action="{{ route('back.equipe.update',$equipe->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                @csrf
                @method('PUT')
                <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300" for="nom">
                    Nom de l'équipe
                </label>
                <input 
                    type="text" 
                    name="nom" 
                    id="nom"
                    placeholder="Entrez le nom de l'équipe"
                    class="block w-full mb-4 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $equipe->nom }}"
                />

                <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300" for="ville">
                    Ville
                </label>
                <input 
                    type="text" 
                    name="ville" 
                    id="ville"
                    placeholder="Entrez la ville"
                    class="block w-full mb-4 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $equipe->ville }}"
                />

                

                <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300" for="continent">
                    Continent
                </label>
                <select name="continent_id" id="continent"
                        class="block w-full mb-4 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @foreach($continents as $continent)
                        <option value="{{ $continent->id }}" 
                            @selected(old('continent_id', $equipe->continent_id) == $continent->id)>
                            {{ ucfirst($continent->nom) }}
                        </option>
                    @endforeach
                </select>

                <label for="genre" class="block mb-2 font-medium text-gray-700 dark:text-gray-300">Genre</label>
                <select name="genre_id" id="genre" class="block w-full mb-4 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="" @selected(is_null(old('genre_id', $equipe->genre_id)))>Mixte</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(old('genre_id', $equipe->genre_id) == $genre->id)>{{ ucfirst($genre->genre) }}</option>
                    @endforeach
                </select>

                <label class="block mb-2 font-medium text-gray-700 dark:text-gray-300" for="logo">
                    Logo de l'équipe
                </label>
                <input 
                    type="file" 
                    name="logo" 
                    id="logo" 
                    accept="image/*"
                    class="block w-full mb-4 text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-700 file:text-white
                        hover:file:bg-blue-800
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                />

                <button type="submit" class="w-full px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                    Enregistrer
                </button>
            </form>
            <form action="{{ route('back.equipe.destroy',$equipe->id) }}" method="POST" class="max-w-lg mx-auto p-6">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>
            </form>
        </div>

    </section>

@endsection