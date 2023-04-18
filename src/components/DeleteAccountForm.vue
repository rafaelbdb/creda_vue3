<template>
    <Modal>
        <form
            id="deleteAccountForm"
            ref="deleteAccountForm"
            v-if="forms['deleteAccount'].visible == true"
            @submit.prevent="submitDeleteAccount()"
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
            <button type="submit" class="btn btn-danger" value="Delete account">
                <font-awesome-icon icon="fa-solid fa-user-xmark" />
            </button>
            <button type="button" class="btn btn-warning" value="Cancel">
                <font-awesome-icon icon="fa-solid fa-ban" />
            </button>
        </form>
    </Modal>
</template>

<script>
import { Modal } from './Modal.vue';
export default {
    name: 'DeleteAccountForm',
    props: ['forms'],
    data() {
        return {
            deleteAccount: {
                password: '',
                confirmPassword: ''
            }
        };
    },
    methods: {
        submitDeleteAccount() {
            validateForm(this.$refs.deleteAccountForm);
            let result;
            if (result) {
                this.userLoggedIn = false;
                this.userName = '';
                this.showForm('login', 'Account deleted successfully!');
            }
        }
    }
};
</script>

<style scoped>
#deleteAccountForm {
    display: none;
}
</style>
