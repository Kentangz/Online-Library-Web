<template>
    <section class="new-arrivals">
      <div class="container">
        <h2 class="section-title">New Arrivals</h2>
        <div class="book-list">
          <div v-for="book in books" :key="book.id" class="book-card">
            <img :src="book.cover" :alt="book.title" class="book-cover" />
            <h3 class="book-title">{{ book.title }}</h3>
            <p class="book-author">by {{ book.author }}</p>
          </div>
        </div>
        <button class="btn primary" @click="goToBooks">View All New Books</button>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "NewArrivals",
    data() {
      return {
        books: [
          { id: 1, title: "Book One", author: "Author A", cover: "src/assets/testimoni-profile/cat.png" },
          { id: 2, title: "Book Two", author: "Author B", cover: "src/assets/testimoni-profile/cat.png" },
          { id: 3, title: "Book Three", author: "Author C", cover: "src/assets/testimoni-profile/cat.png" },
        ],
      };
    },
    methods: {
      goToBooks() {
        this.$router.push("/book-list").then(() => {
          window.scrollTo(0, 0);
        });
      },
    },
  };
  </script>
  
  <style scoped>
  .new-arrivals {
    padding: 3rem 0;
    background-color: #f9f9f9;
    text-align: center;
  }
  .section-title {
    font-size: 2rem;
    margin-bottom: 2rem;
  }
  .book-list {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
  }
  .book-card {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 150px;
  }
  .book-cover {
    width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 1rem;
  }
  .book-title {
    font-size: 1rem;
    margin-bottom: 0.5rem;
  }
  .book-author {
    color: #555;
    font-size: 0.9rem;
  }
  .btn.primary {
    padding: 0.8rem 2rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
  }
  .btn.primary:hover {
    background-color: #0056b3;
  }
  </style>
  