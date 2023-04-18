const defaultTitle = 'Login to your account';

const app = Vue.createApp({
    data() {
        return {
            pageTitle: defaultTitle,
            userLoggedIn: false,
            forms: {
                login: { title: 'Login to your account', visible: true },
                signUp: { title: 'Sign up for an account', visible: false },
                changePassword: {
                    title: 'Change your password',
                    visible: false
                },
                deleteAccount: { title: 'Delete your account', visible: false },
                movement: { title: 'Set movement', visible: false }
            },
            modal: {
                title: '',
                visible: false,
            },
            userName: ''
        };
    },
    methods: {
        showForm(formName) {
            this.forms[formName].visible = true;
            Object.keys(this.forms).forEach((form) => {
                if (form !== formName) {
                    this.forms[form].visible = false;
                }
            });
            this.changeTitle(this.forms[formName].title);
        },

        changeTitle(pageTitle) {
            this.pageTitle = pageTitle;
        },

        validateForm(form) {
            for (let i = 0; i < form.elements.length; i++) {
                if (!form.elements[i].value) {
                    return false;
                }
            }
            return true;
        }
    }
});

app.mount('#app');
