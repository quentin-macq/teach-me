<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vous rencontrez des problèmes ? Vous avez des suggestions ? <br>
                N'hésitez pas à nous contacter en remplissant ce formulaire.
            </h2>
        </template>
        <div class="card mx-auto mt-5" style="border-radius: 50px; width: 50%;">
            <div class="card-body" style="padding-left: 5%">
                <div class="flex items-center">
                    <form action="https://formspree.io/f/xqkgplaz"
                          method="post"
                          style="border-style: solid">

                        <br>Votre nom
                        <input id="nom" type="text" class="form-control" name="Nom" size="95" required>

                        <br>Votre adresse mail
                        <input type="email" class="form-control" name="Mail" required>

                        <br>Votre message
                        <textarea type="text" class="form-control" name="Description" minlength="20"
                                  style="height: 280px; min-height: 280px; max-height: 280px" required>
                        </textarea>
                        <br>
                        <div class="flex justify-center">
                            <button type="submit" value="Envoyer" class="btn btn-primary mr-1">Envoyer</button>
                            &nbsp; &nbsp;
                            <button type="reset" value="Reset" class="btn btn-danger">Effacer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Footer/>
    </app-layout>
</template>
<script>


import AppLayout from "../Layouts/AppLayout";
import Footer from "./Footer";

export default {
    components: {
        AppLayout,
        Footer
    },

}
</script>
