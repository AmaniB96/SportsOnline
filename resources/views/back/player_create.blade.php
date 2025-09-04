@extends('layouts.back_layout')

@section('title','ajouter une equipe')

@section('content')
   
    
    <section class="mt-32 mb-5 p-5">
        <div>
            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-600 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="min-h-screen flex items-center justify-center mt-20 mb-5 p-5">

            <form action="{{ route('back.player.store') }}" method="POST" enctype="multipart/form-data" class="bg-[rgb(31,41,55)] shadow-lg rounded-2xl p-8 w-full max-w-md space-y-6">
                @csrf
        
                <h2 class="text-2xl font-bold text-center text-white">Ajouter un joueur</h2>
        
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-white">Nom</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-white">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-white">Âge</label>
                        <input type="number" id="age" name="age" value="{{ old('age') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50" />
                    </div>
                    <div>
                        <label for="pays" class="block text-sm font-medium text-white">Pays</label>
                        <input type="text" id="pays" name="pays" value="{{ old('pays') }}"
                            class="mt-1 block w-full rounded-xl border border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                        />
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-white">Position</label>
                        <select id="position_id" name="position_id"
                            class="mt-1 block w-full rounded-xl border text-black border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            <option value="">-- Sélectionner --</option>
                            @foreach($positions as $position)
                                <option class="text-black" value="{{ $position->id }}" @selected(old('position_id') == $position->id)>
                                    {{ ucfirst($position->position) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="equipe_id" class="block text-sm font-medium text-white">Équipe</label>
                        <select id="equipe_id" name="equipe_id"
                            class="mt-1 block w-full rounded-xl border text-black border-gray-300 p-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 text-black">
                            <option value="">-- Sélectionner --</option>
                            @foreach($equipes as $equipe)
                                @php
                                    $count = $equipe->joueurs->count();
                                    $isFull = $count >= 15;
                                    $label = ucfirst($equipe->nom) . ' (' . $count . '/15)' . ($isFull ? ' — Pleine' : '');
                                @endphp
                                <option class="text-black" value="{{ $equipe->id }}" @selected(old('equipe_id') == $equipe->id)>
                                    @selected(old('equipe_id') == $equipe->id)
                                    @if($isFull) disabled @endif>
                                    {{ $label }}
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
                                <option class="text-black" value="{{ $genre->id }}" @selected(old('genre_id') == $genre->id)>
                                    {{ ucfirst($genre->genre) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="logo" class="block text-sm font-medium text-white">image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full text-white rounded-xl border border-gray-300 p-2 focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                        />
                    </div>
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