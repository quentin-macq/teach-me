<template>
    <jet-action-section>
        <template #title>
            Authentification à deux facteurs
        </template>

        <template #description>
            Ajoutez une sécurité supplémentaire à votre compte en utilisant l'authentification à deux facteurs.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
                Vous avez activé l'authentification à deux facteurs.
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                Vous n'avez pas activé l'authentification à deux facteurs.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    Lorsque l'authentification à deux facteurs est activée, vous serez invité à scanner un QR code via l'application Google Authenticator (à installer sur votre smartphone).
                    Après avoir scanné le QR code, l'application vous fournira un code d'accès qui permettra de vous à connecter à votre compte.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            L'authentification à deux facteurs est désormais activée. Scannez le QR code suivant à
                            l'aide de l'application Google Authenticator sur votre smartphone.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Stockez ces codes de récupération dans un gestionnaire de mots de passe sécurisé. Ils
                            pourront être utilisés pour récupérer l'accès à votre compte si vous avez perdu votre smartphone contenant les codes d'accès à votre compte.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <jet-button type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            Activer
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password @confirmed="regenerateRecoveryCodes">
                        <jet-secondary-button class="mr-3"
                                              v-if="recoveryCodes.length > 0">
                            Régénérer les codes de récupération
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="showRecoveryCodes">
                        <jet-secondary-button class="mr-3" v-if="recoveryCodes.length == 0">
                            Afficher les codes de récupération
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <jet-danger-button
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling">
                            Désactiver
                        </jet-danger-button>
                    </jet-confirms-password>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionSection from './../../Jetstream/ActionSection'
import JetButton from './../../Jetstream/Button'
import JetConfirmsPassword from './../../Jetstream/ConfirmsPassword'
import JetDangerButton from './../../Jetstream/DangerButton'
import JetSecondaryButton from './../../Jetstream/SecondaryButton'

export default {
    components: {
        JetActionSection,
        JetButton,
        JetConfirmsPassword,
        JetDangerButton,
        JetSecondaryButton,
    },

    data() {
        return {
            enabling: false,
            disabling: false,

            qrCode: null,
            recoveryCodes: [],
        }
    },

    methods: {
        enableTwoFactorAuthentication() {
            this.enabling = true

            this.$inertia.post('/user/two-factor-authentication', {}, {
                preserveScroll: true,
            }).then(() => {
                return Promise.all([
                    this.showQrCode(),
                    this.showRecoveryCodes()
                ])
            }).then(() => {
                this.enabling = false
            })
        },

        showQrCode() {
            return axios.get('/user/two-factor-qr-code')
                .then(response => {
                    this.qrCode = response.data.svg
                })
        },

        showRecoveryCodes() {
            return axios.get('/user/two-factor-recovery-codes')
                .then(response => {
                    this.recoveryCodes = response.data
                })
        },

        regenerateRecoveryCodes() {
            axios.post('/user/two-factor-recovery-codes')
                .then(response => {
                    this.showRecoveryCodes()
                })
        },

        disableTwoFactorAuthentication() {
            this.disabling = true

            this.$inertia.delete('/user/two-factor-authentication', {
                preserveScroll: true,
            }).then(() => {
                this.disabling = false
            })
        },
    },

    computed: {
        twoFactorEnabled() {
            return !this.enabling && this.$page.user.two_factor_enabled
        }
    }
}
</script>
