<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sports Online')</title>
    @vite(['resources/css/app.css', 'resources/css/footer.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('layouts.Components.nav')
        {{-- @if (session('notAcces'))
            <p class="text-red-600 mt-10">vous n'avez pas les perm</p>
        @endif --}}
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <h3>Sports Online</h3>
                <p>Découvrez les équipes, joueurs et actualités sportives sur notre plateforme dédiée au sport mondial.</p>
            </div>
            
            <div class="footer-links">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('home.equipe') }}">Équipes</a></li>
                    <li><a href="#">Joueurs</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Contactez-nous</h4>
                <p>Email: contact@sportsonline.com</p>
                <p>Téléphone: +32 123 456 789</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SportsOnline. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>
</html>