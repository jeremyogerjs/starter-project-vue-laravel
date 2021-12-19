<template>
    <div>
        <v-row>
            <v-col cols="3"><ProfilMenu /></v-col>
            <v-col><p>Settings</p></v-col>
        </v-row>
    </div>
</template>

<script>
import ProfilMenu from '@/components/ProfilMenu.vue'
export default {
    name:"Settings",
    components:{
        ProfilMenu
    }
}
</script>