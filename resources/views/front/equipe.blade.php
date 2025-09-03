@extends('layouts.front_layout')

@section('title', 'Équipes')

@section('content')
    @vite(['resources/css/equipe.css'])
        <div class="container">
            <div class="equipe-container">
            <h1 class="section-title">Les équipes</h1>
            <div class="equipes">
                @if($equipes->count())
                    @foreach($equipes as $equipe)
                        <div class="equipe-card">
                            <div class="card-header">
                                <div class="header-content">
                                    <h2>{{ $equipe->nom }}</h2>
                                    <div class="equipe-details">
                                        <span class="badge">Genre: {{ $equipe->genre->genre ?? 'Non spécifié' }}</span>
                                        <span class="badge">{{ $equipe->joueurs->count() }} joueurs</span>
                                    </div>
                                </div>
                                <img src="{{ $equipe->logo }}" width="50" alt="">
                            </div>
                            <ul class="joueurs-list">
                                @if($equipe->joueurs)
                                    @foreach($equipe->joueurs as $joueur)
                                        <li>
                                            <div class="joueur-info">
                                                @if($joueur->photo)
                                                    <img src="{{ asset($joueur->photo->src) }}" class="joueur-photo" alt="Photo de {{ $joueur->nom }}"/>
                                                @else
                                                    <div class="joueur-photo-placeholder">{{ substr($joueur->prenom, 0, 1) }}{{ substr($joueur->nom, 0, 1) }}</div>
                                                @endif
                                                <a href="{{ route('home.show', $joueur->id) }}">
                                                    {{ $joueur->nom }} {{ $joueur->prenom }}
                                                </a>
                                            </div>
                                            <div class="joueur-badges">
                                                <span class="joueur-position">{{ $joueur->position->position ?? '-' }}</span>
                                                <span class="joueur-genre">{{ $joueur->genre->genre ?? '-' }}</span>
                                            </div>
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
        </div>
@endsection