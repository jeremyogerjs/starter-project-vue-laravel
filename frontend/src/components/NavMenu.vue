<template>

        <v-menu
            transition="slide-y-transition"
            absolute
            permanent
            right
            :value="subMenu"
            :close-on-click="true"
        >
            <v-list>
                <v-list-item 
                    v-for="item in items"
                    :key="item.title"
                    :to="item.path"
                >
                <v-list-item-icon>
                    <v-icon v-text="item.icon"></v-icon>
                </v-list-item-icon>
                    <v-list-item-title>
                        {{ item.title }}
                    </v-list-item-title>
                </v-list-item>
                <v-list-item @click="logout" style="cursor:pointer">
                    <v-list-item-icon>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>
                        Déconnexion
                    </v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
</template>


<script>
import axios from 'axios';
export default {
    name:"NavMenu",
    props:['subMenu'],
    data() {
        return {
            items:[
                {title:"Profil",icon:"mdi-home-account",path:"/profil"},
            ]
        }
    },
    methods:{
        logout() {
          axios.post('logout')
          .then((res) => {
              console.log(res);
              this.token = null;
              localStorage.removeItem('token');
              this.$router.push('/');
          })
          .catch((err) => {
              console.log(err);
          }) 
        },
        closeMenu() {
            this.$emit('update:subMenu',false);
        }
    }
}
</script>

<style scoped>

</style>