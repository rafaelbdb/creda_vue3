<template>
    <form action="" method="post" id="signupForm" ref="signupForm" v-if="forms['signUp'].visible == true">
        <input type="text" name="name" id="name" ref="name" placeholder="Name" />
        <input type="text" name="surname" id="surname" ref="surname" placeholder="Surname" />
        <input type="text" name="username" id="username" ref="username" placeholder="Username" />
        <input type="email" name="email" id="email" ref="email" placeholder="Email" />
        <input type="password" name="password" id="password" ref="password" placeholder="Password" />
        <input type="password" name="confirmPassword" id="confirmPassword" ref="confirmPassword" placeholder="Confirm password" />
        <input type="submit" value="Signup" @click="submitSignUp()" />
        <input type="button" value="Login" @click="showForm('login')" />
    </form>
</template>

<script>
export default {
    name: 'SignUpForm',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
}
</script>

<style scoped>
#signupForm {
    display: none;
}
</style>