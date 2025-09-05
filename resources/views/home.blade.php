@extends('layouts.front_layout')

@section('title', 'Accueil')

@section('content')
    @vite(['resources/css/home.css'])

    <div class="hero-carousel">
        <div id="default-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden md:h-96">
                <!-- Item 1 - YouTube Video -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <div class="overlay absolute inset-0 bg-black/30 z-10 pointer-events-none"></div>
                    <div class="video-container absolute inset-0 w-full h-full">
                        <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/zX0AV6yxyrQ?start=10&autoplay=1&mute=1&enablejsapi=1&controls=0&rel=0&modestbranding=1" 
                            title="YouTube video player" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="carousel-caption absolute z-20 text-center text-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-4 pointer-events-none">
                        <h2 class="text-3xl md:text-4xl font-bold mb-2 text-shadow-lg">La Magie du Football</h2>
                        <p class="text-lg md:text-xl text-shadow-md">Les plus beaux moments du sport roi</p>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="overlay absolute inset-0 bg-black/50 z-10"></div>
                    <img src="https://wallpapercave.com/wp/wp5141406.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Joueurs">
                    <div class="carousel-caption absolute z-20 text-center text-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-4">
                        <h2 class="text-3xl md:text-4xl font-bold mb-2">Les meilleurs joueurs du monde</h2>
                        <p class="text-lg md:text-xl">Découvrez les athlètes qui font vibrer les stades</p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="overlay absolute inset-0 bg-black/50 z-10"></div>
                    <img src="https://wallpapercave.com/wp/J8wrQqn.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="International">
                    <div class="carousel-caption absolute z-20 text-center text-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-4">
                        <h2 class="text-3xl md:text-4xl font-bold mb-2">Le football international</h2>
                        <p class="text-lg md:text-xl">Des équipes venues des quatre coins du monde</p>
                    </div>
                </div>
            </div>
            
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
            
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                    <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                    <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
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
                            <a href="{{ route('home.show', $joueur->id) }}" class="btn-details">Voir détails</a>
                        </div>
                    </div>
                @endforeach
                    
                @else
                    <p>Pas de joueurs/joueuse actuellement dans cette section.</p>
                @endif
            </div>
        </div>
    </section>
@endsection