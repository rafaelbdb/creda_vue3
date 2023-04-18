<template>
    <form
        method="post"
        id="changePasswordForm"
        ref="changePasswordForm"
        v-if="forms['changePassword'].visible == true"
    >
        <input
            type="password"
            name="oldPassword"
            id="oldPassword"
            ref="oldPassword"
            placeholder="Old password"
            required
            v-model="changePassword.oldPassword"
        />
        <input
            type="password"
            name="newPassword"
            id="newPassword"
            ref="newPassword"
            placeholder="New password"
            required
            v-model="changePassword.newPassword"
        />
        <input
            type="password"
            name="confirmNewPassword"
            id="confirmNewPassword"
            ref="confirmNewPassword"
            placeholder="Confirm new password"
            required
            v-model="changePassword.confirmNewPassword"
        />
        <button
            type="submit"
            value="Change password"
            @click="submitChangePassword()"
        ><font-awesome-icon icon="fa-solid fa-key" /></button>
        <button
            type="button"
            value="Cancel"
            @click="showForm('changePassword', false)"
        ><font-awesome-icon icon="fa-solid fa-ban" /></button>
    </form>
</template>

<script>
export default {
    name: 'ChangePasswordForm',
    props: ['forms'],
    data() {
        return {
            changePassword: {
                oldPassword: '',
                newPassword: '',
                confirmNewPassword: ''
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
#changePasswordForm {
    display: none;
}
</style>
