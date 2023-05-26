<template>
  <div>
    <h2>Checking User Authorization...</h2>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'Auth',
  created() {
    this.checkAuthentication();
  },
  methods: {
    checkAuthentication() {
        axios
            .get('http://creda_vue3/api/auth')
            .then(response => {
                console.log("Authentication is successful");
                this.$router.push('/movements');
        })
        .catch(error => {
            console.warn("Authentication failed, redirecting to login page")
            this.$router.push('/login');
        });
    },
  },
};
</script>

<style scoped>
</style>
