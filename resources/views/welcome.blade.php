<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <title>TeachMe - Bienvenue</title>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-light">
    <img alt="logo TeachMe"
         src="{{ URL::to("./img/logo-site.png")}}"
         class="block h-16 w-auto mb-2" style="height: 48px; margin-left: 127.5px">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navCollapse">

    @if (Route::has('login'))
        @auth
            <!-- Navigation Links -->
                <div class="mb-2" style="font-size: 14px">
                    <ul class="navbar-nav ml-auto">
                        <a href="/"
                           style="text-decoration: none; color:#F58F19">
                            Accueil
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="/courses"
                           style="text-decoration: none; color:#1062AB">
                            Cours
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="/credits"
                           style="text-decoration: none; color:#F21D2F">
                            Informations
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="/contact" class="text-decoration-none" style="color:#18AB4A">
                            Contact
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="/user/profile" class="text-decoration-none" style="color:#bf1784">
                            Profil
                        </a>
                    </ul>

                    @endif
                    @endif

                    @guest
                        <ul class="navbar-nav ml-auto">
                            <a href="{{ route('login') }}" class="mr-4 text-dark text-decoration-none">Se connecter</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-dark text-decoration-none">S'inscrire</a>
                            @endif
                        </ul>
                    @endguest
                </div>
    </div>
</nav>

<div class="jumbotron" style="background-image: url('img/banner.png'); background-size: cover">
    <h1 class="display-1 text-center p-2 " style="color:white; font-weight: bold;
     border-radius: 30px;">Nous rejoindre, c'est assurer son
        avenir</h1>
    <div class="text-center" style="margin-bottom: 11%; margin-top: 11%">
        @guest
            <a class="btn btn-success btn-lg px-5 py-4 rounded-pill" href="{{ route('register') }}" role="button">Je
                veux m'inscrire !</a>
        @endif
        @auth
            <a class="btn btn-success btn-lg px-5 py-4 rounded-pill" href="{{ route('register') }}" role="button">Je
                veux voir les cours disponibles !</a>
        @endif
    </div>
</div>

<div class="container">
    <h1 class="text-center text-success">Pourquoi utiliser nos services ?</h1>

    <div class="card-deck pt-3 pb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Passer au niveau supérieur <i class="fas fa-school"></i></h5>
                <p class="card-text">S'il vous manque quelques points afin de valider votre année scolaire et d'accéder
                    à la classe supérieure, nos professeurs et leur pédagogie à toute épreuve saura vous sauver.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Se construire un dossier solide <i class="fas fa-book"></i></h5>
                <p class="card-text">Afin d'entrer dans une école réputée, vous aurez besoin d'un excellent dossier.
                    Préparez votre futur ou celui de votre enfant dès aujourd'hui.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pour un concours <i class="fas fa-trophy"></i></h5>
                <p class="card-text">L'atteinte de vos objectifs peut passer par un concours ou un examen d'entrée. Nous
                    pouvons vous donner les moyens de le réussir, trouvez un cours dès maintenant ! </p>
            </div>
        </div>
    </div>

</div>

<div class="composer col-lg-10 mx-auto text-center pb-5">
    <h1 class="text-success pb-4">Découvrez ce que nos étudiants et leurs professeurs pensent de notre site</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="8000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" style=" width: 80%; margin: 0 auto; border-radius: 8px">
            <div class="carousel-item active">
                <img class="d-block w-100"
                     src="img/Temoignage_Etudiante.png"
                     alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100"
                     src="img/Temoignage_Prof.png"
                     alt="Second slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100"
                     src="img/Temoignage_Lyceen.png"
                     alt="Third slide">
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<footer class="mt-5 py-2"
        style="bottom: 0; width: 100%; background-color: #D4EDDA;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row border-bottom pb-2">
            <h5 class="mr-0 mr-md-5 mb-0 order-1 order-md-2"><a class="text-decoration-none text-center" href="#">TeachMe</a>
            </h5>
            @guest
                <ul class="nav order-3 order-md-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">S'inscrire</a></li>
                </ul>
            @endguest
            @auth
                <ul class="nav order-3 order-md-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('credits') }}">Informations</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            <p class="mb-0 small text-muted">© TeachMe | Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
</html>

