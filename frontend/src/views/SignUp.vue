<template>
    <div>
        <v-card class="pa-6 mt-16 mx-auto" width="40em">
            <v-card-title class="text-h4">S'inscrire</v-card-title>
            <v-form v-model="valid" class="pa-3">
                <v-text-field
                    class="mb-2"
                    v-model="user.name"
                    label="Votre nom"
                    required
                    type="text"
                ></v-text-field>
                <v-text-field
                    class="mb-2"
                    v-model="user.email"
                    label="Votre email"
                    placeholder="example@example.com"
                    type="email"
                    :rules="emailRules"
                    required
                ></v-text-field>
                <v-text-field
                    class="mb-2"
                    v-model="user.password"
                    label="Votre mot de passe"
                    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off' "
                    @click:append="show = !show"
                    :type="show ? 'text' : 'password' "
                    :rules="passRules"
                    required
                ></v-text-field>
                <v-text-field
                    class="mb-2"
                    v-model="user.password_confirmation"
                    label="Confirmer mot de passe"
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off' "
                    @click:append="show2 = !show2"
                    :type="show2 ? 'text' : 'password' "
                    :rules="passConfirmRules"
                ></v-text-field>
                <v-row justify="center" class="my-2">
                    <v-btn
                    :disabled="!valid"
                        color="success"
                        @click="signUp"
                    >
                    S'inscrire
                    </v-btn>
                </v-row>
                <v-row justify="center">
                    <router-link to="/signIn">Déja un compte ?</router-link>
                </v-row>
            </v-form>
        </v-card>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name:"SignUp",
    data() {
        return {
            valid:false,
            show:false,
            show2:false,
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
            },
            emailRules:[
                v => !!v || 'Email requis',
                v => /.+@.+/.test(v) || 'L\'email doit contenir un @'
            ],
            passRules:[
                v => !!v || 'Mot de passe requis',
            ],
            passConfirmRules:[
                v => v === this.user.password || 'Le mot de passe ne corespond pas',
            ]
        }
    },
    methods:{
        signUp() {
            axios.post('register',this.user)
            .then((res) => {
                localStorage.setItem('token',res.data.token);
                axios.defaults.headers.common['Authorization'] = res.data.token;
                this.$router.push('/profil');
            })
            .catch((err) => {
                console.log(err);
            })
            
            
        }
    },
}
</script>
<style scoped>

</style>