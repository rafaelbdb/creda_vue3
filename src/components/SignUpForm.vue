<template>
    <Modal>
        <form
            id="signupForm"
            ref="signupForm"
            v-if="forms['signUp'].visible == true"
            @submit.prevent="submitSignUp()"
        >
            <input
                type="text"
                name="name"
                id="name"
                ref="name"
                placeholder="Name"
                required
                v-model="signUp.name"
            />
            <input
                type="text"
                name="surname"
                id="surname"
                ref="surname"
                placeholder="Surname"
                required
                v-model="signUp.surname"
            />
            <input
                type="text"
                name="username"
                id="username"
                ref="username"
                placeholder="Username"
                required
                v-model="signUp.username"
            />
            <input
                type="email"
                name="email"
                id="email"
                ref="email"
                placeholder="Email"
                required
                v-model="signUp.email"
            />
            <input
                type="password"
                name="password"
                id="password"
                ref="password"
                placeholder="Password"
                required
                v-model="signUp.password"
            />
            <input
                type="password"
                name="confirmPassword"
                id="confirmPassword"
                ref="confirmPassword"
                placeholder="Confirm password"
                required
                v-model="signUp.confirmPassword"
            />
            <input
                type="checkbox"
                name="acceptTerms"
                id="acceptTerms"
                placeholder="Accept terms and conditions"
                value="termsAccepted"
            />
            <button type="submit" value="Signup" :disabled="!validInputs">
                <font-awesome-icon icon="fa-solid fa-user-plus" />
            </button>
            <button type="button" value="Login" @click="showForm('login')">
                <font-awesome-icon icon="fa-solid fa-user-check" />
            </button>
        </form>
    </Modal>
</template>

<script>
import { Modal } from './Modal.vue';
export default {
    name: 'SignUpForm',
    props: ['forms'],
    data() {
        return {
            validInputs: validateForm(this.$refs.signupForm),
            signUp: {
                name: '',
                surname: '',
                username: '',
                email: '',
                password: '',
                confirmPassword: ''
            }
        };
    },
    methods: {
        submitSignUp() {
            validateForm(this.$refs.signupForm);
            let result;
            if (result) {
                this.showForm(
                    'login',
                    'Welcome to the club, ' + this.userName + '!'
                );
            }
        }
    }
};
</script>

<style scoped>
#signupForm {
    display: none;
}
</style>
