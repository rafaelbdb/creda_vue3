<template>
    <form action="" method="post" id="changePasswordForm" ref="changePasswordForm" v-if="forms['changePassword'].visible == true">
        <input type="password" name="oldPassword" id="oldPassword" ref="oldPassword" placeholder="Old password" />
        <input type="password" name="newPassword" id="newPassword" ref="newPassword" placeholder="New password" />
        <input type="password" name="confirmNewPassword" id="confirmNewPassword" ref="confirmNewPassword" placeholder="Confirm new password" />
        <input type="submit" value="Change password" @click="submitChangePassword()" />
        <input type="button" value="Cancel" @click="showForm('changePassword', false)" />
    </form>
</template>

<script>
export default {
    name: 'ChangePasswordForm',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
}
</script>

<style scoped>
#changePasswordForm {
    display: none;
}
</style>