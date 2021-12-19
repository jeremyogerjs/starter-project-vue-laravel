<template>
     <v-card
            elevation="12"
            width="256"
            class="ma-12"
        >
            <v-navigation-drawer
                right
                floating
                permanent
            >
                <v-list>
                    <v-list-item
                        v-for="item in items"
                        :key="item.title"
                        link
                        :to="item.path"
                    >
                    <v-list-item-icon>
                        <v-icon> {{ item.icon }} </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title> {{ item.title }} </v-list-item-title>
                    </v-list-item-content>
                    </v-list-item>
                </v-list>

            </v-navigation-drawer>
        </v-card>
</template>

<script>
export default {
    name:"profilMenu",
    data() {
        return {
            items:[
                {title:"Profil",icon:"mdi-home-account",path:"/profil"},
                {title:"My orders",icon:"mdi-clipboard-list",path:"/orders"},
                {title:"Settings",icon:"mdi-settings-helper",path:"/settings"},
            ],
        }
    }
}
</script>

<style scoped>

</style>