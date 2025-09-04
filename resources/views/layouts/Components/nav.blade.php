<nav class="fixed top-0 w-full z-50 bg-gray-800 shadow-lg">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-20 items-center justify-between">
      <!-- Logo et navigation principale -->
      <div class="flex items-center justify-start flex-1">
        <div class="flex items-center">
          <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('storage/logo/eliteLogo.png') }}" alt="Elite Sports" class="h-40" />
          </a>
        </div>
        
        <!-- Navigation principale -->
        <div class="hidden md:block ml-10">
          <div class="flex space-x-4">
            <a href="{{ route('home') }}" 
               class="rounded-md px-4 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
              Accueil
            </a>
            <a href="{{ route('home.equipe') }}" 
               class="rounded-md px-4 py-2 text-sm font-medium {{ request()->routeIs('home.equipe*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
              Équipes
            </a>
            <a href="{{ route('home.joueur') }}" 
               class="rounded-md px-4 py-2 text-sm font-medium {{ request()->routeIs('home.joueur*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
              Joueurs
            </a>
          </div>
        </div>
      </div>

      <!-- Navigation admin et profil -->
      <div class="flex items-center space-x-4">
        <!-- Menu administration -->
        @auth
          @if(auth()->user()->isAdmin ?? false)
            <div class="hidden md:flex space-x-2 border-l border-gray-700 pl-4">
              <a href="{{ route('back') }}" 
                 class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('back') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                Dashboard
              </a>
              <a href="{{ route('back.player.index') }}" 
                 class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('back.player*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                Joueurs
              </a>
              <a href="{{ route('back.equipe.index') }}" 
                 class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('back.equipe*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                Équipes
              </a>
              <a href="{{ route('back.user.index') }}" 
                 class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('back.user*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                Utilisateurs
              </a>
            </div>
          @endif
        @endauth

        <!-- Profile dropdown -->
        <div class="relative ml-3 flex items-center">
          @auth
            <div class="hidden md:block mr-4 text-right">
              <p class="text-sm font-medium text-white">{{ auth()->user()->prenom }}</p>
              <p class="text-xs text-gray-400">{{ auth()->user()->nom }}</p>
            </div>
          @endauth
          
          <el-dropdown class="relative">
            <button class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">Open user menu</span>
              <img class="h-10 w-10 rounded-full object-cover border-2 border-primary" 
                   src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                   alt="Photo de profil">
            </button>
            
            <el-menu anchor="top end" popover class="w-48 mt-2 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5">
              @auth
                {{-- <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Votre profil</a> --}}
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
              @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Connexion</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Inscription</a>
              @endauth
            </el-menu>
          </el-dropdown>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button type="button" command="--toggle" commandfor="mobile-menu" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
          <span class="sr-only">Ouvrir le menu</span>
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menu mobile -->
  <el-disclosure id="mobile-menu" hidden class="md:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
      <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Accueil</a>
      <a href="{{ route('home.equipe') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('home.equipe*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Équipes</a>
      <a href="{{ route('home.joueur') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('home.joueur*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Joueurs</a>
      
      @auth
        @if(auth()->user()->isAdmin ?? false)
          <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="px-2 space-y-1">
              <a href="{{ route('back') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('back') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Dashboard</a>
              <a href="{{ route('back.player.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('back.player*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Joueurs</a>
              <a href="{{ route('back.equipe.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('back.equipe*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Équipes</a>
              <a href="{{ route('back.user.index') }}" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('back.user*') ? 'bg-secondary text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">Utilisateurs</a>
            </div>
          </div>
        @endif
      @endauth
    </div>
  </el-disclosure>
</nav>
