<template>
  <div id="app">
    <!-- Header -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
          <router-link to="/" class="navbar-brand d-flex align-items-center">
            <img src="../src/assets/logo.png" alt="Online Library Logo" width="40" class="me-2" />
            <span class="fw-bold text-dark">Online Library</span>
          </router-link>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <router-link to="/" class="nav-link text-dark">Home</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/login" class="nav-link text-dark">Login</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="bg-light py-5">
      <div class="container">
        <div class="row">
          <!-- Contact Us Section -->
          <div class="col-md-4 text-center text-md-start mb-4">
            <p class="fw-bold mb-3">Contact Us</p>
            <p class="text-muted">Email: support@onlinelibrary.com</p>
            <p class="text-muted">Phone: +1 234 567 890</p>
          </div>

          <!-- Useful Links Section -->
          <div class="col-md-4 text-center mb-4">
            <p class="fw-bold mb-3">Useful Links</p>
            <ul class="list-unstyled">
              <li><router-link to="/privacy-policy" class="text-muted">Privacy Policy</router-link></li>
              <li><router-link to="/terms-of-service" class="text-muted">Terms of Service</router-link></li>
              <li><router-link to="/about-us" class="text-muted">About Us</router-link></li>
            </ul>
          </div>

          <!-- Social Media Section -->
          <div class="col-md-4 text-center text-md-end">
            <p class="fw-bold mb-3">Follow Us</p>
            <div>
              <a href="https://facebook.com" class="text-muted me-3">Facebook</a>
              <a href="https://twitter.com" class="text-muted me-3">Twitter</a>
              <a href="https://instagram.com" class="text-muted">Instagram</a>
            </div>
          </div>
        </div>

        <hr class="my-4" />

        <div class="text-center">
          <p class="text-muted mb-0">&copy; 2025 Online Library. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
/* Desain Minimalis dan Elegan */
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f4f9;
  margin: 0;
  padding: 0;
}

header {
  border-bottom: 1px solid #ddd;
}

.navbar-brand {
  display: flex;
  align-items: center;
  font-size: 1.2rem;
}

.navbar-brand img {
  max-width: 40px; /* Ukuran logo */
}

.navbar-nav .nav-link {
  font-weight: 500;
  color: #555 !important;
}

.navbar-nav .nav-link:hover {
  color: #007bff !important;
  text-decoration: none;
}

footer {
  background-color: #f8f9fa;
  font-size: 0.875rem;
}

footer .text-muted {
  color: #6c757d;
}

footer a {
  text-decoration: none;
}

footer a:hover {
  color: #007bff;
  text-decoration: underline;
}

footer .row {
  margin-bottom: 30px;
}

footer .list-unstyled {
  padding-left: 0;
}

footer .text-center {
  text-align: center;
}

footer .text-md-start {
  text-align: left;
}

footer .text-md-end {
  text-align: right;
}

.container {
  max-width: 1200px;
}

main {
  min-height: 70vh;
}
</style>
