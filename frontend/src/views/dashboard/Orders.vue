<template>
    <div>
        <v-row>
            <v-col cols="3"><ProfilMenu /></v-col>
            <v-col><p>Orders</p></v-col>
        </v-row>
    </div>
</template>

<script>
import ProfilMenu from '@/components/ProfilMenu.vue'
export default {
    name:"Orders",
    components:{
        ProfilMenu
    }
}
</script>