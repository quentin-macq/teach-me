<template>
    <jet-action-section>
        <template #title>
            Supprimer mon compte
        </template>

        <template #description>
            Supprimer définitivement mon compte.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Une fois votre compte supprimé, toutes les informations et données associées seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver.
            </div>

            <div class="mt-5">
                <jet-danger-button @click.native="confirmUserDeletion">
                    Supprimer mon compte
                </jet-danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
                <template #title>
                    Supprimer mon compte
                </template>

                <template #content>
                    Voulez-vous vraiment supprimer votre compte ?
                    <br>
                    Toutes les ressources et données associés seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer votre demande.
                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Mot de passe"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter.native="deleteUser" />

                        <jet-input-error :message="form.error('password')" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="confirmingUserDeletion = false">
                        Retour
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Supprimer mon compte
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from './../../Jetstream/ActionSection'
    import JetButton from './../../Jetstream/Button'
    import JetDialogModal from './../../Jetstream/DialogModal'
    import JetDangerButton from './../../Jetstream/DangerButton'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetButton,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,
                deleting: false,

                form: this.$inertia.form({
                    '_method': 'DELETE',
                    password: '',
                }, {
                    bag: 'deleteUser'
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.form.password = '';

                this.confirmingUserDeletion = true;

                setTimeout(() => {
                    this.$refs.password.focus()
                }, 250)
            },

            deleteUser() {
                this.form.post('/user', {
                    preserveScroll: true
                }).then(response => {
                    if (! this.form.hasErrors()) {
                        this.confirmingUserDeletion = false;
                    }
                })
            },
        },
    }
</script>
