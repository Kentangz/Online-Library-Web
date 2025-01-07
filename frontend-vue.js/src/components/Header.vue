<!-- src/components/Header.vue -->
<template>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
          <router-link to="/" class="navbar-brand d-flex align-items-center">
            <img src="../assets/logo.png" alt="Online Library Logo" width="40" class="me-2" />
            <span class="fw-bold text-light">Online Library</span>
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
                <router-link to="/" class="nav-link text-light">Home</router-link>
              </li>
              <li class="nav-item">
                <router-link to="/login" class="nav-link text-light">Login</router-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  </template>
  
  <script>
  export default {
    name: "Header",
  };
  </script>
  
  <style scoped>
  /* Header Styling */
  header {
    border-bottom: 1px solid #ddd;
    background-color: #343a40; /* Dark header background */
  }
  
  .navbar-brand {
    display: flex;
    align-items: center;
    font-size: 1.25rem;
    color: #fff;
  }
  
  .navbar-brand img {
    max-width: 40px;
  }
  
  .navbar-nav .nav-link {
    font-weight: 500;
    color: #fff !important;
  }
  
  .navbar-nav .nav-link:hover {
    color: #ff5733 !important;
    text-decoration: none;
  }
  </style>
  