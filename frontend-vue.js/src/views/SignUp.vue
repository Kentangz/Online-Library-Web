<template>
    <div class="form-container">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="text-center mb-4">Sign Up</h3>
          <form @submit.prevent="handleSignUp">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" v-model="name" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" v-model="email" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" v-model="password" required />
            </div>
            <div class="mb-3">
              <label for="confirm-password" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm-password" v-model="confirmPassword" required />
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success">Sign Up</button>
            </div>
          </form>
          <div class="text-center mt-3">
            <p>Already have an account? <a href="/sign-in">Sign In</a></p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SignUp',
    data() {
      return {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      };
    },
    methods: {
      handleSignUp() {
        if (this.password !== this.confirmPassword) {
          alert("Passwords don't match.");
          return;
        }
        // Handle Sign Up logic
        console.log('Sign Up', this.name, this.email, this.password);
      }
    }
  };
  </script>
  
  <style scoped>
  .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;
  }
  .card {
    width: 100%;
    max-width: 400px;
  }
  .card-body {
    padding: 2rem;
  }
  h3 {
    font-size: 1.5rem;
    color: #333;
  }
  </style>
  