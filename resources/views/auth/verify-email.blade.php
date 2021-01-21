<!DOCTYPE html>
<body style="background: #D4EDDA">
<div class="card text-center mx-auto p-5" style="margin-top: 30px; width: fit-content; border:none; background: linear-gradient(#D4EDDA, white);">
    <div class="card-body">
        <div class="card-text">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <x-slot name="logo">
                        <img alt="logo TeachMe" src={{ URL::to("./img/logo-site.png")}}>
                    </x-slot>
                    <div class="mb-4 text-xl text-gray-600 p-4" >
                        {{ __('Merci pour votre inscription! Avant de commencer, pouvez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons un autre.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de l\'inscription.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div  class="p-2">
                                <x-jet-button type="submit">
                                    {{ __('Renvoyer l\'e-mail de vérification') }}
                                </x-jet-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Déconnexion') }}
                            </button>
                        </form>
                    </div>
                    <a href='/' type="submit" class="btn btn-success mt-3 mb-4">Retour</a>
                </x-jet-authentication-card>
            </x-guest-layout>
        </div>
    </div>
</div>
</body>
