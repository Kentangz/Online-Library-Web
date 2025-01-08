<template>
  <div id="app">
    <Header />
    <main class="container py-5">
      <router-view />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import './style.css';  // Importing the style.css from the correct location

export default {
  name: "App",
  components: {
    Header,
    Footer
  }
};
</script>
