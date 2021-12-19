<template>
  <v-app>
    <Nav />
    <v-main>
      
      <router-view/>
      
    </v-main>

    <Foot />
  </v-app>
   
</template>

<script>

import Foot from '@/components/Foot.vue'
import Nav from '@/components/Nav.vue'
export default {
  name:"App",
  components:{
    Nav,
    Foot,
  }
}
</script>
<style lang="scss">

</style>
