<template>
  <div class="full-screen-container">
    <div class="overlay"></div>
    <div class="content-container">
      <h1 class="text-center mb-4 text-primary">Privacy Policy</h1>
      <div class="content">
        <p class="lead">At Online Library, we respect your privacy and are committed to protecting the personal information you share with us.</p>

        <h3 class="mt-4">1. Information We Collect</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia, velit at vulputate malesuada, nisi erat euismod nisi, eget tincidunt sapien dui non orci.</p>

        <h3 class="mt-4">2. How We Use Your Information</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>

        <h3 class="mt-4">3. Security of Your Information</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut urna nec lectus ultricies tincidunt non eu eros.</p>

        <h3 class="mt-4">4. Changes to This Privacy Policy</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

        <p class="mt-4">If you have any questions regarding this Privacy Policy, feel free to contact us.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PrivacyPolicy',
};
</script>

<style scoped>
/* Full Screen Container */
.full-screen-container {
  position: relative;  /* Full screen width */
  background-image: url('/src/assets/background_UsefulLinks.jpg');
  background-size: cover; /* Ensure image covers the screen */
  background-position: center;
  background-attachment: fixed; /* Keeps the background fixed while scrolling */
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
  margin: 0;
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
