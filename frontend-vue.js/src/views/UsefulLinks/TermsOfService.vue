<template>
  <div class="full-screen-container">
    <div class="overlay"></div>
    <div class="content-container">
      <h1 class="text-center mb-4 text-primary">Terms of Service</h1>
      <div class="content">
        <p class="lead">By using our services, you agree to comply with the following terms and conditions. Please read them carefully.</p>

        <h3 class="mt-4">1. Acceptance of Terms</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula justo nec risus malesuada, nec pharetra neque feugiat.</p>

        <h3 class="mt-4">2. User Responsibilities</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse scelerisque, elit ac cursus congue, est nisl venenatis nunc, vel tincidunt lorem augue in eros.</p>

        <h3 class="mt-4">3. Prohibited Uses</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam erat volutpat. Integer fermentum consequat ligula, vitae suscipit felis.</p>

        <h3 class="mt-4">4. Limitation of Liability</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida magna ut metus euismod, non elementum libero posuere.</p>

        <h3 class="mt-4">5. Termination</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut ipsum tristique, dapibus ligula vitae, consectetur sem.</p>

        <p class="mt-4">If you have any questions regarding these Terms of Service, please contact us.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TermsOfService',
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
