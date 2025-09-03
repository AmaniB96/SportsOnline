@extends('layouts.front_layout')

@section('title', 'Accueil')

@section('content')
    @vite(['resources/css/home.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <div class="hero-carousel">
    <div id="sportsCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicateurs -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#sportsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#sportsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#sportsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        
        <!-- Contenu du carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="overlay"></div>
                <img src="https://wallpapercave.com/wp/wp4430266.jpg" class="d-block w-100" alt="Football">
                <div class="carousel-caption">
                    <h2>Le football dans toute sa splendeur</h2>
                    <p>Découvrez les plus grandes équipes européennes</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay"></div>
                <img src="https://wallpapercave.com/wp/wp5141406.jpg" class="d-block w-100" alt="Joueurs">
                <div class="carousel-caption">
                    <h2>Les meilleurs joueurs du monde</h2>
                    <p>Découvrez les athlètes qui font vibrer les stades</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay"></div>
                <img src="https://wallpapercave.com/wp/J8wrQqn.jpg" class="d-block w-100" alt="International">
                <div class="carousel-caption">
                    <h2>Le football international</h2>
                    <p>Des équipes venues des quatre coins du monde</p>
                </div>
            </div>
        </div>
        
        <!-- Contrôles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#sportsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#sportsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>

    <!-- Section Équipes européennes -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Équipes Européennes</h2>
            <div class="teams-grid">
                @foreach($equipesEurope as $equipe)
                    <div class="team-card">
                        @if($equipe->logo)
                            <img src="{{ asset($equipe->logo) }}" class="team-logo" alt="{{ $equipe->nom }}">
                        @else
                            <div class="team-logo-placeholder">{{$equipe->nom}}</div>
                        @endif
                        <h3>{{ $equipe->nom }}</h3>
                        <div class="team-info">
                            <span>{{ $equipe->joueurs->count() }} joueurs</span>
                            <a href="{{ route('home.equipe') }}" class="btn-view">Voir l'équipe</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 8 joueurs random équipes européennes -->
    <section class="section section-alt">
        <div class="container">
            <h2 class="section-title">Joueurs Européens en Vedette</h2>
            <div class="players-grid">
                @foreach($joueursEurope as $joueur)
                    <div class="fut-card">
                        <div class="fut-card-header">
                            <div class="fut-rating">{{ rand(75, 95) }}</div>
                            <div class="fut-position">{{ $joueur->position->position ?? 'ATT' }}</div>
                            @if($joueur->equipe && $joueur->equipe->logo)
                                <img src="{{ asset($joueur->equipe->logo) }}" class="fut-team-logo" alt="">
                            @endif
                        </div>
                        <div class="fut-card-content">
                            @if($joueur->photo)
                                <img src="{{ asset($joueur->photo->src) }}" height="200" class="fut-player-img" alt="{{ $joueur->nom }}">
                            @endif
                            <div class="fut-player-name">{{ $joueur->nom }} {{$joueur->prenom}}</div>
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
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section Équipes hors Europe -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Équipes Internationales</h2>
            <div class="teams-grid">
                @foreach($equipesHorsEurope as $equipe)
                    <div class="team-card">
                        @if($equipe->logo)
                            <img src="{{ asset($equipe->logo) }}" class="team-logo" alt="{{ $equipe->nom }}">
                        @else
                            <div class="team-logo-placeholder">{{ substr($equipe->nom, 0, 1) }}</div>
                        @endif
                        <h3>{{ $equipe->nom }}</h3>
                        <div class="team-info">
                            <span>{{ $equipe->joueurs->count() }} joueurs</span>
                            <a href="{{ route('home.equipe') }}" class="btn-view">Voir l'équipe</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 8 joueuses random hors Europe -->
    <section class="section section-alt">
        <div class="container">
            <h2 class="section-title">Joueuses Internationales</h2>
            <div class="players-grid">
                @foreach($joueusesHorsEurope as $joueuse)
                    <div class="fut-card fut-card-female">
                        <div class="fut-card-header">
                            <div class="fut-rating">{{ rand(75, 95) }}</div>
                            <div class="fut-position">{{ $joueuse->position->position ?? 'ATT' }}</div>
                            @if($joueuse->equipe && $joueuse->equipe->logo)
                                <img src="{{ asset($joueuse->equipe->logo) }}" class="fut-team-logo" alt="">
                            @endif
                        </div>
                        <div class="fut-card-content">
                            @if($joueuse->photo)
                                <img src="{{ asset($joueuse->photo->src) }}" class="fut-player-img" alt="{{ $joueuse->nom }}">
                            @endif
                            <div class="fut-player-name">{{ $joueuse->prenom }} {{ $joueuse->nom }}</div> 
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
                            <a href="{{ route('home.show', $joueuse->id) }}" class="btn-details">Voir détails</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section Joueurs sans équipe -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Agents Libres</h2>
            <div class="players-grid">
                @if ($joueursSansEquipe->count())
                @foreach($joueursSansEquipe as $joueur)
                    <div class="fut-card fut-card-free">
                        <div class="fut-card-header">
                            <div class="fut-rating">{{ rand(75, 95) }}</div>
                            <div class="fut-position">{{ $joueur->position->position ?? 'ATT' }}</div>
                            <div class="free-agent">LIBRE</div>
                        </div>
                        <div class="fut-card-content">
                            @if($joueur->photo)
                                <img src="{{ asset( $joueur->photo->src) }}" class="fut-player-img" alt="{{ $joueur->nom }}">
                            @endif
                            <div class="fut-player-name">{{ $joueur->nom }}</div>
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
                @endforeach
                    
                @else
                    <p>Pas de joueurs/joueuse actuellement dans cette section.</p>
                @endif
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </section>