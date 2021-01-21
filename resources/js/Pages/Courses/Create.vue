<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Création de cours
            </h2>
        </template>

        <br>
        <br>

        <blockquote class="blockquote text-center">
            <p class="mb-0"> L'éducation est un passeport pour l'avenir, car demain appartient à ceux qui s'y préparent
                dès aujourd'hui.</p>
            <footer class="blockquote-footer">Malcolm X</footer>
        </blockquote>
        <div class="container">
            <form @submit.prevent="create">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control"
                                   v-model="form.title"
                                   id="title" tabindex="1" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="Description" minlength="20"
                                      v-model="form.description"
                                      id="description" tabindex="2" required>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="video_url">URL vidéo <span class="font-italic">(optionnel)</span></label>
                            <input type="url" class="form-control"
                                   v-model="form.video_url"
                                   id="video_url" tabindex="3">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subject">Matière</label>
                            <input type="text" class="form-control"
                                   v-model="form.subject"
                                   id="subject" tabindex="4" required>
                        </div>

                        <div class="form-group">
                            <label for="level">Niveau</label>

                            <select v-model="form.level"
                                    class="form-control"
                                    id="level" tabindex="5" required>
                                <option class="font-bold text-black" disabled>--- Études supérieures ---
                                </option>
                                <option>Université</option>
                                <option class="font-bold text-black" disabled>--- Lycée ---</option>
                                <option>Terminale</option>
                                <option>Première</option>
                                <option>Seconde</option>
                                <option class="font-bold text-black" disabled>--- Collège ---</option>
                                <option>3ème</option>
                                <option>4ème</option>
                                <option>5ème</option>
                                <option>6ème</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="duration">Durée <span class="font-italic">(en heure)</span></label>
                            <input type="number" class="form-control"
                                   v-model="form.duration"
                                   id="duration" tabindex="6" required>
                        </div>

                        <div class="form-group">
                            <label for="validity">Date de fin de cours</label>
                            <input type="date" class="form-control"
                                   v-model="form.validity"
                                   id="validity" tabindex="7" required>
                        </div>
                    </div>
                </div>

                <div class="row flex items-center justify-center mt-5">
                    <button type="submit" class="btn btn-outline-success rounded-pill p-3">Créer un nouveau cours
                    </button>
                </div>
                <br>
                <br>
                <a :href="'/courses'" type="submit" class="btn btn-secondary">Retour</a>
            </form>
        </div>
        <Footer/>
    </app-layout>
</template>
<script>

import AppLayout from "../../Layouts/AppLayout";
import Footer from "../Footer";

export default {
    components: {AppLayout, Footer},

    data() {
        return {
            form: {
                title: '',
                description: '',
                video_url: '',
                subject: '',
                level: '',
                duration: '',
                validity: '',
            },
        }
    },

    methods: {
        create() {
            return this.$inertia.post('/courses/store', this.form);
        },
    }
}
</script>

<style scoped>

.container {
    margin-top: 4%;
}

form {
    padding: 50px 30px 30px;
    border-radius: 50px;
    border-color: lightgrey;
    border-width: 1px;
    background-color: white;
}

textarea {
    height: 124px;
    min-height: 124px;
    max-height: 124px
}

.font-italic {
    color: grey;
}

</style>
