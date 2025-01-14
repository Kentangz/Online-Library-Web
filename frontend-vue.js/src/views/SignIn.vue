<template>
  <div class="form-container">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="text-center mb-4">Sign In</h3>
        <form @submit.prevent="handleSignIn">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              v-model="email"
              required
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              v-model="password"
              required
            />
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" :disabled="isLoading">
              <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span v-else>Sign In</span>
            </button>
          </div>
        </form>
        <div class="text-center mt-3">
          <p v-if="isLoading">Loading...</p>
          <p v-else>Don't have an account? <a href="/sign-up">Sign Up</a></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../api';

export default {
  name: 'SignIn',
  data() {
    return {
      email: '',
      password: '',
      isLoading: false,
    };
  },
  methods: {
    async handleSignIn() {
      this.isLoading = true;
      try {
        // Try to login as user
        const userResponse = await api.post('/user/login', {
          email: this.email,
          password: this.password,
        });

        // If successful login for user
        const userId = userResponse.data.data.id_user;
        localStorage.setItem('user_id', userId);  // Store user ID
        this.$router.push('/user-dashboard'); // Redirect to user dashboard

      } catch (userError) {
        // Try to login as admin if user login fails
        try {
          const adminResponse = await api.post('/admin/login', {
            email: this.email,
            password: this.password,
          });

          // If successful login for admin
          const adminId = adminResponse.data.data.id;
          localStorage.setItem('admin_id', adminId); // Store admin ID
          this.$router.push('/dashboard-admin'); // Redirect to admin dashboard

        } catch (adminError) {
          // If both user and admin login fail, show an error
          console.error('Sign In Failed:', adminError);
          alert('Invalid email or password.');
        }
      }
      finally {
        this.isLoading = false; // Stop loading indicator
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
