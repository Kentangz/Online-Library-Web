<template>
  <div>
    <!-- Hero Section -->
    <div class="hero-section">
      <div class="container">
        <h1 class="hero-title">Welcome to Online Library</h1>
        <p class="hero-subtitle">
          Discover, Learn, and Grow with Thousands of Resources!
        </p>
        <div class="button-group">
          <button class="btn primary" @click="goToAboutLibrary">Explore Now</button>
          <button class="btn secondary" @click="goToSignUp">Sign Up</button>
        </div>
      </div>
    </div>

    <!-- About Library Section -->
    <div ref="aboutLibrarySection" class="about-library-section">
      <AboutLibrary />
    </div>

    <!-- Featured Books Section -->
    <div ref="featuredBooksSection" class="featured-books-section">
      <FeaturedBooks />
    </div>

    <!-- New Arrivals Section -->
    <div ref="newArrivalsSection" class="new-arrivals-section">
      <NewArrivals />
    </div>

    <!-- How It Works Section -->
    <div ref="howItWorksSection" class="how-it-works-section">
      <HowItWorks />
    </div>

    <!-- Testimonials Section -->
    <div ref="testimonialsSection" class="testimonials-section">
      <Testimonials />
    </div>

    <!-- Benefits Section -->
    <div ref="benefitsSection" class="benefits-section">
      <Benefits />
    </div>

    <!-- Call to Action Section -->
    <div ref="callToActionSection" class="call-to-action-section">
      <CallToAction />
    </div>
  </div>
</template>

<script>
// Import komponen yang diperlukan
import AboutLibrary from "../components/home-section/AboutLibrary.vue";
import FeaturedBooks from "../components/home-section/FeaturedBooks.vue";
import NewArrivals from "../components/home-section/NewArrivals.vue";
import HowItWorks from "../components/home-section/HowItWorks.vue";
import Testimonials from "../components/home-section/Testimonials.vue";
import Benefits from "../components/home-section/Benefits.vue";
import CallToAction from "../components/home-section/CallToAction.vue";

export default {
  name: "Home",
  components: {
    AboutLibrary,
    FeaturedBooks,
    NewArrivals,
    HowItWorks,
    Testimonials,
    Benefits,
    CallToAction,
  },
  methods: {
    // Fungsi untuk menggulir ke bagian AboutLibrary
    goToAboutLibrary() {
      this.$refs.aboutLibrarySection.scrollIntoView({
        behavior: "smooth", // Animasi smooth scroll
        block: "start", // Menyelaraskan bagian atas AboutLibrary dengan bagian atas layar
      });
    },
    goToSignUp() {
      this.$router.push("/signup");
    },
  },
};
</script>

<style scoped>
/* Tambahan dan penyesuaian sesuai kebutuhan */
.hero-section {
  height: 50vh;
  background-image: url("src/assets/home/home-section.jpg"); /* Replace with your image */
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: white;
  opacity: 0;
  animation: fadeIn 1.5s ease-out forwards;
  position: relative;
}

.hero-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
}

.container {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-family: "Roboto", sans-serif;
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
  opacity: 0;
  animation: fadeInDown 1s ease-out forwards;
}

.hero-subtitle {
  font-size: 1.5rem;
  font-weight: 300;
  margin-bottom: 2rem;
  opacity: 0;
  animation: fadeInUp 1.2s ease-out forwards;
}

.button-group {
  display: flex;
  justify-content: center;
  gap: 1rem;
  opacity: 0;
  animation: fadeIn 1.4s ease-out forwards;
}

.btn {
  padding: 0.8rem 2rem;
  font-size: 1rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn.primary {
  background-color: #007bff;
  color: white;
}

.btn.primary:hover {
  background-color: #0056b3;
}

.btn.secondary {
  background-color: transparent;
  border: 2px solid white;
  color: white;
}

.btn.secondary:hover {
  background-color: white;
  color: #007bff;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Media Queries */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .btn {
    font-size: 0.9rem;
    padding: 0.7rem 1.5rem;
  }
}
</style>
