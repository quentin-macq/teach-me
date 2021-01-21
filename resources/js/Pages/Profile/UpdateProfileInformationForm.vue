<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Informations du profil
        </template>

        <template #description>
            Mettez à jour les informations de votre profil et l'adresse e-mail de votre compte.
        </template>

        <template #form>

            <!-- AJOUTS DES VALEURS DANS LE FORMULAIRE DU PROFIL DE L'UTILISATEUR -->

            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       ref="photo"
                       @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo"/>

                <!-- Photo de profile actuelle -->
                <!-- PHOTO DE PROFIL PAR DÉFAUT GÉNÉRÉE PAR UNE API-->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="$page.user.profile_photo_url" alt="Current Profile Photo"
                         class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- Nouvelle photo de profil -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Sélectionner une photo
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto"
                                      v-if="$page.user.profile_photo_path">
                    Supprimer la photo
                </jet-secondary-button>

                <jet-input-error :message="form.error('photo')" class="mt-2"/>
            </div>

            <!-- Nom -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Nom"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name"/>
                <jet-input-error :message="form.error('name')" class="mt-2"/>
            </div>

            <!-- Prénom -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="firstName" value="Prénom"/>
                <jet-input id="firstName" type="text" class="mt-1 block w-full" v-model="form.firstName"
                           autocomplete="firstName"/>
                <jet-input-error :message="form.error('firstName')" class="mt-2"/>
            </div>

            <!-- Date de naissance -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="dateOfBirth" value="Date de naissance"/>
                <jet-input id="dateOfBirth" type="date" class="mt-1 block w-full" v-model="form.dateOfBirth"
                           autocomplete="dateOfBirth"/>
                <jet-input-error :message="form.error('dateOfBirth')" class="mt-2"/>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"/>
                <jet-input-error :message="form.error('email')" class="mt-2"/>
            </div>

            <!-- Numéro de téléphone -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Numéro de téléphone"/>
                <jet-input id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone"
                           autocomplete="phone"/>
                <jet-input-error :message="form.error('phone')" class="mt-2"/>
            </div>

            <!-- Biography -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="biography" value="Biographie"/>
                <textarea id="biography" type="text" class="mt-1 block w-full"
                          v-model="form.biography"
                          autocomplete="biography" style="border: solid 1px lightgray; border-radius: 5px; height: 150px; min-height: 150px; max-height: 150px"/>
                <jet-input-error :message="form.error('biography')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Enregistré.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Enregistrer
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from './../../Jetstream/Button'
import JetFormSection from './../../Jetstream/FormSection'
import JetInput from './../../Jetstream/Input'
import JetInputError from './../../Jetstream/InputError'
import JetLabel from './../../Jetstream/Label'
import JetActionMessage from './../../Jetstream/ActionMessage'
import JetSecondaryButton from './../../Jetstream/SecondaryButton'

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ['name', 'firstName', 'dateOfBirth', 'email', 'phone', 'biography'],

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'PUT',
                name: this.name,
                firstName: this.firstName,
                dateOfBirth: this.dateOfBirth,
                email: this.email,
                phone: this.phone,
                biography: this.biography,
                photo: null,
            }, {
                bag: 'updateProfileInformation',
                resetOnSuccess: false,
            }),

            photoPreview: null,
        }
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.form.post('/user/profile-information', {
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia.delete('/user/profile-photo', {
                preserveScroll: true,
            }).then(() => {
                this.photoPreview = null
            });
        },
    },
}
</script>
