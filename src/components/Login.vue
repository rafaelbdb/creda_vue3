<template>
  <div class="login-form">
    <h2>Login</h2>
    <form @submit.prevent="handleSubmit">
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="email" required />
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="password" required />
      <button type="submit">Login</button>
      <button @click="handleSignupClick">Sign up</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "LoginForm",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    handleSubmit() {
      // Validate the form inputs
      if (!this.email || !this.password) {
          alert("Please fill in all fields");
          return;
      }

      axios
        .post("http://creda_vue3/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.info("Login successful");
        //   console.log(`User data => ${response.data}`);
          this.$router.push("/movements");
        //   this.$router.push("/auth");
        })
        .catch((error) => {
          // Handle any errors or failed login attempts
          console.error("Login failed:", error);
          alert("Login failed. Please try again.");
        });
    },
  },
  handleSignupClick() {
    this.$router.push("/signup");
  },
};
</script>

<style scoped>
.login-form {
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
</style>
