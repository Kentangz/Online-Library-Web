<template>
    <section class="benefits">
      <div class="container">
        <h2 class="section-title">Why Choose Online Library?</h2>
        <div class="benefits-list">
          <div v-for="benefit in benefits" :key="benefit.id" class="benefit-card">
            <img :src="benefit.icon" :alt="benefit.title" class="benefit-icon" />
            <h3 class="benefit-title">{{ benefit.title }}</h3>
            <p class="benefit-description">{{ benefit.description }}</p>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
export default {
  name: "Benefits",
  data() {
    return {
      benefits: [
        { id: 1, title: "Easy Book Search", description: "Find books easily without visiting the library.", icon: "src/assets/testimoni-profile/cat.png" },
        { id: 2, title: "Explore All Books", description: "Browse the entire book collection anytime, anywhere.", icon: "src/assets/testimoni-profile/cat.png" },
        { id: 3, title: "Real-Time Updates", description: "Get updated book and library info in real-time.", icon: "src/assets/testimoni-profile/cat.png" },
        { id: 4, title: "Track Your Borrowing", description: "View your current borrowing status and history.", icon: "src/assets/testimoni-profile/cat.png" },
      ],
    };
  },
};

  </script>
  
  <style scoped>
  .benefits {
    padding: 3rem 0;
    text-align: center;
  }
  .section-title {
    font-size: 2rem;
    margin-bottom: 2rem;
  }
  .benefits-list {
    display: flex;
    justify-content: center;
    gap: 2rem;
  }
  .benefit-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 200px;
  }
  .benefit-icon {
    width: 60px;
    height: 60px;
    margin-bottom: 1rem;
  }
  .benefit-title {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
  }
  .benefit-description {
    font-size: 0.9rem;
    color: #555;
  }
  </style>
  