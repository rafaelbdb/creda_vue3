<template>
    <form action="" method="post" id="deleteAccountForm" ref="deleteAccountForm" v-if="forms['deleteAccount'].visible == true">
        <input type="password" name="password" id="password" ref="password" placeholder="Password" />
        <input type="password" name="confirmPassword" id="confirmPassword" ref="confirmPassword" placeholder="Confirm password" />
        <input type="submit" value="Delete account" @click="submitDeleteAccount()" />
        <input type="button" value="Cancel" @click="showForm('deleteAccount', false)" />
    </form>
</template>

<script>
export default {
    name: 'DeleteAccountForm',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
}
</script>

<style scoped>
#deleteAccountForm {
    display: none;
}
</style>