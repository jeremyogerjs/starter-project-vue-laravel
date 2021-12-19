<template>
    <div>
        <v-card class="pa-10 mt-16 mx-auto" width="40em">
            <v-card-title class="text-h4">Connexion</v-card-title>
            <v-form v-model="valid">
                <v-text-field
                    v-model="user.email"
                    type="email"
                    :rules="emailRules"
                    label="Email"
                    placeholder="example@example.com"
                    required
                    autocomplete
                ></v-text-field>
                <v-text-field
                    v-model="user.password"
                    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off' "
                    :type="show ? 'text' : 'password' "
                    :rules="passRules"
                    label="Votre mot de passe"
                    @click:append="show = !show"
                    required
                ></v-text-field>
                <v-row justify="center" v-if="errors">
                    <p class="red--text"> {{ errors.message }} </p>
                </v-row>
                    <v-row justify="center" class="my-2">
                        <span class="text-decoration-underline forgotPass" @click="forgotPass">Mot de passe oublié ?</span>
                    </v-row>
                <v-row justify="center" class="my-4">
                        <v-btn
                            :disabled="!valid"
                            color="success"
                            @click="signIn"
                        >
                            Se connecter
                        </v-btn>
                </v-row>
                <v-row justify="center">
                    <router-link to="/signUp">Pas de compte ?</router-link>
                </v-row>
            </v-form>
        </v-card>

        <Forgot  :dialog.sync="dialog"/>
    </div>
</template>

<script>
import axios from 'axios'
import Forgot from '@/components/ForgotPassword.vue'
export default {
    name:"SignIn",
    components:{
        Forgot,
    },
    data() {
        return {
            valid:false,
            show:false,
            dialog:false,
            errors:null,
            user:{
                email:"",
                password:""
            },
            // condition de validations pour formulaire array need
            emailRules:[
                v => !!v || 'Email obligatoire',
                v => /.+@.+/.test(v) || 'L\'email doit contenir un @'
            ],
            passRules: [
                v => !!v || 'Mot de passe obligatoire',
            ]
        }
    },
    methods:{
        signIn() {
            axios.post('login',this.user)
            .then((res) => {
                axios.defaults.headers.common['Authorization'] = res.data.token;
                localStorage.setItem('token',res.data.token);
                this.$router.push('/profil');
            })
            .catch((err) => {
                console.log(err.response.data);
                this.errors = err.response.data;
            })
        },
        forgotPass() {
            this.dialog = true;
        }
    },
}
</script>
<style scoped >
.forgotPass {
    color: #1976d2;
    cursor: pointer;
}
</style>