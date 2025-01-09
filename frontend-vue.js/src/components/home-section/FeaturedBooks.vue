<template>
    <div class="featured-books-section">
      <div class="container text-center">
        <h2 class="section-title">Featured Books</h2>
        <div class="row">
          <!-- Example of Featured Books Grid -->
          <div class="col-md-4" v-for="book in featuredBooks" :key="book.id">
            <div class="book-card">
              <img :src="book.image" alt="book.title" class="book-image" />
              <h5 class="book-title">{{ book.title }}</h5>
              <p class="book-author">{{ book.author }}</p>
              <p class="book-genre">{{ book.genre }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "FeaturedBooks",
    data() {
      return {
        featuredBooks: [
          { id: 1, title: "The Great Gatsby", author: "F. Scott Fitzgerald", genre: "Classic", image: "/path/to/great-gatsby.jpg" },
          { id: 2, title: "1984", author: "George Orwell", genre: "Dystopian", image: "/path/to/1984.jpg" },
          { id: 3, title: "Moby Dick", author: "Herman Melville", genre: "Adventure", image: "/path/to/moby-dick.jpg" },
          // Add more books as needed
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .featured-books-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 3rem;
  }
  
  .book-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    transition: transform 0.3s ease;
  }
  
  .book-card:hover {
    transform: translateY(-10px);
  }
  
  .book-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
  }
  
  .book-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1rem;
  }
  
  .book-author {
    font-size: 1rem;
    font-weight: 300;
  }
  
  .book-genre {
    font-size: 0.9rem;
    color: #007bff;
  }
  
  /* Media Queries */
  @media (max-width: 768px) {
    .section-title {
      font-size: 2rem;
    }
  
    .book-card {
      padding: 0.8rem;
    }
  }
  </style>
  