@extends('layouts.front_layout')

@section('title', 'Détail du joueur')

@section('content')
    <div class="container">
        <h1>{{ $joueur->prenom }} {{ $joueur->nom }}</h1>
        @if(isset($joueur))
            <div class="player-details">
                <ul>
                    <li><strong>Nom :</strong> {{ $joueur->nom }}</li>
                    <li><strong>Prénom :</strong> {{ $joueur->prenom }}</li>
                    <li><strong>Âge :</strong> {{ $joueur->age }}</li>
                    <li><strong>Pays :</strong> {{ $joueur->pays }}</li>
                    <li><strong>Position :</strong> {{ $joueur->position->position ?? '-' }}</li>
                    <li><strong>Équipe :</strong> {{ $joueur->equipe->nom ?? '-' }}</li>
                    <li><strong>Genre :</strong> {{ $joueur->genre->genre ?? '-' }}</li>
                </ul>
                @if($joueur->photo)
                    <img src="{{ asset($joueur->photo->src) }}" alt="Photo du joueur" style="max-width:200px;">
                @endif
            </div>
        @else
            <p>Joueur introuvable.</p>
        @endif
        <a href="{{ route('home.equipe') }}">Retour aux équipes</a>
    </div>
@endsection