<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>In Vino Veritas</title>
    
    <link rel="stylesheet" href="{{asset('css/layout.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/boutons.css')}}"/>

    <link rel="icon" href="{{asset('assets/logo/vino-logo-v2.svg') }}">
    <!-- Polices  -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="{{asset('css/footer-nav.css')}}" rel="stylesheet"/>
    <link  rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    <link href="{{asset('css/main.css')}}" rel="stylesheet"  />
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Acme&display=swap"
    
/>
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap"
    
/>
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap"
    
/>
</head>

<body>

<div id="body_container">
    <header class="flex-row padding-1rem z-depth-1 nav-padding">
            <!-- Voir la navigation !!! -->
        <a href="{{ route('cellier') }}" class="logo-lien"><img class="logo" src="{{asset('assets/logo/vino-logo-v2.svg')}}" alt="logo InVino"></a>

        <nav class="nav-extended white z-depth-0">
            
            <ul class="sidenav" id="mobile-links">
               
                @guest
                    <li><a href="{{ route('register') }}">S'inscrire</a></li>
                    <li><a href="{{ route('login') }}">Se connecter</a></li>
                @else
                    @if( session('user')->admin === 1)
                    <li><a href="{{ route('importerBouteille') }}">Importer bouteille</a></li>
                    <li><a href="{{ route('gererUsagers') }}">Gérer des usagers</a></li>
                    <li><a href="{{ route('modifierCatalogue') }}">Modification de bouteilles</a></li>
                    @else
                    <li><a href="{{ route('cellier') }}">Vos celliers</a></li>
                    <li><a href="{{ route('dashboard') }}"><span class="black-text">Mon Compte</span></a></li>
                    @endif
                    <li><a href="{{ route('logout') }}"><span class="black-text">Se déconnecter</span></a></li>
                @endguest
            </ul>
            <div class="nav-content white">
                
                    <ul class="tabs tabs-transparent hide-on-med-and-down">
                    @guest
                    @else
                    @if( session('user')->admin == 1)
                    <li class="tab"><a href="{{ route('importerBouteille') }}"><span class="black-text">Importer bouteille</span></a></li>
                    <li class="tab"><a href="{{route('gererUsagers') }}"><span class="black-text">Gérer des usagers</span></a></li>
                    <li class="tab"><a href="{{route('modifierCatalogue') }}"><span class="black-text">Modification de bouteilles</span></a></li>
                    @else
                        <li class="tab"><a href="{{ route('cellier') }}"><span class="black-text">Vos celliers</span></a></li>
                         <li class="tab"><a href="{{ route('dashboard') }}"><span class="black-text">Mon Compte</span></a></li>
                    @endif
                    @endguest
                    </ul>
                
            </div>
            <div class="nav-wrapper">
                <a href="#" class="sidenav-trigger right" data-target="mobile-links"><i class="material-icons" style="font-size: 50px;"><span class=" couleur-noire  md-48">menu</span></i></a>
                <ul class="right hide-on-med-and-down">
                    @guest
                    <li><a href="{{ route('register') }}"><span class="black-text">S'inscrire</span></a></li>
                    <li><a href="{{ route('login') }}"><span class="black-text">Se connecter</sapn></a></li>
                    @else
                    <li><a href="{{ route('logout') }}"><span class="black-text">Se déconnecter</span></a></li>
                    <li><a href="{{ route('dashboard') }}"><i class="large material-icons"><span class="black-text">account_circle</span></i></a></li>
                    @endguest
                </ul>
            </div>
        </nav>

    </header>
    <main>

    @yield('content')
    </main>

    
    <!-- Footer -->
    @guest
    @else
    @if(session('user')->admin !== 1)
    <footer class="footer text-faded text-center py-5">
        <div class="container footer-nav precedent z-depth-1">
        <i class="material-icons">navigate_before</i>
        <span>Retour</span>
            
        </div>
    </footer>
    @endif
    @endguest

   
</div>
<script src="{{asset('js/materialize.min.js')}}"defer></script>
    <script src="{{asset('js/scripts.js')}}"defer></script>
    <script src="{{asset('js/app.js')}}"defer></script>
</body>

</html>