<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container d-flex justify-content-center">
        <a href="/" class="navbar-brand d-flex align-items-center">
          <img src="../assets/logo.png" alt="Online Library Logo" class="logo me-2" />
          <span class="fw-bold text-light">Online Library</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="/" class="nav-link text-light">Home</a>
            </li>
            <li class="nav-item">
              <a href="/book-list" class="nav-link text-light">Book List</a>
            </li>
            <li class="nav-item">
              <a href="/sign-in" class="nav-link text-light">Profile</a>
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
  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    padding: 0.2rem 0;
    animation: fadeIn 1s ease-in-out;
  }
  
  header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('../assets/navbar.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: brightness(50%) contrast(80%);
    z-index: -1;
  }
  
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
  }
  
  .navbar-brand {
    display: flex;
    align-items: center;
    font-size: 1.5rem;
    color: #fff;
    transition: color 0.3s ease;
  }
  
  .navbar-brand img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(255, 87, 51, 0.8);
    border: 2px solid #ff5733;
    padding: 5px;
    background-color: white;
  }
  
  .navbar-brand:hover {
    color: #ff5733;
    transform: scale(1.05);
    transition: all 0.3s ease-in-out;
  }
  
  .navbar-nav .nav-link {
    font-weight: 500;
    color: #fff !important;
    position: relative;
    transition: color 0.3s ease, transform 0.2s ease;
    padding-bottom: 5px;
  }
  
  .navbar-nav .nav-link:hover {
    color: #ff5733 !important;
    transform: translateY(-2px);
    transition: transform 0.2s ease-in-out;
  }
  
  .navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 0;
    height: 2px;
    background-color: #ff5733;
    transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
    transform: translateX(-50%);
  }
  
  .navbar-nav .nav-link:hover::after {
    width: 50%;
  }
  
  .navbar-nav .active-link::after {
    width: 50%;
  }
  
  .navbar-nav .active-link {
    color: #ff5733 !important;
  }
  
  .navbar-toggler-icon {
    background-color: #fff;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  
  body {
    margin-top: 70px;
  }
  
  @media (max-width: 991px) {
    .navbar-nav {
      margin-top: 0.5rem;
    }
  }
  </style>
  