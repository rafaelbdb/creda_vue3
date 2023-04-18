<template>
    <form
        method="post"
        id="deleteAccountForm"
        ref="deleteAccountForm"
        v-if="forms['deleteAccount'].visible == true"
    >
        <input
            type="password"
            name="password"
            id="password"
            ref="password"
            placeholder="Password"
            required
            v-model="deleteAccount.password"
        />
        <input
            type="password"
            name="confirmPassword"
            id="confirmPassword"
            ref="confirmPassword"
            placeholder="Confirm password"
            required
            v-model="deleteAccount.confirmPassword"
        />
        <button
            type="submit"
            value="Delete account"
            @click="submitDeleteAccount()"
        ><font-awesome-icon icon="fa-solid fa-user-xmark" /></button>
        <button
            type="button"
            value="Cancel"
            @click="showForm('deleteAccount', false)"
        ><font-awesome-icon icon="fa-solid fa-ban" /></button>
    </form>
</template>

<script>
export default {
    name: 'DeleteAccountForm',
    props: ['forms'],
    data() {
        return {
            deleteAccount: {
                password: '',
                confirmPassword: ''
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
#deleteAccountForm {
    display: none;
}
</style>
