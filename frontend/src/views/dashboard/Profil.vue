<template>
    <div>
        <v-row>
            <v-col cols="3"> <ProfilMenu /></v-col>
            <v-col><p>profil</p></v-col>
        </v-row>
       
    </div>
</template>


<script>
import axios from 'axios'
import ProfilMenu from '@/components/ProfilMenu.vue'
export default {
    name:"Profil",
    components:{
        ProfilMenu,
    },
    data() {
        return {
            user:{},

        }
    },
    beforeMount() {
        axios.get('user')
        .then((res) => {
            this.user = res.data;
        })
        .catch((err) => {
            console.log(err);
        })
    }
}
</script>

<style scoped>

</style>