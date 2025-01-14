<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Book Details</h2>
      <div v-if="book" class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <!-- Card for Book Details -->
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="row g-0">
              <!-- Book Image -->
              <div class="col-md-4">
                <img
                  :src="book.image"
                  alt="Book Cover"
                  class="img-fluid rounded-start"
                  style="object-fit: cover; height: 300px; width: 100%"
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-primary">{{ book.judul }}</h5>
                  <p class="card-text">
                    <strong>Author:</strong> {{ book.penulis }} <br />
                    <strong>Publisher:</strong> {{ book.penerbit }} <br />
                    <strong>Category:</strong> {{ book.kategori.data.nama_kategori }}<br />
                    <strong>Stock:</strong> {{ book.stok }}
                  </p>
                  <p class="card-text">
                    <small class="text-muted">Updated on: {{ book.updated_at }}</small>
                  </p>
                </div>
                <div class="card-footer text-center">
                  <button
                    class="btn btn-primary btn-lg"
                    @click="borrowBook(book.id_buku)"
                    :disabled="book.stok === 0"
                  >
                    Borrow Book
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Loading Placeholder -->
      <div v-else class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "ViewBookUser",
    data() {
      return {
        book: null, // The book data fetched from the API
      };
    },
    mounted() {
      this.fetchBookDetails();
    },
    methods: {
      async fetchBookDetails() {
        try {
          const bookId = this.$route.params.id; // Get the book ID from the route params
          const response = await api.get(`/book/${bookId}`);
          
          // Ensure the response contains the expected data structure
          if (response.data && response.data.data) {
            this.book = response.data.data; // Populate the book data
          } else {
            console.error('Unexpected response structure:', response);
            alert('Failed to load book details.');
          }
        } catch (error) {
          console.error('Error fetching book details:', error);
          alert('Failed to load book details');
        }
      },
      borrowBook(bookId) {
        alert(`Borrowing Book ID: ${bookId}`);
      },
    },
  };
  </script>
  
  <style scoped>
  .card {
    border-radius: 16px;
    overflow: hidden;
  }
  
  .card-body {
    padding: 20px;
  }
  
  .card-footer {
    background-color: #f8f9fa;
  }
  
  .btn-primary:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
  }
  </style>
  