<template>
    <app-layout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Les informations sur le projet
            </h1>
        </template>

        <div class="card text-center mx-auto " style="margin-top: 10px; width: 500px; border-radius: 25px">
            <div class="card-body">
                <div class="card-text">
                    <h3>Projet de semestre 5 : Site de cours en ligne</h3>
                    <br>
                    <h4>Consignes</h4>
                    <p><b><u>Sujet</u></b> : Réaliser un site web permettant de proposer des cours en ligne.</p>
                    <p><b><u>Objectif</u></b> : Pouvoir créer des cours en ligne qui seront vus par des éudiants, qui
                        pourront prendre rendez-vous. L'exemple donné est celui de <a
                            href="https://www.mymentor.fr/" target="_blank"> mymentor.</a></p>
                    <br>
                    <h4>Nos choix</h4>
                    <p><b><u>Langages</u></b> : PHP 8, JavaScript</p>
                    <p><b><u>Frameworks</u></b> : Laravel 8 (Jetstream avec Inertia.js), Vue.js, Bootstrap, Tailwind CSS
                    </p>
                    <br>

                    <h4>Participants</h4>
                    <p><b><u>Développeurs</u></b> : Aarouss Mohamed, Dujardin Maxime, Macq Quentin, Wantiez Marie.</p>
                    <p><b><u>Tuteurs</u></b> : Mickaël Masquelin, Valérie Prensier</p>
                    <br>

                    <h4>Remerciements</h4>
                    <p>IUT de Lens</p>
                </div>
            </div>
        </div>
        <Footer/>
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout';
import Footer from "./Footer";

export default {
    components: {
        AppLayout, Footer
    },
}
</script>
