<template>
  <div class="full-screen-container">
    <div class="overlay"></div>
    <div class="content-container">
      <h1 class="text-center mb-4 text-primary">About Us</h1>
      <div class="content">
        <p class="lead">Online Library is a digital platform designed to provide easy access to a wide variety of books and educational resources. Our mission is to make learning more accessible to everyone.</p>

        <h3 class="mt-4">Our Mission</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc facilisis, lorem in lacinia vehicula, justo nisi bibendum risus, eu cursus nunc est sit amet erat.</p>

        <h3 class="mt-4">Our Team</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fermentum, nunc ut scelerisque gravida, nunc erat euismod dui, vel faucibus orci leo nec lorem.</p>

        <h3 class="mt-4">Why Choose Us?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae urna quis neque consequat scelerisque. Etiam ut ligula eu felis varius mattis.</p>

        <p class="mt-4">If you would like to learn more or have any questions, feel free to contact us!</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutUs',
};
</script>

<style scoped>
/* Full Screen Container */
.full-screen-container {
  position: relative;
  height: 100vh; /* Full screen height */
  background-image: url('/src/assets/background_UsefulLinks.jpg');
  background-size: cover;
  background-position: center;
  color: #fff;
}

/* Black overlay */
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5); /* Black overlay */
  z-index: 1;
}

/* Content Container */
.content-container {
  position: relative;
  z-index: 2;
  padding: 40px;
  max-width: 900px;
  margin: auto;
}

h1, h3 {
  font-family: 'Lora', serif;
  font-weight: 700;
}

.content {
  font-family: 'Roboto', sans-serif;
  font-size: 1rem;
  color: #fff;
}
</style>
