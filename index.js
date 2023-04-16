const defaultTitle = 'Login to your account'

const app = Vue.createApp({
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
    methods: {
        showForm(formName = '', title = defaultTitle) { 
            switch (formName) {
                case 'login':
                    this.forms.login.visible = true
                    this.forms.signUp.visible = this.forms.changePassword.visible = this.forms.deleteAccount.visible = false
                    break
                case 'signUp':
                    this.forms.signUp.visible = true
                    this.forms.login.visible = this.forms.changePassword.visible = this.forms.deleteAccount.visible = false
                    break
                case 'changePassword':
                    this.forms.changePassword.visible = true
                    this.forms.signUp.visible = this.forms.login.visible = this.forms.deleteAccount.visible = false
                    break
                case 'deleteAccount':
                    this.forms.deleteAccount.visible = true
                    this.forms.signUp.visible = this.forms.login.visible = this.forms.changePassword.visible = false
                    break
                default:
                    this.forms.login.visible = this.forms.signUp.visible = this.forms.changePassword.visible = this.forms.deleteAccount.visible = false
            }
            this.changeTitle(title)
        },

        changeTitle(pageTitle) {
            this.pageTitle = pageTitle
        },

        submitLogin() { 
            let result;
            if (result) {
                this.userLoggedIn = true
                this.userName = result.userName;
                this.showForm('', 'Welcome back, ' + this.userName + '!')
            }
        },

        submitSignUp() { 
            let result;
            if (result) {
                this.showForm('login', 'Welcome to the club, ' + this.userName + '!')
            }
        },

        submitChangePassword() { 
            let result;
            if (result) {
                this.showForm('', 'Password changed successfully!')
            }
        },

        submitDeleteAccount() { 
            let result;
            if (result) {
                this.userLoggedIn = false
                this.userName = ''
                this.showForm('login', 'Account deleted successfully!')
            }
        }
    },
})

app.mount('#app')