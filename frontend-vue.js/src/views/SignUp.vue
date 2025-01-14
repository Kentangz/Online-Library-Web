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
          <div class="mb-3">
            <label for="nomor_hp" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="nomor_hp" v-model="nomor_hp" required />
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" :disabled="isLoading">
              <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span v-else>Sign Up</span>
            </button>
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
import Api from '../api'; // Import API service

export default {
  name: 'SignUp',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      nomor_hp: '', // Add nomor_hp here
      isLoading: false, // Flag for loading state
    };
  },
  methods: {
    async handleSignUp() {
      // Check if passwords match
      if (this.password !== this.confirmPassword) {
        alert("Passwords don't match.");
        return;
      }

      this.isLoading = true; // Set loading state to true

      try {
        const response = await Api.post('/user/register', {
          nama: this.name,
          email: this.email,
          password: this.password,
          nomor_hp: this.nomor_hp, // Include nomor_hp in request
        });

        if (response.data.success) {
          alert('Registration successful!');
          this.$router.push('/sign-in'); // Redirect to sign-in page
        } else {
          alert('Registration failed: ' + response.data.message);
        }
      } catch (error) {
        console.error('Sign Up Failed', error);
        alert('An error occurred during registration.');
      } finally {
        this.isLoading = false; // Reset loading state
      }
    },
  },
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

.spinner-border {
  margin-right: 0.5rem;
}
</style>
