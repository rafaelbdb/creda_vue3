<template>
    <Modal>
        <form
            id="loginForm"
            ref="loginForm"
            v-if="forms['login'].visible == true"
            @submit.prevent="submitLogin()"
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
            <button type="submit" class="btn btn-primary" value="Login">
                <font-awesome-icon icon="fa-solid fa-user-check" />
            </button>
            <button type="button" class="btn btn-warning" value="Signup" @click="showForm('signUp')">
                <font-awesome-icon icon="fa-solid fa-user-plus" />
            </button>
        </form>
    </Modal>
</template>

<script>
import { Modal } from './Modal.vue';

export default {
    name: 'LoginForm',
    props: ['forms'],
    data() {
        return {
            login: {
                email: '',
                password: ''
            }
        };
    },
    methods: {
        submitLogin() {
            validateForm(this.$refs.loginForm);
            let result;
            if (result) {
                this.userLoggedIn = true;
                this.userName = result.userName;
                this.showForm('', 'Welcome back, ' + this.userName + '!');
            }
        }
    },
    components: { Modal }
};
</script>

<style scoped>
#loginForm {
    display: none;
}
</style>
