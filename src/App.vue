<template>
    <h1 id="pageTitle">{{ pageTitle }}</h1>
    <UserMenu />
    <LoginForm :forms="forms" />
    <SignUpForm :forms="forms" />
    <ChangePasswordForm :forms="forms" />
    <DeleteAccountForm :forms="forms" />
    <Dashboard :userLoggedIn="userLoggedIn"/>
</template>

<script>
import { ChangePasswordForm, Dashboard, DeleteAccountForm, LoginForm, SignUpForm, UserMenu } from './components';

const defaultTitle = 'Login to your account'

export default {
    name: 'App',
    data() {
        return {
            pageTitle: defaultTitle,
            userLoggedIn: false,
            forms: {
                login: { title: 'Login to your account', visible: true },
                signUp: { title: 'Sign up for an account', visible: false },
                changePassword: { title: 'Change your password', visible: false },
                deleteAccount: { title: 'Delete your account', visible: false },
            },
            userName: '',
        }
    },
    components: {
        ChangePasswordForm,
        Dashboard,
        DeleteAccountForm,
        LoginForm,
        SignUpForm,
        UserMenu
    }
};
</script>

<style scoped>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>