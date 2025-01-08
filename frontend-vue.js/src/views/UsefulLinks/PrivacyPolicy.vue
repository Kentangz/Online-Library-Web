<template>
  <div class="full-screen-container">
    <div class="overlay"></div>
    <div class="content-container">
      <!-- Logo -->
      <img src="/frontend-vue.js/src/assets/logo.png" alt="Library Logo" class="logo" />

      <!-- Title -->
      <h1 class="text-center mb-4">About Us</h1>

      <!-- Content -->
      <div class="content">
        <p class="lead">
          With this website, finding information and exploring the scope of the library has never been easier. Our platform is designed to streamline your access to knowledge and resources.
        </p>

        <h3>Our Mission</h3>
        <p>To provide a seamless and efficient experience for users seeking library-related information and resources in a digital environment.</p>

        <h3>Our Vision</h3>
        <p>To bridge the gap between traditional libraries and modern technology, making knowledge accessible to everyone, everywhere.</p>

        <h3>Why Choose Us?</h3>
        <ul>
          <li>Effortless access to comprehensive library information.</li>
          <li>Easy-to-navigate platform tailored for all users.</li>
          <li>Available anytime and anywhere to meet your needs.</li>
        </ul>

        <p class="mt-4">
          If you have any questions or would like to learn more, 
          <a href="/contact" class="highlight-link">contact us</a> today!
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AboutUs",
};
</script>

<style scoped>
/* Full Screen Container */
.full-screen-container {
  position: relative;
  height: 100vh;
  background-image: url('/src/assets/background_AboutUs.jpg'); /* Replace with a suitable background image */
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 1rem;
}

/* Black Overlay */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
}

/* Content Container */
.content-container {
  position: relative;
  z-index: 2;
  background: rgba(255, 255, 255, 0.1);
  padding: 2rem 3rem;
  max-width: 800px;
  text-align: center;
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}

/* Logo */
.logo {
  max-width: 150px;
  margin-bottom: 1.5rem;
}

/* Typography */
h1 {
  font-family: 'Lora', serif;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #ffdd57;
}

h3 {
  font-family: 'Lora', serif;
  font-size: 1.5rem;
  font-weight: 600;
  margin-top: 2rem;
  color: #fff;
}

p,
ul {
  font-family: 'Roboto', sans-serif;
  font-size: 1rem;
  line-height: 1.6;
  color: #f8f9fa;
}

ul {
  list-style: none;
  padding: 0;
  margin-top: 1rem;
}

ul li {
  margin-bottom: 0.5rem;
  position: relative;
  padding-left: 1.5rem;
}

ul li::before {
  content: "✔";
  position: absolute;
  left: 0;
  color: #ffdd57;
  font-size: 1.2rem;
}

/* Highlighted Links */
.highlight-link {
  color: #ffdd57;
  font-weight: bold;
  text-decoration: none;
}

.highlight-link:hover {
  text-decoration: underline;
}
</style>
