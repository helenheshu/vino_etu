<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        *{margin:0;padding:0}html{color:#343b41;font-family:Raleway,sans-serif;font-size:16px;height:100%;line-height:1.4}h1{font-weight:400;line-height:1.3;margin:3rem 0 1.38rem}h1{color:#7a5958;font-family:Acme,sans-serif;font-size:1.563rem;text-align:center}*+*,h1{margin:0;padding:0}body{display:flex;flex-direction:column;height:100%;justify-content:space-between}img{height:39.06px;width:39.06px}.logo{height:76.29px;width:76.29px}#body_container{display:flex;flex-direction:column;height:100%}header{flex:0 0 auto}main{flex:1 0 auto;padding-bottom:2em}.flex-row{align-items:center;display:flex;flex-direction:row}.flex-box{margin-left:auto;margin-right:auto;max-width:600px;padding:.64rem}.flex-center{align-items:center;display:flex;flex-direction:column}nav .sidenav-trigger{margin:0}.container{max-width:inherit;text-align:center}.btn-small{background-color:#99aaa2}.btn-small{text-transform:none}.material-icons{word-wrap:normal;-webkit-font-feature-settings:"liga";-webkit-font-smoothing:antialiased;color:#fff;direction:ltr;display:inline-block;font-family:Material Icons;font-size:50px;font-style:normal;font-weight:400;letter-spacing:normal;line-height:1;text-transform:none;white-space:nowrap}.titre-formulaire{color:#742f30;font-family:Raleway,sans-serif;font-size:1.953rem;line-height:1.4}.couleur-noire{color:#343b41}
        .footer-nav{align-items:center;background-color:#cdced1;bottom:0;display:none;gap:.5em;opacity:1;position:fixed;width:100%;z-index:999}.footer-nav i{color:#000;font-size:40px}.footer-nav span{font-weight:700}
        .black-text{color:#000!important}.white{background-color:#fff!important}html{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;line-height:1.15}body{margin:0}header,nav{display:block}h1{font-size:2em;margin:.67em 0}main{display:block}a{-webkit-text-decoration-skip:objects;background-color:transparent}img{border-style:none}button,input{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button{text-transform:none}[type=submit],button{-webkit-appearance:button}[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}html{box-sizing:border-box}*,:after,:before{box-sizing:inherit}button,input{font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif}ul:not(.browser-default){list-style-type:none;padding-left:0}ul:not(.browser-default)>li{list-style-type:none}a{color:#039be5}.z-depth-0{box-shadow:none!important}.btn-small,.card,.sidenav,.z-depth-1,nav{box-shadow:0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.12),0 1px 5px 0 rgba(0,0,0,.2)}i{line-height:inherit}@media only screen and (max-width:992px){.hide-on-med-and-down{display:none!important}}.center{text-align:center}.left{float:left!important}.right{float:right!important}.material-icons{text-rendering:optimizeLegibility;font-feature-settings:"liga"}.container{margin:0 auto;max-width:1280px;width:90%}@media only screen and (min-width:601px){.container{width:85%}}@media only screen and (min-width:993px){.container{width:70%}}.col .row{margin-left:-.75rem;margin-right:-.75rem}.row{margin-bottom:20px;margin-left:auto;margin-right:auto}.row:after{clear:both;content:"";display:table}.row .col{box-sizing:border-box;float:left;min-height:1px;padding:0 .75rem}.row .col.s6{left:auto;margin-left:auto;right:auto}.row .col.s6{width:50%}.row .col.s12{left:auto;margin-left:auto;right:auto}.row .col.s12{width:100%}@media only screen and (min-width:601px){.row .col.m12{left:auto;margin-left:auto;right:auto}.row .col.m12{width:100%}}nav{background-color:#ee6e73;color:#fff;height:56px;line-height:56px;width:100%}nav.nav-extended{height:auto}nav.nav-extended .nav-wrapper{height:auto;min-height:56px}nav.nav-extended .nav-content{line-height:normal;position:relative}nav a{color:#fff}nav i,nav i.material-icons{display:block;font-size:24px;height:56px;line-height:56px}nav .nav-wrapper{height:100%;position:relative}@media only screen and (min-width:993px){nav a.sidenav-trigger{display:none}}nav .sidenav-trigger{float:left;height:56px;margin:0 18px;position:relative;z-index:1}nav .sidenav-trigger i{height:56px;line-height:56px}nav ul{margin:0}nav ul li{float:left;padding:0}nav ul a{color:#fff;display:block;font-size:1rem;padding:0 15px}@media only screen and (min-width:601px){nav.nav-extended .nav-wrapper{min-height:64px}nav,nav .nav-wrapper i,nav a.sidenav-trigger,nav a.sidenav-trigger i{height:64px;line-height:64px}}a{text-decoration:none}html{color:rgba(0,0,0,.87);font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;font-weight:400;line-height:1.5}@media only screen and (min-width:0){html{font-size:14px}}@media only screen and (min-width:992px){html{font-size:14.5px}}@media only screen and (min-width:1200px){html{font-size:15px}}h1{font-weight:400;line-height:1.3}h1{font-size:4.2rem;margin:2.8rem 0 1.68rem}h1{line-height:110%}.card{background-color:#fff;border-radius:2px;margin:.5rem 0 1rem}.card{position:relative}.card .card-content{border-radius:0 0 2px 2px;padding:24px}.tabs{background-color:#fff;height:48px;margin:0 auto;overflow-x:auto;overflow-y:hidden;position:relative;white-space:nowrap;width:100%}.tabs.tabs-transparent{background-color:transparent}@media only screen and (max-width:992px){.tabs{display:flex}}.btn-small{border:none;border-radius:2px;display:inline-block;height:36px;line-height:36px;padding:0 16px;text-transform:uppercase;vertical-align:middle}.btn-small{font-size:14px;outline:0}.btn-small{background-color:#26a69a;color:#fff;letter-spacing:.5px;text-align:center;text-decoration:none}.btn-small{font-size:13px;height:32.4px;line-height:32.4px}.waves-effect{display:inline-block;overflow:hidden;position:relative;vertical-align:middle;z-index:1}label{color:#9e9e9e;font-size:.8rem}::-moz-placeholder{color:#d1d1d1}:-ms-input-placeholder{color:#d1d1d1}::placeholder{color:#d1d1d1}input[type=email]:not(.browser-default),input[type=password]:not(.browser-default){background-color:transparent;border:none;border-bottom:1px solid #9e9e9e;border-radius:0;box-shadow:none;box-sizing:content-box;font-size:16px;height:3rem;margin:0 0 8px;outline:0;padding:0;width:100%}input[type=email]:not(.browser-default).validate+label,input[type=password]:not(.browser-default).validate+label{width:100%}input[type=email]:not(.browser-default)+label:after,input[type=password]:not(.browser-default)+label:after{content:"";display:block;left:0;opacity:0;position:absolute;top:100%}.input-field{margin-bottom:1rem;margin-top:1rem;position:relative}.input-field.col label{left:.75rem}.input-field>label{color:#9e9e9e;font-size:1rem;left:0;position:absolute;text-align:initial;top:0;transform:translateY(12px);transform-origin:0 100%}.input-field>input[type]:-webkit-autofill:not(.browser-default):not([type=search])+label{transform:translateY(-14px) scale(.8);transform-origin:0 0}.sidenav{-webkit-backface-visibility:hidden;backface-visibility:hidden;background-color:#fff;height:calc(100% + 60px);height:100%;left:0;margin:0;overflow-y:auto;padding-bottom:60px;position:fixed;top:0;transform:translateX(-100%);transform:translateX(-105%);width:300px;will-change:transform;z-index:999}.sidenav li{float:none;line-height:48px}.sidenav li>a{color:rgba(0,0,0,.87);display:block;font-size:14px;font-weight:500;height:48px;line-height:48px;padding:0 32px}
    </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>In Vino Veritas</title>
    <link rel="icon" href="{{asset('assets/logo/vino-logo-v2.svg') }}">
    <!-- Polices  -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    
</head>

<body>
<div id="body_container">
    <header class="flex-row padding-1rem z-depth-1">
            <!-- Voir la navigation !!! -->
        <a href="{{ route('cellier') }}" class="brand-logo left "><img class="logo" src="{{asset('assets/logo/vino-logo-v2.svg')}}" alt="logo InVino"></a>

        <nav class="nav-extended white z-depth-0">
            
<<<<<<< HEAD
            <div class="nav-wrapper">
                <a href="#" class="sidenav-trigger right" data-target="mobile-links"><i class="material-icons" style="font-size: 48px;"><span class=" couleur-noire  md-48">menu</span></i></a>
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
=======
>>>>>>> cf7a6488da80e9395a65668d1a69488c8ce591ad
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
            <div class="nav-content  white">  <!-- j'ai enlevé la class row, pour rendre la navigaiton plus serré -->
                <div class="col s6">
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



    <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Acme&display=swap"
    media="print"
    onload="this.media='all'"
/>
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap"
    media="print"
    onload="this.media='all'"
/>
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap"
    media="print"
    onload="this.media='all'"
/>
    <link href="{{asset('css/footer-nav.css')}}" rel="stylesheet" media="print"
    onload="this.media='all'" />
    <link  rel="stylesheet" href="{{asset('css/materialize.min.css')}}" media="print"
    onload="this.media='all'">
    <link href="{{asset('css/main.css')}}" rel="stylesheet" media="print"
    onload="this.media='all'" />
<noscript>
    <link
        href="https://fonts.googleapis.com/css2?family=Acme&display=swap"
        rel="stylesheet"
        type="text/css"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap"
        rel="stylesheet"
        type="text/css"
    />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap"
        rel="stylesheet"
        type="text/css"
    />
    <link href="{{asset('css/footer-nav.css')}}" rel="stylesheet" />
    <link  rel="stylesheet" href="{{asset('css/materialize.min.css')}}" >
    <link href="{{asset('css/main.css')}}" rel="stylesheet"  />
</noscript>

    <script src="{{asset('js/materialize.min.js')}}"defer></script>
    <script src="{{asset('js/scripts.js')}}"defer></script>
    <script src="{{asset('js/app.js')}}"defer></script>
</div>
</body>

</html>