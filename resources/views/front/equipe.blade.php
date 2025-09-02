@extends('layouts.front_layout')

@section('title', 'Équipes')

@section('content')
    <div class="container">
        <h1>Nos équipes</h1>
        <div class="equipes-list">
            @forelse($equipes as $equipe)
                <div class="equipe-card">
                    <h2>{{ $equipe->nom }}</h2>
                    <p>Nombre de joueurs : {{ $equipe->joueurs->count() }}</p>
                    <ul>
                        @forelse($equipe->joueurs as $joueur)
                            <li>
                                <a href="{{ route('joueur.show', $joueur->id) }}">
                                    {{ $joueur->nom }} {{ $joueur->prenom }}
                                </a>
                                ({{ $joueur->position->nom ?? '-' }}, {{ $joueur->genre->nom ?? '-' }})
                            </li>
                        @empty
                            <li>Aucun joueur dans cette équipe.</li>
                        @endforelse
                    </ul>
                </div>
            @empty
                <p>Aucune équipe disponible pour le moment.</p>
            @endforelse
        </div>
    </div>
@endsection