<template>
    <Modal>
        <form
            id="changePasswordForm"
            ref="changePasswordForm"
            v-if="forms['changePassword'].visible == true"
            @submit.prevent="submitChangePassword()"
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
            <button type="submit" value="Change password">
                <font-awesome-icon icon="fa-solid fa-key" />
            </button>
            <button type="button" value="Cancel">
                <font-awesome-icon icon="fa-solid fa-ban" />
            </button>
        </form>
    </Modal>
</template>

<script>
import { Modal } from './Modal.vue';
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
        };
    },
    methods: {
        submitChangePassword() {
            validateForm(this.$refs.changePasswordForm);
            let result;
            if (result) {
                this.showForm('', 'Password changed successfully!');
            }
        }
    }
};
</script>

<style scoped>
#changePasswordForm {
    display: none;
}
</style>
