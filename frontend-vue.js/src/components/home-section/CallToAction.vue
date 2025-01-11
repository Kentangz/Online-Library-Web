<template>
    <section class="call-to-action">
      <div class="container">
        <h2 class="cta-title">Ready to Start Your Journey?</h2>
        <p class="cta-text">Join thousands of readers and explore a world of knowledge.</p>
        <button class="btn primary" @click="goToSignUp">Get Started Now</button>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "CallToAction",
    methods: {
      goToSignUp() {
        // Mengarahkan pengguna ke halaman SignUp
        this.$router.push("/sign-in");
      },
    },
  };
  </script>
  
  <style scoped>
  .call-to-action {
    padding: 3rem 0;
    background-color: #007bff;
    color: white;
    text-align: center;
  }
  .cta-title {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  .cta-text {
    font-size: 1rem;
    margin-bottom: 2rem;
  }
  .btn.primary {
    padding: 0.8rem 2rem;
    background-color: white;
    color: #007bff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
  }
  .btn.primary:hover {
    background-color: #f2f2f2;
  }
  </style>
  