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

export default {
  name: "App",
  components: {
    Header,
    Footer
  }
};
</script>

<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
}


#app {
  background-image: url('../src/assets/bgApp.jpg');
  background-size: 300% 300%;
  background-position: 0% 50%;
  animation: imageMovement 420s linear infinite;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

@keyframes imageMovement {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

main {
  min-height: 70vh;
  background-color: rgba(255, 255, 255, 0.8);
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  padding: 2rem;
  margin-top: 2rem;
  flex-grow: 1;
}
</style>
