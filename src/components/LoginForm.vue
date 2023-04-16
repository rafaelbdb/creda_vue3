<template>
    <form action="" method="post" id="loginForm" ref="loginForm" v-if="forms['login'].visible == true">
        <input type="email" name="email" id="email" ref="email" placeholder="Email" />
        <input type="password" name="password" id="password" ref="password" placeholder="Password" />
        <input type="submit" value="Login" @click="submitLogin()" />
        <input type="button" value="Signup" @click="showForm('signUp')" />
    </form>
</template>

<script>
export default {
    name: 'LoginForm',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
}
</script>

<style scoped>
#loginForm {
    display: none;
}
</style>