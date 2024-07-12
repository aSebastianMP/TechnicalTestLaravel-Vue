<template>

    <div class="card">
            <div class="card-header">Register Form</div>
            <div class="card-body"> 
            
                <form  @submit.prevent="saveData">
                
                <label>Name</label>
                <input type="text" v-model="user.name" name="name" id="name" class ="form-control"/> 
    
          
                <label>Email</label>
                <input type="email" v-model="user.email" name="email" id="email" class ="form-control"/>
    
                <label>Password</label>
                <input type="password" v-model="user.password" name="password" id="password" class ="form-control"/> 
                <p>Already have an account? <router-link to="/login">Login here</router-link></p>
    
    
                <input type="submit" value="Save" class="btn btn-success"> 
    
    
                </form>
            </div>
        </div>
    </template>
       
       <script>
           import axios from 'axios';

         export default {
           name: 'Register',
           data () {
             return {
               result: {},
               user:{
                          name: '',
                          email: '',
                          password: ''
               }
             }
           },
           created() { 
           },
           mounted() {
                 console.log("mounted() called.......");
             },
           methods: {
                  saveData()
                  {
                   axios.post("http://127.0.0.1:8000/api/register", this.user)
                   .then(
                     ({data})=>{
                      console.log(data);
                       try 
                         {
                            alert("saved");
                            
                          } 
                      catch(err) 
                          {
                            alert("failed");
                          }    
                     }
                   )
                  }
             }
         }
         </script>