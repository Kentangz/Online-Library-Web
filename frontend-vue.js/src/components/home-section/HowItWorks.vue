<template>
    <div class="how-it-works-section">
      <h2 class="section-title">How It Works</h2>
      <div class="steps-container">
        <div class="step">
          <div class="step-icon">🔍</div>
          <h3 class="step-title">Search Books or Categories</h3>
          <p class="step-description">
            Use the search bar to find books or categories that match your interests.
          </p>
        </div>
        <div class="step">
          <div class="step-icon">🛒</div>
          <h3 class="step-title">Borrow Your Favorites</h3>
          <p class="step-description">
            Add books to your borrow list. Login or register to complete the process.
          </p>
        </div>
        <div class="step">
          <div class="step-icon">👤</div>
          <h3 class="step-title">Access Your Profile</h3>
          <p class="step-description">
            Track your borrowed books, due dates, and manage your profile.
          </p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "HowItWorks",
  };
  </script>
  
  <style scoped>
  .how-it-works-section {
    padding: 4rem 2rem;
    background-color: #f9f9f9;
    text-align: center;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: #333;
  }
  
  .steps-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
  }
  
  .step {
    background: white;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 300px;
    text-align: center;
    transition: transform 0.3s ease;
  }
  
  .step:hover {
    transform: translateY(-10px);
  }
  
  .step-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #007bff;
  }
  
  .step-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
  }
  
  .step-description {
    font-size: 1rem;
    color: #666;
  }
  </style>
  