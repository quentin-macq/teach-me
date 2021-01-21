<template>
    <div>
        <!-- Generate API Token -->
        <jet-form-section @submitted="createApiToken">
            <template #title>
                Créer un jeton API
            </template>

            <template #description>
                Les jetons API permettent à des services tiers de s'authentifier auprès de l'application en votre nom.
            </template>

            <template #form>
                <!-- Token Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="createApiTokenForm.name" autofocus />
                    <jet-input-error :message="createApiTokenForm.error('name')" class="mt-2" />
                </div>

                <!-- Token Permissions -->
                <div class="col-span-6" v-if="availablePermissions.length > 0">
                    <jet-label for="permissions" value="Permissions" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="permission in availablePermissions">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" :value="permission" v-model="createApiTokenForm.permissions">
                                <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
                    Created.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': createApiTokenForm.processing }" :disabled="createApiTokenForm.processing">
                    Create
                </jet-button>
            </template>
        </jet-form-section>

        <div v-if="tokens.length > 0">
            <jet-section-border />

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <jet-action-section>
                    <template #title>
                        Gérer les jetons API
                    </template>

                    <template #description>
                        Vous pouvez supprimer n'importe lequel de vos jetons existants s'ils ne sont plus nécessaires.
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between" v-for="token in tokens">
                                <div>
                                    {{ token.name }}
                                </div>

                                <div class="flex items-center">
                                    <div class="text-sm text-gray-400" v-if="token.last_used_at">
                                        Dernière utilisation {{ fromNow(token.last_used_at) }}
                                    </div>

                                    <button class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none"
                                                @click="manageApiTokenPermissions(token)"
                                                v-if="availablePermissions.length > 0">
                                        Permissions
                                    </button>

                                    <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" @click="confirmApiTokenDeletion(token)">
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </jet-action-section>
            </div>
        </div>

        <!-- Token Value Modal -->
        <jet-dialog-modal :show="displayingToken" @close="displayingToken = false">
            <template #title>
                API Token
            </template>

            <template #content>
                <div>
                    Veuillez copier votre nouveau jeton API. Pour votre sécurité, il ne sera plus affiché.
                </div>

                <div class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500" v-if="$page.jetstream.flash.token">
                    {{ $page.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="displayingToken = false">
                    Close
                </jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- API Token Permissions Modal -->
        <jet-dialog-modal :show="managingPermissionsFor" @close="managingPermissionsFor = null">
            <template #title>
                Permissions des jetons API
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in availablePermissions">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" :value="permission" v-model="updateApiTokenForm.permissions">
                            <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="managingPermissionsFor = null">
                    Fermer
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="updateApiToken" :class="{ 'opacity-25': updateApiTokenForm.processing }" :disabled="updateApiTokenForm.processing">
                    Sauvegarder
                </jet-button>
            </template>
        </jet-dialog-modal>

        <!-- Delete Token Confirmation Modal -->
        <jet-confirmation-modal :show="apiTokenBeingDeleted" @close="apiTokenBeingDeleted = null">
            <template #title>
                Supprimer un jeton API
            </template>

            <template #content>
                Êtes-vous sur de vouloir supprimer ce jeton API ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="apiTokenBeingDeleted = null">
                    Fermer
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteApiToken" :class="{ 'opacity-25': deleteApiTokenForm.processing }" :disabled="deleteApiTokenForm.processing">
                    Supprimer
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetActionSection from './../../Jetstream/ActionSection'
    import JetButton from './../../Jetstream/Button'
    import JetConfirmationModal from './../../Jetstream/ConfirmationModal'
    import JetDangerButton from './../../Jetstream/DangerButton'
    import JetDialogModal from './../../Jetstream/DialogModal'
    import JetFormSection from './../../Jetstream/FormSection'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetLabel from './../../Jetstream/Label'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'
    import JetSectionBorder from './../../Jetstream/SectionBorder'

    export default {
        components: {
            JetActionMessage,
            JetActionSection,
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetDialogModal,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            JetSectionBorder,
        },

        props: [
            'tokens',
            'availablePermissions',
            'defaultPermissions',
        ],

        data() {
            return {
                createApiTokenForm: this.$inertia.form({
                    name: '',
                    permissions: this.defaultPermissions,
                }, {
                    bag: 'createApiToken',
                    resetOnSuccess: true,
                }),

                updateApiTokenForm: this.$inertia.form({
                    permissions: []
                }, {
                    resetOnSuccess: false,
                    bag: 'updateApiToken',
                }),

                deleteApiTokenForm: this.$inertia.form(),

                displayingToken: false,
                managingPermissionsFor: null,
                apiTokenBeingDeleted: null,
            }
        },

        methods: {
            createApiToken() {
                this.createApiTokenForm.post('/user/api-tokens', {
                    preserveScroll: true,
                }).then(response => {
                    if (! this.createApiTokenForm.hasErrors()) {
                        this.displayingToken = true
                    }
                })
            },

            manageApiTokenPermissions(token) {
                this.updateApiTokenForm.permissions = token.abilities

                this.managingPermissionsFor = token
            },

            updateApiToken() {
                this.updateApiTokenForm.put('/user/api-tokens/' + this.managingPermissionsFor.id, {
                    preserveScroll: true,
                    preserveState: true,
                }).then(response => {
                    this.managingPermissionsFor = null
                })
            },

            confirmApiTokenDeletion(token) {
                this.apiTokenBeingDeleted = token
            },

            deleteApiToken() {
                this.deleteApiTokenForm.delete('/user/api-tokens/' + this.apiTokenBeingDeleted.id, {
                    preserveScroll: true,
                    preserveState: true,
                }).then(() => {
                    this.apiTokenBeingDeleted = null
                })
            },

            fromNow(timestamp) {
                return moment(timestamp).local().fromNow()
            },
        },
    }
</script>
