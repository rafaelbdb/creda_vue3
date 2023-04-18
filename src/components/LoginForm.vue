<template>
    <form
        method="post"
        id="loginForm"
        ref="loginForm"
        v-if="forms['login'].visible == true"
    >
        <input
            type="email"
            name="email"
            id="email"
            ref="email"
            placeholder="Email"
            required
            v-model="login.email"
        />
        <input
            type="password"
            name="password"
            id="password"
            ref="password"
            placeholder="Password"
            required
            v-model="login.password"
        />
        <button type="submit" value="Login" @click="submitLogin()"><font-awesome-icon icon="fa-solid fa-user-check" /></button>
        <button type="button" value="Signup" @click="showForm('signUp')"><font-awesome-icon icon="fa-solid fa-user-plus" /></button>
    </form>
</template>

<script>
export default {
    name: 'LoginForm',
    props: ['forms'],
    data() {
        return {
            login: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
};
</script>

<style scoped>
#loginForm {
    display: none;
}
</style>
