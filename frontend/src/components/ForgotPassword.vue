<template>
    <div>
        <v-dialog
            transition="dialog-bottom-transition"
            max-width="600"
            v-model="dialog"
            @click:outside="removeDialog"
        >
            
                <v-card>
                    <v-toolbar color="primary" dark>
                        Mot de passe perdu
                    </v-toolbar>
                    <v-form class="pa-8" v-model="valid">
                        <v-text-field
                            v-model="user.email"
                            type="email"
                            :rules="emailRules"
                            label="Email"
                            placeholder="example@example.com"
                            required
                        ></v-text-field>
                        <v-row class="mt-4">
                            <v-btn color="success" :disabled="!valid" @click="forgotPass">Envoyer</v-btn>
                        </v-row>
                    </v-form>
                    <v-card-actions class="justify-end">
                        <v-btn text @click="removeDialog">Annuler</v-btn>
                    </v-card-actions>
                    <v-overlay :absolute="true" :value="overlay">
                        <v-progress-circular
                            indeterminate
                            color="amber"
                        ></v-progress-circular>
                    </v-overlay>
                </v-card>
            
        </v-dialog>
        <v-snackbar :top="true" v-model="snackbar.active" :timeout="2000">
            {{ snackbar.text }}
        </v-snackbar>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name:"ForgotPass",
    props:['dialog'],
    data() {
        return {
            valid:false,
            overlay:false,
            snackbar:{
                active:false,
                text:"",
            },
            user:{
                email:""
            },
            emailRules:[
                v => !!v || 'Email obligatoire',
                v => /.+@.+/.test(v) || 'L\'email doit contenir un @'
            ],
        }
    },
    methods:{
        forgotPass() {
            this.overlay = true;
            axios.post('forgot-password',this.user)
            .then((res) => {
                if(res.status === 200) {
                    this.snackbar.text = "Un email vous a été envoyé avec un lien pour récupérer votre mot de passe";
                    this.snackbar.active = true;
                    this.$emit('update:dialog',false);
                    this.overlay = false;
                }
            })
            .catch((err) => {
                console.log(err);
            })
        },
        removeDialog() {
            this.$emit('update:dialog',false);
        }
    },
}
</script>
<style scoped>

</style>