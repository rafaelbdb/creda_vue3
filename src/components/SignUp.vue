<template>
    <div class="signup-form">
      <h2>SignUp</h2>
      <form @submit.prevent="handleSubmit">
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="name" required />
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required />
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="password" required />
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" v-model="confirmPassword" required />

          <label for="terms">Accept terms</label>
          <input type="checkbox" name="terms" id="terms" v-model="terms" required />
          
          <button type="submit" :disabled="!isFormValid">SignUp</button>
          
          <button @click="handleLoginClick">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  import useUsers from '../composables/Users.js';
  export default {
    name: 'SignUpForm',
    setup() {
        const { createUser } = useUsers();

        return {
            createUser
        }
    },
    data() {
      return {
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        terms: false,
        minPasswordLength: 6
      }
    },
    computed: {
        isPasswordValid() {
            return (this.password.length >= this.minPasswordLength) && this.password === this.confirmPassword
        },
        isEmailValid() {
            return this.email.includes('@')
        },
        isFormValid() {
            return this.name && this.email && this.isPasswordValid && this.isEmailValid && this.terms
        },
    },
    methods: {
        handleSubmit() {
            this.createUser({
                name: this.name,
                email: this.email,
                password: this.password
            });
        },
      handleLoginClick() {
        this.$router.push('/login');
      }
    }
  }
  </script>
  
  <style scoped>
    .signup-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        width: 100%;
    }

    button:hover {
        background-color: #3e8e41;
    }

    button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

  </style>
  