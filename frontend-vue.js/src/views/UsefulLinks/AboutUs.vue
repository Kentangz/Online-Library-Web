<template>
  <div class="about-us-page">
    <div class="hero-section" ref="heroSection">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>About Us</h1>
        <p>Your gateway to knowledge and library resources.</p>
      </div>
    </div>
    <div class="info-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 content-block" ref="mission">
            <h2>Our Mission</h2>
            <p>To provide a seamless and efficient experience for users seeking library-related information and resources in a digital environment.</p>
          </div>
          <div class="col-md-12 content-block" ref="vision">
            <h2>Our Vision</h2>
            <p>To bridge the gap between traditional libraries and modern technology, making knowledge accessible to everyone, everywhere.</p>
          </div>
          <div class="col-md-12 content-block" ref="whyChooseUs">
            <h2>Why Choose Us?</h2>
            <ul>
              <li>Effortless access to comprehensive library information.</li>
              <li>Easy-to-navigate platform tailored for all users.</li>
              <li>Available anytime and anywhere to meet your needs.</li>
            </ul>
          </div>
          <div class="col-md-12 content-block text-center" ref="contactUs">
            <p>If you have any questions or would like to learn more, <a class="cta-link" href="#">contact us!</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AboutUs",
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    this.addSlideInEffect();
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      const heroSection = this.$refs.heroSection;
      heroSection.style.backgroundPosition = `center ${window.scrollY * 0.4}px`;
    },
    addSlideInEffect() {
      const elements = [this.$refs.mission, this.$refs.vision, this.$refs.whyChooseUs, this.$refs.contactUs];
      let delay = 0;
      elements.forEach((el) => {
        setTimeout(() => el.classList.add('slide-in'), delay);
        delay += 300;
      });
    }
  }
};
</script>

<style scoped>
body {
  margin: 0;
  font-family: 'Roboto', sans-serif;
  line-height: 1.6;
}

.hero-section {
  position: relative;
  background-image: url('/src/assets/UsefulLinks_image/library-hero.jpg');
  background-size: cover;
  background-position: center;
  height: 40vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  text-align: center;
  background-attachment: fixed;
}


.hero-section .overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.6);
}

.hero-section .hero-content {
  position: relative;
  z-index: 2;
  max-width: 600px;
}

.hero-section h1 {
  font-family: 'Lora', serif;
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.hero-section p {
  font-size: 1.2rem;
  font-weight: 300;
}

.info-section {
  background-color: #f9f9f9;
  padding: 3rem 1.5rem;
}

.content-block {
  margin-bottom: 2rem;
  opacity: 0;
  transform: translateX(-50px);
  transition: transform 0.5s ease-out, opacity 0.5s ease-out;
}

.content-block h2 {
  font-family: 'Lora', serif;
  font-size: 1.8rem;
  color: #343a40;
  margin-bottom: 0.5rem;
}

.content-block p,
.content-block ul {
  color: #495057;
  font-size: 1rem;
}

.content-block ul {
  list-style: none;
  padding: 0;
}

.content-block ul li {
  position: relative;
  padding-left: 1.5rem;
  margin-bottom: 0.5rem;
}

.content-block ul li::before {
  content: "✔";
  position: absolute;
  left: 0;
  color: #007bff;
}

.text-center {
  text-align: center;
}

.cta-link {
  color: #007bff;
  font-weight: bold;
  text-decoration: none;
}

.cta-link:hover {
  text-decoration: underline;
}

.container {
  max-width: 960px;
}

@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem;
  }
  .hero-section p {
    font-size: 1rem;
  }
  .info-section {
    padding: 2rem 1rem;
  }
  .content-block h2 {
    font-size: 1.5rem;
  }
}

.slide-in {
  opacity: 1;
  transform: translateX(0);
}
</style>
