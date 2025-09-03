@extends('layouts.front_layout')

@section('title', $equipe->nom)

@section('content')
    @vite(['resources/css/equipe-show.css'])
    <div class="container">
        <div class="equipe-detail-container">
            <div class="equipe-header">
                <div class="equipe-logo-container">
                    @if($equipe->logo)
                        <img src="{{ asset($equipe->logo) }}" alt="{{ $equipe->nom }}" class="equipe-logo">
                    @else
                        <div class="equipe-logo-placeholder">
                            {{ substr($equipe->nom, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="equipe-info">
                    <h1>{{ $equipe->nom }}</h1>
                    <div class="equipe-badges">
                        <span class="badge">{{ $equipe->ville }}</span>
                        <span class="badge">{{ $equipe->continent->nom ?? 'International' }}</span>
                        <span class="badge">{{ $equipe->genre->genre ?? 'Mixte' }}</span>
                        <span class="badge">{{ $equipe->joueurs->count() }} joueurs</span>
                    </div>
                </div>
            </div>
            
            <div class="equipe-content">
                <h2 class="section-heading">Liste des joueurs</h2>
                
                @if($equipe->joueurs->count())
                    <div class="joueurs-grid">
                        @foreach($equipe->joueurs as $joueur)
                            <div class="joueur-card">
                                <div class="joueur-photo">
                                    @if($joueur->photo)
                                        <img src="{{ asset($joueur->photo->src) }}" alt="{{ $joueur->nom }}">
                                    @else
                                        <div class="joueur-photo-placeholder">
                                            {{ substr($joueur->prenom, 0, 1) }}{{ substr($joueur->nom, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="joueur-info">
                                    <h3>{{ $joueur->nom }} {{ $joueur->prenom }}</h3>
                                    <div class="joueur-details">
                                        <span>{{ $joueur->age }} ans</span>
                                        <span class="position-badge">{{ $joueur->position->position ?? 'Non défini' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('home.show', $joueur->id) }}" class="btn-details">Voir profil</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-results">
                        <p>Aucun joueur dans cette équipe.</p>
                    </div>
                @endif
            </div>
            
            <div class="back-link">
                <a href="{{ route('home.equipe') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Retour à la liste des équipes
                </a>
            </div>
        </div>
    </div>
@endsection