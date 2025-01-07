<!-- src/App.vue -->
<template>
  <div id="app">
    <!-- Use the Header component -->
    <Header />

    <!-- Main Content -->
    <main class="container py-5">
      <router-view />
    </main>

    <!-- Use the Footer component -->
    <Footer />
  </div>
</template>

<script>
// Import the Header and Footer components
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';

export default {
  name: "App",
  components: {
    Header,
    Footer
  }
};
</script>

<style>
/* Global Styles */
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
}

main {
  min-height: 70vh; /* Ensuring main content area is taller */
  background-color: #ffffff;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 12px; /* Rounded corners */
  padding: 2rem; /* Adjusting padding for main content */
  margin-top: 2rem; /* Adding space above */
}
</style>
