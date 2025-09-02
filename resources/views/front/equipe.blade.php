@extends('layouts.front_layout')

@section('title', 'Équipes')

@section('content')
    <div class="container">
        <h1>Nos équipes</h1>
        <div class="equipes-list">
            @if($equipes->count())
                @foreach($equipes as $equipe)
                    <div class="equipe-card">
                        <h2>{{ $equipe->nom }}</h2>
                        <ul>
                            @if($equipe->joueurs)
                                @foreach($equipe->joueurs as $joueur)
                                    <li>
                                        <a href="{{ route('home.show', $joueur->id) }}">
                                            {{ $joueur->nom }} {{ $joueur->prenom }}
                                        </a>
                                        ({{ $joueur->position->position ?? '-' }}, {{ $joueur->genre->genre ?? '-' }})
                                    </li>
                                @endforeach
                            @else
                                <li>Aucun joueur dans cette équipe.</li>
                            @endif
                        </ul>
                    </div>
                @endforeach
            @else
                <p>Aucune équipe disponible pour le moment.</p>
            @endif
        </div>
    </div>
@endsection