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
            <button type="submit" class="btn btn-primary">Sign In</button>
          </div>
        </form>
        <div class="text-center mt-3">
          <p>Don't have an account? <a href="/sign-up">Sign Up</a></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Api from '../api'; // Import API service

export default {
  name: 'SignIn',
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async handleSignIn() {
      try {
        const response = await Api.post('/admin/login', {
          email: this.email,
          password: this.password
        });

        // Simpan admin_id di localStorage
        const adminId = response.data.data.id; // Sesuaikan struktur respons API
        localStorage.setItem('admin_id', adminId);

        // Redirect ke halaman profil admin
        this.$router.push('/dashboard-admin');
      } catch (error) {
        console.error('Sign In Failed', error);
        alert('Invalid email or password.');
      }
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
