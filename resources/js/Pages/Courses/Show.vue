<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ course.title }}
            </h2>
        </template>

        <div class="container">
            <blockquote class="blockquote text-center">
                <p class="mb-0"> L'éducation est l'arme la plus puissante qu'on puisse utiliser pour changer le
                    monde.</p>
                <footer class="blockquote-footer">Neslon Mandela</footer>
            </blockquote>
            <div id="container-informations-1" class="card mx-auto mt-5 col-8">
                <div id="container-informations-2" class="card-body">
                    <p class="card-text mt-5"><span class="font-weight-bold underline">Description</span> :
                        {{ course.description }}</p>
                    <p class="card-text mt-3"><span class="font-weight-bold underline">Durée</span> :
                        {{ course.duration }}h</p>

                    <div v-if="course.video_url != null">
                        <p class="card-text mt-3"><span class="font-weight-bold underline">Vidéo de présentation du cours</span>
                            : </p>
                        <div id="video-url" class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" :src="course.video_url"
                                    allowfullscreen></iframe>
                        </div>
                    </div>

                    <p class="card-text mt-3"><span class="font-weight-bold underline">Matière / Niveau</span> :
                        {{ course.subject }}, {{ course.level }}</p>
                    <div class="flex items-center mt-5">
                        <img class="w-10 h-10 rounded-full mr-4" :src="course.user.profile_photo_url"
                             alt="Avatar of the creator">
                        <div class="text-sm">
                            <p class="text-gray-900 leading-none">{{ course.user.name }} {{ course.user.firstName }}</p>
                            <p class="text-gray-600">Créé le : {{ course.date | formatDate }}</p>
                        </div>
                    </div>

                    <!-- V-Calendar -->
                    <p class="card-text mt-3"><span class="font-weight-bold underline">Disponibilités du cours</span> :
                    <div class="flex w-full">
                        <vc-calendar is-expanded
                                     locale="fr"
                                     :attributes='attrs'
                                     :min-date="new Date()"
                                     mode='range'
                                     :disabled-dates='[
                                                {
                                                  start: new Date(2020, 11, 24),
                                                  end: new Date(2020, 11, 25)
                                                },
                                              ]'
                                     :value="null"
                                     color="teal"
                                     is-inline>
                        </vc-calendar>
                    </div>

                    <div v-if="course.user.name !== userName" class="flex items-center justify-center mt-5">
                        <button id="appointment-button" v-on:click="showRdvForm"
                                class="hover:bg-blue-700 text-black py-2 px-4 rounded-full"> Prendre rendez-vous
                        </button>
                    </div>

                    <div v-if="userRole === 'admin' || course.user.name === userName && userRole === 'professeur'"
                         class="d-flex justify-content-center mt-3">
                        <a :href="'/course/edit/' + course.id" class="btn btn-primary mr-3">Éditer mon cours</a>
                        <button @click="destroy(course)" class="btn btn-danger">Supprimer mon cours</button>
                    </div>

                    <a :href="'/courses'" type="submit" class="btn btn-secondary mt-5">Retour</a>

                    <div v-if="created">
                        <form :action="'mailto:'+course.user.email+'?subject=Demande de rendez-vous'"
                              method="post">
                            <br>Nom
                            <input type="text" class="form-control" name="Nom" required>

                            <br>E-mail
                            <input type="email" class="form-control" name="Mail" required>

                            <br>Date
                            <input type="date" class="form-control" name="Date de rendez-vous" required>

                            <br>Description
                            <textarea type="text" class="form-control" name="Description" minlength="20" required>
                            </textarea>
                            <br>
                            <br>
                            <button type="submit" value="Envoyer" class="btn btn-primary">Envoyer</button>
                            &nbsp;
                            <button type="reset" value="Reset" class="btn btn-danger">Effacer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <Footer/>
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

    props: ['course', 'userName', 'userRole'],

    data() {
        return {
            created: false,
            attrs: [
                {
                    key: 'today',
                    highlight: true,
                    dates: {
                        start: new Date(this.course.date),
                        end: new Date(this.course.validity),
                    }
                },
            ],

        }
    },

    methods: {
        showRdvForm() {
            this.created = !this.created;
        },
        async destroy(data) {
            if (!confirm('Voulez-vous vraiment supprimer ce cours ?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/course/destroy/' + data.id, data);
        },
    }
}
</script>

<style scoped>

.container {
    margin-top: 5%;
}

#appointment-button {
    background-color: #d4edda
}

#container-informations-1 {
    border-radius: 50px;
}

#container-informations-2 {
    padding-left: 30px;
}

#video-url {
    border-radius: 8px;
}

form {
    border-style: solid
}

textarea {
    height: 124px;
    min-height: 124px;
    max-height: 124px;
}

</style>
