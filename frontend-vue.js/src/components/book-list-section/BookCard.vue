<template>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 fade-in">
      <div class="card shadow-sm book-card">
        <img
          :src="book.coverImage"
          :alt="book.title"
          class="card-img-top book-cover"
        />
        <div class="card-body">
          <h5 class="card-title">{{ book.title }}</h5>
          <p class="card-text" style="font-size: 0.9rem;">{{ book.description }}</p>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <button
              class="btn btn-success btn-sm shadow-sm"
              @click="borrowBook(book.id)"
            >
              <i class="fas fa-book-reader me-1"></i> Borrow
            </button>
            <span class="badge bg-secondary">{{ book.category }}</span>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      book: {
        type: Object,
        required: true
      }
    },
    methods: {
      borrowBook(bookId) {
        alert(`You have borrowed the book with ID: ${bookId}`);
      }
    }
  };
  </script>
  
  <style scoped>
  .book-card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    height: 100%; /* Ensures card height is flexible */
  }
  
  .book-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
  }
  
  .book-cover {
    height: 300px; /* New height for image */
    width: auto; /* Make width auto to maintain aspect ratio */
    object-fit: cover;
    border-bottom: 1px solid #ddd;
  }
  
  .card-body {
    padding: 1rem;
  }
  
  .card-title {
    font-size: 1.1rem; /* Slightly larger title */
    font-weight: 600;
  }
  
  .card-text {
    font-size: 0.9rem; /* More readable description size */
    color: #6c757d;
  }
  
  .badge {
    font-size: 0.8rem; /* Slightly smaller badge */
  }
  
  .btn {
    font-size: 0.875rem; /* Slightly smaller button text */
    padding: 0.5rem 1rem;
  }
  
  .d-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  /* Fade-in Animation */
  .fade-in {
    animation: fadeIn 1.5s ease-in-out;
  }
  
  /* Keyframes for fade-in effect */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px); /* Start slightly below */
    }
    to {
      opacity: 1;
      transform: translateY(0); /* Final position */
    }
  }
  </style>
  