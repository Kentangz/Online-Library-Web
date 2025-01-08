<template>
    <div class="faq-page" v-if="isPageLoaded">
      <div class="container">
        <h1 class="text-center mb-5">Frequently Asked Questions</h1>
        <div v-for="(item, index) in faqs" :key="index" class="faq-item" @click="toggleAnswer(index)">
          <div class="faq-question slide-in">
            <h4>{{ item.question }}</h4>
            <span v-if="isOpen(index)">&#9660;</span>
            <span v-else>&#9654;</span>
          </div>
          <div v-if="isOpen(index)" class="faq-answer slide-in">
            <p>{{ item.answer }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "FaQ",
    data() {
      return {
        faqs: [
          { question: "What is this platform?", answer: "This platform is an online library offering a wide range of resources." },
          { question: "How do I register?", answer: "Click 'Sign Up' on the homepage and fill in your details." },
          { question: "What resources are available?", answer: "Books, articles, research papers, and educational materials." },
          { question: "Is there a mobile app?", answer: "Currently, it's only available on web browsers." },
          { question: "How do I contact support?", answer: "Email support@online-library.com or visit the 'Contact Us' page." }
        ],
        openIndex: null,
        isPageLoaded: false
      };
    },
    mounted() {
      setTimeout(() => { this.isPageLoaded = true; }, 100);
    },
    methods: {
      toggleAnswer(index) {
        this.openIndex = this.openIndex === index ? null : index;
      },
      isOpen(index) {
        return this.openIndex === index;
      }
    }
  };
  </script>
  
  <style scoped>
  .faq-page {
    padding: 3rem 1.5rem;
    background-color: #f8f9fa;
    min-height: 100vh;
    opacity: 0;
    animation: fadeIn 1s ease-out forwards;
  }
  
  h1 {
    font-family: 'Roboto', sans-serif;
    color: #333;
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 3rem;
  }
  
  .faq-item {
    margin-bottom: 1.5rem;
  }
  
  .faq-question {
    background-color: #007bff;
    color: white;
    padding: 1.2rem;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .faq-question:hover {
    background-color: #0056b3;
  }
  
  .faq-answer {
    background-color: #f1f1f1;
    padding: 1rem;
    margin-top: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: slideIn 0.5s ease-out;
  }
  
  .faq-question h4 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
  }
  
  .faq-answer p {
    margin: 0;
    font-size: 1rem;
    color: #555;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes slideIn {
    from { transform: translateX(-30px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  
  @media (max-width: 768px) {
    h1 { font-size: 2rem; }
    .faq-question h4 { font-size: 1rem; }
    .faq-answer p { font-size: 0.9rem; }
  }
  </style>
  