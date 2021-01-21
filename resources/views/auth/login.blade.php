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
</head>
<body style="background-image: url('img/register.png'); background-size: cover">

<title>TeachMe - Bienvenue</title>

<div class="card text-center mx-auto" style="margin-top: 100px; width: 500px; border-radius: 25px">
    <div class="card-body">
        <div class="card-text">
            <x-guest-layout class="bg-white">
                <x-jet-authentication-card class="bg-white">
                    <x-slot name="logo">
                        <img class="mx-auto" alt="logo TeachMe" src={{ URL::to("./img/logo-site.png")}}>
                    </x-slot>

                    <x-jet-validation-errors class="mb-4"></x-jet-validation-errors>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-jet-label class="mt-3" value="{{ __('Email') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                         requiredautofocus></x-jet-input>
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Mot de passe') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="password" name="password" required
                                         autocomplete="current-password"></x-jet-input>
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                   href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('register') }}">
                                {{ __('Pas encore inscrit ? Inscrivez-vous') }}
                            </a>
                            <x-jet-button class="ml-4">
                                {{ __('Se connecter') }}
                            </x-jet-button>
                        </div>
                    </form>
                    <br>
                    <a href='/' type="submit" class="btn btn-success mt-3 mb-4">Retour à l'accueil</a>
                </x-jet-authentication-card>
            </x-guest-layout>
        </div>
    </div>
</div>

<footer class="mt-5 py-2" style="bottom: 0; width: 100%; background-color: #D4EDDA;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row border-bottom pb-2">
            <h5 class="mr-0 mr-md-5 mb-0 order-1 order-md-2"><a class="text-decoration-none" href="#">TeachMe</a></h5>
            @guest
                <ul class="nav order-3 order-md-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">S'inscrire</a></li>
                </ul>
            @endguest
        </div>
        <div class="d-flex justify-content-center">
            <p class="mb-0 small text-muted">© TeachMe | Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
