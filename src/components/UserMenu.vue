<template>
    <menu type="context" id="userMenu" ref="userMenu">
        <li id="menuLogout" ref="menuLogout" @click="showForm('login')">Logout</li>
        <li id="changePassword" ref="changePassword" @click="showForm('changePassword')">Change password</li>
        <li id="deleteAccount" ref="deleteAccount" @click="showForm('deleteAccount')">Delete account</li>
    </menu>
</template>

<script>
export default {
    name: 'UserMenu',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
}

</script>

<style scoped>
#userMenu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
</style>