<template>
  <img id="logo" alt="Logo" :src="logo">
    <router-view />
</template>

<script>
import { Categories, Home, Movements, Users, Login, SignUp, Auth } from './components';

export default {
    name: 'App',
    components: {
        Login,
        SignUp,
        Users,
        Categories,
        Movements,
        Home,
        Auth
    },
    data() {
        return {
            logo: require('./assets/logo.png')
        }
    },
}
</script>

<style scoped>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

#logo {
  zoom: 30%;
}
</style>
