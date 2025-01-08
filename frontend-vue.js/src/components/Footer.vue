<template>
    <footer class="bg-dark text-center text-lg-start text-white footer-slide">
      <div class="container py-3">
        <div class="row">
          <div class="col-md-3 mb-3">
            <div id="map-container" style="width: 100%; height: 200px; border-radius: 10px; overflow: hidden;">
              <iframe src="https://www.google.com/maps/embed?pb=..."></iframe>
            </div>
          </div>
  
          <div class="col-md-3 mb-3">
            <h5 class="text-uppercase mb-3">Quick Links</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><router-link to="/about-us" class="text-white quicklink">About Us</router-link></li>
              <li class="mb-2"><router-link to="/FAQ" class="text-white quicklink">FAQ</router-link></li>
            </ul>
          </div>
  
          <div class="col-md-3 mb-3">
            <h5 class="text-uppercase mb-3">Contact</h5>
            <ul class="list-unstyled">
              <li><p><i class="fas fa-map-marker-alt pe-2"></i>Jl. Indonesia. No.01, Indonesia, Indonesia</p></li>
              <li><p><i class="fas fa-phone pe-2"></i>+62123456789</p></li>
              <li><p><i class="fas fa-envelope pe-2 mb-0"></i>support@onlinelibrary.com</p></li>
            </ul>
          </div>
  
          <div class="col-md-3 mb-3">
            <h5 class="text-uppercase mb-3">Follow Us</h5>
            <p class="mb-4 follow-text">Stay connected and follow us on our social media for updates!</p>
            <ul class="list-unstyled d-flex justify-content-center follow-icons">
              <li class="mb-2 px-2"><a href="https://facebook.com" class="text-white" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a></li>
              <li class="mb-2 px-2"><a href="https://instagram.com" class="text-white" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></li>
              <li class="mb-2 px-2"><a href="https://twitter.com" class="text-white" target="_blank"><i class="fab fa-twitter fa-2x"></i></a></li>
              <li class="mb-2 px-2"><a href="https://tiktok.com" class="text-white" target="_blank"><i class="fab fa-tiktok fa-2x"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
  
      <div class="text-center py-2" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2025 Online Library. All Rights Reserved.
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: "Footer",
  };
  </script>
  
  <style scoped>
  footer {
    background-color: #343a40;
    color: white;
    padding-top: 2rem;
    border-top-left-radius: 10%;
    border-top-right-radius: 10%;
  }
  
  .footer-slide {
    animation: slideUp 1s ease-out forwards;
  }
  
  @keyframes slideUp {
    from { transform: translateY(100%); }
    to { transform: translateY(0); }
  }
  
  footer .container {
    padding: 1rem;
    max-width: 1200px;
    margin: 0 auto;
  }
  
  footer .text-center {
    text-align: center;
  }
  
  footer .fab, .fas {
    font-size: 1.25rem;
  }
  
  footer .fab:hover, .fas:hover {
    color: #ff5733;
  }
  
  footer .text-uppercase {
    font-weight: 600;
  }
  
  .follow-text {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  
  .follow-icons {
    display: flex;
    justify-content: center;
  }
  
  .follow-icons li {
    margin: 0 10px;
  }
  
  .quicklink {
    text-decoration: none;
    color: white;
    transition: all 0.3s ease-in-out;
  }
  
  .quicklink:hover {
    color: #ff5733;
    text-decoration: underline;
  }
  
  #map-container {
    border-radius: 10px;
    overflow: hidden;
  }
  </style>
  