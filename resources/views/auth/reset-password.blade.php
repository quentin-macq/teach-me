<!DOCTYPE html>

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
<body style="background-color: #D4EDDA">

<div class="mt-5 card text-center mx-auto" style="margin-top: 10px; width: 500px; border-radius: 25px">
    <div class="card-body">
        <div class="card-text">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <img alt="logo TeachMe" src={{ URL::to("./img/logo-site.png")}}>
                    </x-slot>

                    <x-jet-validation-errors class="mb-4"></x-jet-validation-errors>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="block">
                            <x-jet-label  class="mt-3" value="{{ __('Email') }}"></x-jet-label>
                            <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                                         required autofocus></x-jet-input>
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Mot de passe') }}"></x-jet-label>
                            <x-jet-input class="block mt-1 w-full" type="password" name="password" required
                                         autocomplete="new-password"></x-jet-input>
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Confirmer le mot de passe') }}"></x-jet-label>
                            <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required
                                         autocomplete="new-password"></x-jet-input>
                        </div>

                        <div class="flex items-center justify-center mt-4 mb-4">
                            <x-jet-button>
                                {{ __('Réinitialiser le mot de passe') }}
                            </x-jet-button>
                        </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>
        </div>
    </div>
</div>

</body>
