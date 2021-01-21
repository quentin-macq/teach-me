<template>
    <app-layout>
        <template #header>
            <!-- Permet de fermer la suggestion de mots-clés quand on clique n'importe où sur la page.
            Cette div est implémentée plusieurs fois dans la vue.-->
            <div class="mb-3" @click="modal=false">
                <div id="title-courses" class="font-semibold text-gray-800 leading-tight">
                    Cours disponibles
                </div>

                <!-- Afficher le bouton de création de cours seulement pour les utilisateurs ayant le rôle "professeur" -->
                <a v-if="userRole === 'professeur' || userRole==='admin'" :href="'courses/create'"
                   class="float-left btn btn-primary mt-3 ml-2">
                    Ajouter un nouveau cours
                </a>
            </div>

            <!-- Barre de recherche -->
            <div class="flex flex-col float-right">
                <!-- On met le booléen modal à true afin de pouvoir afficher des suggestions s'il y a correspondance
                avec la recherche de l'utilisateur -->
                <input id="input-search" class="rounded ml-3 p-2 z-10" type="text" v-model="search"
                       placeholder="Rechercher" @input="filterStates" @focus="modal=true"/>

                <!-- Suggestion de mots-clés lors d'une recherche -->

                <!-- Si le tableau filteredStates n'est pas vide et que le booléen modal est vrai,
                on affiche une div comprenant le mot clé -->
                <div v-if="filteredStates && modal" class="z-10 ml-3">
                    <ul class="w-48 bg-gray-800 text-white">
                        <!-- La fonction setStates prend en paramètre une valeur qui a été filtrée précédemment et qui retourne un mot-clé
                        correspondant à la recherche de l'utilisateur -->
                        <li v-for="filteredState in filteredStates" class="py-2 border-b cursor-pointer"
                            @click="setState(filteredState)">{{ filteredState }}
                        </li>
                    </ul>
                </div>
            </div>

            <div @click="modal=false">
                <!-- Options de filtrages -->
                <label class="float-right">
                    <select class="form-select block font-weight-bold focus:border-green-500 focus:shadow-outline ">
                        <option id="default" value="default">Aucun filtre</option>
                        <option id="dots" value="default" disabled>.............</option>
                        <option id="title" value="titre">Titre</option>
                        <option id="name" value="name">Nom</option>
                        <option id="firstName" value="firstName">Prénom</option>
                        <option id="subject" value="subject">Matière</option>
                        <option id="level" value="level">Niveau</option>
                        <option id="date" value="date">Date</option>
                    </select>
                </label>
                <br>
            </div>
        </template>

        <div @click="modal=false">
            <!-- Indique le nombre de cours trouvés suite à une recherche -->
            <div class="container-fluid pt-3">
                <div class="alert alert-secondary"
                     v-if="this.search && this.filteredList.length === 0 || this.filteredList.length === 1">
                    {{ filteredList.length }} cours trouvé.
                </div>
                <div class="alert alert-secondary"
                     v-if="this.search && this.filteredList.length !== 0 && this.filteredList.length !== 1">
                    {{ filteredList.length }} cours trouvés.
                </div>

                <!-- Affichage des cours sur la page -->
                <div class="card-group z-1">
                    <div class="col-lg-4 col-sm-6 mb-4" v-for="course in this.filteredList.reverse()"
                         v-bind:key="course.id">
                        <div class="card h-100 z-1">
                            <div class="card-body z-1">
                                <text-highlight id="courseTitle" :queries="search" class="card-title">{{ course.title }}
                                </text-highlight>
                            </div>
                            <div class="card-footer z-1">
                                <text-highlight id="courseLevel" :queries="search"
                                                class="text-sm text-green-400 float-right">
                                    {{ course.level }}
                                </text-highlight>
                                <text-highlight id="courseSubject" :queries="search"
                                                class="text-sm text-green-400 float-right">
                                    {{ course.subject }}&nbsp; | &nbsp;
                                </text-highlight>
                                <br>
                                <div class="row">
                                    <img class="w-10 h-10 rounded-full mr-2" :src="course.user.profile_photo_url">
                                    <text-highlight id="courseName" :queries="search" class="card-text mt-2">Mise en
                                        ligne
                                        par :
                                        {{ course.user.name }} | {{ course.user.firstName }}
                                    </text-highlight>
                                </div>
                                <text-highlight id="courseDate" :queries="search" class="card-text mt-2">
                                    Mis en ligne le {{ course.date | formatDate }}
                                </text-highlight>

                                <div class="flex items-center justify-center mt-3">
                                    <a :href="'course/' + course.id"
                                       class="btn btn-success rounded-pill">Voir plus
                                        d'informations</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Footer/>
        </div>
    </app-layout>
</template>
<script>

import AppLayout from "../../Layouts/AppLayout";
import Footer from "../Footer";

export default {
    components: {
        AppLayout,
        Footer
    },

    props: ['courses', 'userRole'],

    data() {
        return {
            courseList: this.courses,
            search: '',
            modal: false,
            states: ['français', 'mathématiques', 'physique', 'svt', 'histoire', 'géographie', 'développement', 'anglais', 'philosophie',
                '6ème', '5ème', '4ème', '3ème', 'seconde', 'première', 'terminale', 'université'],
            filteredStates: [],
        };
    },
    methods: {
        filterStates() {
            // Ajout dans un tableau (filteredStates) des mots de suggestions (states) correspondant à la valeur entrée dans la barre de recherche
            // Prise en compte de la casse
            this.filteredStates = this.states.filter(state => {
                return state.toLowerCase().startsWith(this.search.toLowerCase());
            });

            // Si rien n'est entré, aucune suggestion n'est donnée
            if (this.search.length === 0) {
                this.filteredStates = '';
            }
        },


        // Change la recherche de l'utilisateur par la suggestion sur laquelle on a cliqué
        setState(state) {
            this.search = state;

            // On remet modal à false afin de ne plus afficher de suggestions
            this.modal = false;
        },
    },
    computed: {
        filteredList() {
            // Stocke la valeur entré dans la barre de recherche
            const value = this.search.slice(0).toLowerCase();

            // Enregistre dans une variable les événements associés aux options du dropdown (si la case est cochée ou non)
            let searchByName = document.querySelector("#name:checked");
            let searchByFirstName = document.querySelector("#firstName:checked");
            let searchByTitle = document.querySelector("#title:checked");
            let searchBySubject = document.querySelector("#subject:checked");
            let searchByLevel = document.querySelector("#level:checked");
            let searchByDate = document.querySelector("#date:checked");

            // Application d'une filtre permettant d'afficher les cours correspondant au mot-clé entré dans la barre de recherche
            // Prise en compte de la casse
            return this.courseList.filter(course => {
                let courseName = course.user.name.toLowerCase().indexOf(value) > -1;
                let courseFirstName = course.user.firstName.toLowerCase().indexOf(value) > -1;
                let courseTitle = course.title.toLowerCase().indexOf(value) > -1;
                let courseSubject = course.subject.toLowerCase().indexOf(value) > -1;
                let courseLevel = course.level.toLowerCase().indexOf(value) > -1;
                let courseDate = course.date.indexOf(value) > -1;

                // Si un bouton est coché, la variable filtrée correspondante sera retournée et affichera les cours comprenant le mot clé
                if (searchByTitle != null) {
                    return courseTitle;
                } else if (searchByName != null) {
                    return courseName;
                } else if (searchByFirstName != null) {
                    return courseFirstName
                } else if (searchBySubject != null) {
                    return courseSubject;
                } else if (searchByLevel != null) {
                    return courseLevel;
                } else if (searchByDate != null) {
                    return courseDate;
                } else {
                    // Par défaut, on retourne un filtrage correspondant à tous les champs du dropdown
                    return courseTitle ||
                        courseName ||
                        courseFirstName ||
                        courseSubject ||
                        courseLevel ||
                        courseDate;
                }
            });
        },

    },
}
</script>

<style scoped>

#title-courses {
    font-size: xx-large;
}

#input-search {
    box-shadow: 1px 1px 12px gainsboro;
}

</style>
