<template>
    <div class="about-library container py-5">
      <h2 class="section-title text-center mb-4">About the Library</h2>
      <p class="section-subtitle text-center mb-5">
        Our mission is to empower minds through knowledge and provide access to valuable resources for learning and growth.
      </p>
      <div class="row">
        <div v-for="(item, index) in aboutItems" :key="index" class="col-md-4 text-center mb-4">
          <div class="about-item">
            <i :class="item.icon" class="icon"></i>
            <h4 class="item-title">{{ item.title }}</h4>
            <p class="item-description">{{ item.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "AboutLibrary",
    data() {
      return {
        aboutItems: [
          { icon: "fas fa-book-open", title: "Extensive Resources", description: "Access a wide variety of educational materials including books, articles, and research papers." },
          { icon: "fas fa-globe", title: "Global Access", description: "Our library can be accessed from anywhere, giving you the flexibility to learn anytime." },
          { icon: "fas fa-user-graduate", title: "For Learners", description: "Designed to support students and learners of all ages in their academic journey." }
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  .about-library {
    background-color: #f8f9fa;
  }
  
  .section-title {
    font-family: "Roboto", sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
  }
  
  .section-subtitle {
    font-size: 1.2rem;
    font-weight: 300;
  }
  
  .about-item {
    padding: 2rem;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: transform 0.3s ease-in-out;
  }
  
  .about-item:hover {
    transform: translateY(-10px);
  }
  
  .icon {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 1rem;
  }
  
  .item-title {
    font-size: 1.4rem;
    font-weight: 600;
  }
  
  .item-description {
    font-size: 1rem;
    color: #555;
  }
  </style>
  