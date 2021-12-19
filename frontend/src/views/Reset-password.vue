<template>
    <div>
       <v-card class="mt-16 pa-8">
           <v-card-title>
               Changer le mot de passe
           </v-card-title>
           <v-form v-model="valid">
               <v-text-field
                v-model="user.email"
                label="Email"
                placeholder="example@example.com"
                :rules="emailRules"
               ></v-text-field>
               <v-text-field
                v-model="user.password"
                label="Mot de passe"
                :rules="passRules"
                :type="show ? 'text' : 'password'"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off' "
                @click:append="show = !show"
               ></v-text-field>
               <v-text-field
                v-model="user.password_confirmation"
                label="Confirmation de mot de passe"
                :rules="confirmPassRules"
                :type="show2 ? 'text' : 'password'"
                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off' "
                @click:append="show2 = !show2"
               >
               </v-text-field>
               <v-row justify="center" class="my-4">
                   <v-btn color="success" :disabled="!valid" @click="resetPassword">Valider</v-btn>
               </v-row>
           </v-form>
       </v-card>

       <v-snackbar v-model="snackbar.active" :vertical="true" :timeout="2000"> {{ snackbar.text }} </v-snackbar>
    </div>
</template>


<script>
import axios from 'axios'
export default {
    name:"ResetPassword",
    data() {
        return {
            valid:false,
            show:false,
            show2:false,
            snackbar:{
                active:false,
                text:""
            },
            user:{
                token:"",
                email:"",
                password:"",
                password_confirmation:""
            },
            emailRules:[
                v => !!v || 'Email obligatoire',
                v => /.+@.+/.test(v) || 'L\'email doit contenir un @'
            ],
            passRules: [
                v => !!v || 'Mot de passe obligatoire',
            ],
            confirmPassRules: [
                v => !!v || 'Mot de passe obligatoire',
                v => v === this.user.password || "Le mot de passe ne correspond pas" 
            ]
        }
    },
    methods:{
        resetPassword() {
            axios.post('reset-password',this.user)
            .then((res) => {
                if(res.status === 200) {
                    this.snackbar.text = "Votre mot de passe a bien été modifier,Vous allez être redirigé pour vous connecter."
                    this.snackbar.active = true;
                    setTimeout(() => this.$router.push("/signIn"),3000)
                }
            })
            .catch((err) => {
                console.log(err);
            })
        }
    },  
    beforeMount() {
        this.user.token = this.$route.params.token;
    }
}
</script>