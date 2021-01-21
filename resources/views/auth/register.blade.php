<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel='stylesheet'>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        window.onload = function () {
            const recaptcha = document.querySelector('#g-recaptcha-response');

            if (recaptcha) {
                recaptcha.setAttribute("required", "required");
            }
        }
    </script>

    <title>TeachMe - Bienvenue</title>
</head>
<body
    style="background-image: url('img/register.png'); background-size: cover">
<div class="card text-center mx-auto mb-5" style="margin-top: 10px; width: 500px; border-radius: 25px">
    <div class="card-body">
        <div class="card-text">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <img class="mx-auto" alt="logo TeachMe" src={{ URL::to("./img/logo-site.png")}}>
                        <div class="mx-auto text-sm" style="font-size: large; font-weight: bold">
                            <br>
                            {{ __('Rejoignez le réseau TeachMe dès maintenant !') }}
                            <br>
                            {{ __('Créez votre compte en quelques secondes.') }}
                        </div>
                    </x-slot>

                    <x-jet-validation-errors class="mb-4"></x-jet-validation-errors>

                    <form method="POST" action="{{ route('register') }}" class="align-content-center"
                          onsubmit="checkIfCaptchaIsFilled">
                    @csrf

                    <!-- AJOUTS DES VALEURS DANS LE FORMULAIRE DE CRÉATION DE COMPTE -->

                        <!-- Nom -->
                        <div>
                            <x-jet-label class="mt-3" value="{{ __('Nom') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                                         autofocus
                                         autocomplete="name"></x-jet-input>
                        </div>

                        <!-- Prénom -->
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Prénom') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="text" name="firstName"
                                         :value="old('firstName')"
                                         required autofocus
                                         autocomplete="firstName"></x-jet-input>
                        </div>

                        <!-- Rôle -->
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Rôle') }}"></x-jet-label>
                        </div>
                        <div>
                            <label class="inline-flex items-center ml-3">
                                <input class="form-radio text-green-500" type="radio" name="role" value="professeur"
                                       :value="old('professeur')"
                                       required autofocus
                                       autocomplete="role">
                                <span class="ml-2">Professeur</span>
                            </label>

                            <label class="inline-flex items-center ml-3">
                                <input class="form-radio text-pink-600" type="radio" name="role" value="etudiant"
                                       :value="old('etudiant')"
                                       required autofocus
                                       autocomplete="role">
                                <span class="ml-2">Étudiant</span>
                            </label>
                        </div>

                        <!-- Email -->
                        <div class="mt-2">
                            <x-jet-label value="{{ __('Email') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                         required></x-jet-input>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Mot de passe') }} "></x-jet-label>
                            <span class="font-italic" style="color: grey; font-size: 12px"><u>(8 caractères</u> dont <u>une majuscule</u>, <u>un chiffre</u> et <u>un caractère spécial</u> minimum).</span>

                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="password" name="password" required
                                         autocomplete="new-password"></x-jet-input>
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Confirmer le mot de passe') }}"></x-jet-label>
                        </div>
                        <div>
                            <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required
                                         autocomplete="new-password"></x-jet-input>
                        </div>
                        <br>
                        <div class="mx-auto items-center">
                            <div class="g-recaptcha"
                                 data-callback="captchaFilled"
                                 data-expired-callback="captchaExpired"
                                 data-sitekey="6LfhpdcZAAAAAIAC77M9KCek-30DLCmkLyJOwi3P"></div>
                        </div>

                        <div class="mt-4">
                            <input type="checkbox" id="cgu" name="cgu">
                            <label for="cgu"> J'accepte les
                                <a href="/img/cgu.pdf" target="_blank">
                                    Conditions Générales d'Utilisation
                                </a>
                            </label>

                        </div>

                        <div class="items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Déjà inscrit ? Connectez-vous') }}
                            </a>

                            <x-jet-button class="ml-4 mb-3" id="inscription" disabled="disabled">
                                {{ __('S\'inscrire') }}
                            </x-jet-button>
                            <script>
                                $('input[name=cgu]').change(function () {
                                    if ($(this).is(':checked')) {
                                        $('#inscription').removeAttr('disabled', 'disabled');
                                    } else {
                                        $('#inscription').attr('disabled', '');
                                    }
                                });
                            </script>
                        </div>
                        <a href='/' type="submit" class="btn btn-success mt-3 mb-4">Retour à l'accueil</a>
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

