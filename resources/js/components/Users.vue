<template>
    <div>
      <h2>Users</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <button @click="editUser(user)">Edit</button>
              <button @click="deleteUser(user.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      showEditModal: false,
      currentUser: {
        id: null,
        name: '',
        email: ''
      }
    };
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get('/api/users')
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    editUser(id) {
      axios.get(`/api/users/${id}`)
        .then(response => {
          this.currentUser = response.data;
          this.showEditModal = true;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateUser() {
      axios.put(`http://127.0.0.1:8000/api/users/${this.currentUser.id}`, this.currentUser)
        .then(response => {
          this.fetchUsers();
          this.showEditModal = false;
          alert(response.data.message);
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteUser(id) {
      axios.delete(`http://127.0.0.1:8000/api/users/${id}`)
        .then(response => {
          this.fetchUsers();
          alert(response.data.message);
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>

<style>
.modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: white;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
</style>