<template>
  <img id="logo" alt="Logo" :src="logo">
    <router-view />
</template>

<script>
import Users from './components/Users.vue';

export default {
    name: 'App',
    components: {
        Users
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
