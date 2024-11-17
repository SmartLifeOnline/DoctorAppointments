<template>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link to="/" class="navbar-brand">Werksarztzentrum</router-link>
      </div>
    </nav>
    <br>
    <br>
    <router-view></router-view>
  </div>
</template>

<script lang="ts">
export default {
  name: "App.vue"
}
</script>

<style scoped>

</style>