@extends('layouts.front_layout')

@section('title', $joueur->prenom . ' ' . $joueur->nom)

@section('content')
    @vite(['resources/css/joueur-show.css'])
    <div class="container">
        <div class="joueur-detail-container">
            <div class="joueur-profile">
                <div class="joueur-header {{ $joueur->genre && $joueur->genre->genre == 'femme' ? 'joueur-header-female' : '' }}">
                    @if($joueur->photo)
                        <img src="{{ asset($joueur->photo->src) }}" alt="{{ $joueur->nom }}" class="joueur-img">
                    @else
                        <div class="joueur-img-placeholder">
                            {{ substr($joueur->prenom, 0, 1) }}{{ substr($joueur->nom, 0, 1) }}
                        </div>
                    @endif
                    <div class="player-rating">{{ rand(75, 95) }}</div>
                    <div class="player-position">{{ $joueur->position->position ?? 'N/A' }}</div>
                </div>
                
                <div class="joueur-info">
                    <h1>{{ $joueur->prenom }} {{ $joueur->nom }}</h1>
                    
                    <div class="joueur-badges">
                        <div class="badge">
                            <span class="label">Âge</span>
                            <span class="value">{{ $joueur->age }} ans</span>
                        </div>
                        <div class="badge">
                            <span class="label">Pays</span>
                            <span class="value">{{ $joueur->pays }}</span>
                        </div>
                        <div class="badge">
                            <span class="label">Position</span>
                            <span class="value">{{ $joueur->position->position ?? 'Non défini' }}</span>
                        </div>
                        <div class="badge">
                            <span class="label">Genre</span>
                            <span class="value">{{ $joueur->genre->genre ?? 'Non défini' }}</span>
                        </div>
                    </div>
                    
                    <div class="player-stats-container">
                        <h2 class="stats-title">Statistiques</h2>
                        <div class="player-stats">
                            @php
                                // Générer les statistiques une fois pour les réutiliser
                                $stats = [
                                    'Vitesse' => rand(60, 99),
                                    'Tir' => rand(60, 99),
                                    'Passe' => rand(60, 99),
                                    'Dribble' => rand(60, 99),
                                    'Défense' => rand(60, 99),
                                    'Physique' => rand(60, 99)
                                ];
                            @endphp
                            
                            @foreach($stats as $label => $value)
                                <div class="stat-bar">
                                    <span class="stat-label">{{ $label }}</span>
                                    <div class="stat-track">
                                        <div class="stat-fill" style="width: {{ $value }}%"></div>
                                    </div>
                                    <span class="stat-value">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="joueur-equipe-section">
                        @if($joueur->equipe)
                            <h3>Équipe actuelle</h3>
                            <div class="equipe-card">
                                @if($joueur->equipe->logo)
                                    <img src="{{ asset($joueur->equipe->logo) }}" alt="{{ $joueur->equipe->nom }}" class="equipe-logo">
                                @endif
                                <div class="equipe-info">
                                    <h4>{{ $joueur->equipe->nom }}</h4>
                                    <p>{{ $joueur->equipe->joueurs->count() }} joueurs</p>
                                </div>
                                <a href="{{ route('home.equipe.show', $joueur->equipe->id) }}" class="btn-equipe">Voir l'équipe</a>
                            </div>
                        @else
                            <div class="sans-equipe">
                                <h3>Statut : Agent libre</h3>
                                <p>Ce joueur n'appartient actuellement à aucune équipe.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="back-link">
                <a href="{{ route('home.joueur') }}" class="btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Retour à la liste des joueurs
                </a>
            </div>
        </div>
    </div>
@endsection