<template>

  <div class="card">
          <div class="card-header">Login Form</div>
          <div class="card-body"> 
          
              <form  @submit.prevent="loginUser">
        
              <label>Email</label>
              <input type="email" v-model="user.email" name="email" id="email" class ="form-control"/>
  
              <label>Password</label>
              <input type="password" v-model="user.password" name="password" id="password" class ="form-control"/> 
              <p>You don't have an account? <router-link to="/register">Register</router-link></p>
  
  
              <input type="submit" value="Login" class="btn btn-success"> 
  
  
              </form>
          </div>
      </div>
  </template>
  
  <script>
    import axios from 'axios';

    export default {
        name: 'Login',
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                },
                errorMessage: ''
            };
        },
        methods: {
            async loginUser() {
                
                try {
                    const response = await axios.post("http://127.0.0.1:8000/api/login", this.user);
                    alert("Login successful!");
                    console.log(response.data);   
                    
                    if (document.cookie.split(';').some((item) => item.trim().startsWith('XSRF-TOKEN='))) {
                        // Redirect to Dashboard component after successful login
                        
                    } else {
                        this.errorMessage = "Login successful but cookie not set.";
                    }
                   
                } catch (error) {
                    console.error("There was an error logging in!", error);
                    if (error.response && error.response.status === 401) {
                        this.errorMessage = "Invalid credentials. Please try again.";
                    } else {
                        this.errorMessage = "An error occurred. Please try again later.";
                    }
                }
            }
        }
    };
</script>

<style>
    .error-message {
        color: red;
    }
</style>