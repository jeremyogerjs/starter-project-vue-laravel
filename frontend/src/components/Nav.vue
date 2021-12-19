<template>
  <div>
    <v-navigation-drawer v-model="sidebar" app temporary>
      <v-list-item
        v-for="item in menuItems"
        :key="item.title"
        :to="item.path"
        link
      >
        <v-list-item-icon>
          <v-icon> {{ item.icon }} </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title> {{ item.title }} </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-navigation-drawer>

    <v-toolbar outlined>
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="sidebar = !sidebar"></v-app-bar-nav-icon>
      </span>
      <v-toolbar-title>
        <router-link to="/"> {{ appTitle }} </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="token === null" class="hidden-xs-only">
        <v-btn v-for="item in menuItems" :key="item.title" text :to="item.path">
          <v-icon left dark>
            {{ item.icon }}
          </v-icon>
          {{ item.title }}
        </v-btn>
      </v-toolbar-items>
      <v-toolbar-items v-else class="hidden-xs-only">
        <span class="align-middle">
        <v-icon x-large @click="subMenu = !subMenu">
          mdi-account-circle
        </v-icon>
        </span>
        <NavMenu :subMenu.sync="subMenu"/>
      </v-toolbar-items>
    </v-toolbar>
  </div>
</template>

<script>
import NavMenu from '@/components/NavMenu.vue';
export default {
  name: "Nav",
  components:{
    NavMenu,
  },
  data() {
    return {
      sidebar: false,
      subMenu:false,
      appTitle: "test Vuetify",
      token: localStorage.getItem("token") || null,
      menuItems: [
        { title: "Sign Up", path: "/signUp", icon: "mdi-face-man" },
        { title: "Sign In", path: "/signIn", icon: "mdi-account-lock-open" },
      ],
    };
  },
  watch: {
    $route() {
      this.token = localStorage.getItem("token");
    },
  },
};
</script>