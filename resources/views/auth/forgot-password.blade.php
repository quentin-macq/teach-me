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
<body
    style="background-image: url('img/register.png'); background-size: cover">
<div class="card text-center mx-auto" style="margin-top: 100px; width: 500px; border-radius: 25px">
    <div class="card-body">
        <div class="card-text">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <img alt="logo TeachMe" src={{ URL::to("./img/logo-site.png")}}>
                    </x-slot>

                    <div class="mt-4 mb-4 text-sm text-gray-600" style="font-size: large; font-weight: bold">
                        {{ __('Mot de passe oublié ? Aucun problème.') }}
                        <br>
                        {{ __('Indiquez nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation.') }}
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mb-4"></x-jet-validation-errors>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="block">
                            <x-jet-label value="{{ __('Email') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                         required
                                         autofocus></x-jet-input>
                        </div>

                        <div class="flex items-center justify-center mt-5">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('login') }}">
                                {{ __('Retourner à la connexion') }}
                            </a>
                            <x-jet-button class="ml-4">
                                {{ __('Envoyer un lien de réinitialisation') }}
                            </x-jet-button>
                        </div>
                    </form>
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
