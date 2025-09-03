@extends('layouts.front_layout')

@section('title', 'Joueurs')

@section('content')
    @vite(['resources/css/joueur.css'])
    <div class="container">
        <div class="joueur-container">
            <h1 class="section-title">Les joueurs</h1>
            
            <!-- Filtres -->
            <div class="filters">
                <div class="dropdown">
                    <button class="dropdown-toggle">
                        <span>{{ request('genre', 'Tous les joueurs') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('home.joueur') }}" class="{{ !request('genre') ? 'active' : '' }}">Tous les joueurs</a>
                        <a href="{{ route('home.joueur', ['genre' => 'Masculin']) }}" class="{{ request('genre') == 'Masculin' ? 'active' : '' }}">Masculin</a>
                        <a href="{{ route('home.joueur', ['genre' => 'Féminin']) }}" class="{{ request('genre') == 'Féminin' ? 'active' : '' }}">Féminin</a>
                    </div>
                </div>
            </div>
            
            <!-- Liste des joueurs -->
            <div class="players-grid">
                @forelse($joueurs as $joueur)
                    <div class="fut-card {{ $joueur->genre && $joueur->genre->genre == 'femme' ? 'fut-card-female' : '' }} {{ !$joueur->equipe ? 'fut-card-free' : '' }}">
                        <div class="fut-card-header">
                            <div class="fut-rating">{{ rand(75, 95) }}</div>
                            <div class="fut-position">{{ $joueur->position->position ?? 'ATT' }}</div>
                            @if($joueur->equipe && $joueur->equipe->logo)
                                <a href="{{ route('home.equipe.show', $joueur->equipe->id) }}" class="equipe-link">
                                    <img src="{{ asset($joueur->equipe->logo) }}" class="fut-team-logo" alt="{{ $joueur->equipe->nom }}">
                                </a>
                            @elseif(!$joueur->equipe)
                                <div class="free-agent">LIBRE</div>
                            @endif
                        </div>
                        <div class="fut-card-content">
                            @if($joueur->photo)
                                <img src="{{ asset($joueur->photo->src) }}" class="fut-player-img" alt="{{ $joueur->nom }}">
                            @else
                                <div class="player-placeholder">{{ substr($joueur->prenom, 0, 1) }}{{ substr($joueur->nom, 0, 1) }}</div>
                            @endif
                            <div class="fut-player-name">{{ $joueur->nom }} {{ $joueur->prenom }}</div>
                            <div class="player-country">{{ $joueur->pays ?? 'International' }}</div>
                            <div class="player-age">{{ $joueur->age ?? '?' }} ans</div>
                            
                            @if($joueur->equipe)
                                <div class="player-club">
                                    <a href="{{ route('home.equipe.show', $joueur->equipe->id) }}" class="club-link">
                                        {{ $joueur->equipe->nom }}
                                    </a>
                                </div>
                            @else
                                <div class="player-club no-club">Agent libre</div>
                            @endif
                            
                            <div class="fut-player-stats">
                                <div class="stat"><span>{{ rand(60, 99) }}</span>VIT</div>
                                <div class="stat"><span>{{ rand(60, 99) }}</span>TIR</div>
                                <div class="stat"><span>{{ rand(60, 99) }}</span>PAS</div>
                                <div class="stat"><span>{{ rand(60, 99) }}</span>DRI</div>
                                <div class="stat"><span>{{ rand(60, 99) }}</span>DEF</div>
                                <div class="stat"><span>{{ rand(60, 99) }}</span>PHY</div>
                            </div>
                        </div>
                        <div class="fut-card-footer">
                            <a href="{{ route('home.show', $joueur->id) }}" class="btn-details">Voir détails</a>
                        </div>
                    </div>
                @empty
                    <div class="no-results">
                        <p>Aucun joueur trouvé.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            
            dropdownToggle.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown')) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
@endsection