<template>
    <div class="testimonials-section">
      <div class="container">
        <h2 class="section-title">What Our Users Say</h2>
        <div class="row">
          <div v-for="testimonial in testimonials" :key="testimonial.id" class="col-md-4">
            <div class="testimonial-card">
              <img :src="testimonial.image" alt="User photo" class="testimonial-image" />
              <p class="testimonial-quote">"{{ testimonial.quote }}"</p>
              <h5 class="testimonial-name">{{ testimonial.name }}</h5>
              <p class="testimonial-role">{{ testimonial.role }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Testimonials",
    data() {
      return {
        testimonials: [
          {
            id: 1,
            name: "John Doe",
            role: "Student",
            quote: "This platform has changed how I learn. Highly recommended!",
            image: "src/assets/testimoni-profile/cat.png",
          },
          {
            id: 2,
            name: "Jane Smith",
            role: "Teacher",
            quote: "A fantastic library with resources for everyone.",
            image: "src/assets/testimoni-profile/cat.png",
          },
          {
            id: 3,
            name: "Michael Lee",
            role: "Researcher",
            quote: "The best online library I've ever used!",
            image: "src/assets/testimoni-profile/cat.png",
          },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .testimonials-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
  }
  
  .section-title {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2rem;
    font-weight: bold;
  }
  
  .testimonial-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  
  .testimonial-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 1rem;
  }
  
  .testimonial-quote {
    font-style: italic;
    margin-bottom: 1rem;
  }
  
  .testimonial-name {
    font-size: 1.2rem;
    font-weight: bold;
  }
  
  .testimonial-role {
    font-size: 0.9rem;
    color: gray;
  }
  </style>
  