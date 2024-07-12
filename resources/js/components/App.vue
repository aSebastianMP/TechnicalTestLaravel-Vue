<template>
    <div id="app">
        <nav>
            <router-link to="/register">Register</router-link> |
            <router-link to="/login">Login</router-link> |
            <router-link to="/dashboard">Dashboard</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'App',
    computed: {
    isAuthenticated() {
      return !!document.cookie.match(/^(.*;)?\s*jwt\s*=\s*[^;]+(.*)?$/);
    }
  }
}
</script>

<style>
nav {
    padding: 10px;
}
nav a {
    margin: 0 10px;
    text-decoration: none;
    color: #42b983;
}
</style>