<template>
    <div class="container py-4">
      <h2 class="text-center mb-4">Book List</h2>
      
      <!-- Search and Filter -->
      <div class="row mb-4">
        <div class="col-md-6">
          <input
            type="text"
            class="form-control"
            placeholder="Search by title, author, or publisher"
            v-model="searchQuery"
            @input="filterBooks"
          />
        </div>
        <div class="col-md-6">
          <select
            class="form-control"
            v-model="selectedCategory"
            @change="filterBooks"
          >
            <option value="">All Categories</option>
            <option
              v-for="category in categories"
              :key="category.id_kategori"
              :value="category.nama_kategori"
            >
              {{ category.nama_kategori }}
            </option>
          </select>
        </div>
      </div>
  
      <!-- Book List -->
      <div class="row">
        <div
          v-for="(book, index) in paginatedBooks"
          :key="index"
          class="col-md-3 col-sm-6 mb-4"
        >
          <div class="card h-100 shadow-sm">
            <img
              :src="book.image"
              alt="Book Cover"
              class="card-img-top book-image"
            />
            <div class="card-body">
              <h5 class="card-title">{{ book.judul }}</h5>
              <p class="card-text">
                <strong>Author:</strong> {{ book.penulis }} <br />
                <strong>Publisher:</strong> {{ book.penerbit }} <br />
                <strong>Category:</strong> {{ book.kategori.data.nama_kategori }}<br />
                <strong>Stock:</strong> {{ book.stok }}
              </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <button
                class="btn btn-info"
                :class="{'btn-clicked': isViewClicked}"
                @click="viewBook(book.id_buku)"
              >
                View Book
              </button>
              <button
                class="btn btn-primary"
                :class="{'btn-clicked': isBorrowClicked}"
                :disabled="book.stok === 0"
                @click="borrowBook(book.id_buku)"
              >
                Borrow
              </button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Pagination Controls -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" href="#" @click="changePage(currentPage - 1)">Previous</a>
          </li>
          <li
            class="page-item"
            v-for="page in totalPages"
            :key="page"
            :class="{ active: currentPage === page }"
          >
            <a class="page-link" href="#" @click="changePage(page)">{{ page }}</a>
          </li>
          <li
            class="page-item"
            :class="{ disabled: currentPage === totalPages }"
          >
            <a class="page-link" href="#" @click="changePage(currentPage + 1)">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "BookListUser",
    data() {
      return {
        books: [], // All books fetched from the API
        filteredBooks: [], // Filtered books based on search and category
        categories: [], // List of available categories
        searchQuery: "", // Search query input
        selectedCategory: "", // Selected category for filtering
        currentPage: 1, // Current page for pagination
        booksPerPage: 8, // Books per page
        isViewClicked: false, // Track the state of the 'View Book' button click
        isBorrowClicked: false, // Track the state of the 'Borrow' button click
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.filteredBooks.length / this.booksPerPage);
      },
      paginatedBooks() {
        const startIndex = (this.currentPage - 1) * this.booksPerPage;
        const endIndex = startIndex + this.booksPerPage;
        return this.filteredBooks.slice(startIndex, endIndex);
      },
    },
    mounted() {
      this.fetchBooks();
      this.fetchCategories();
    },
    methods: {
      async fetchBooks() {
        try {
          const response = await api.get("/book");
          this.books = response.data.map((item) => item.data);
          this.filteredBooks = this.books; // Initialize with all books
        } catch (error) {
          console.error("Error fetching books:", error);
          alert("Failed to load books");
        }
      },
      async fetchCategories() {
        try {
          const response = await api.get("/category");
          this.categories = response.data.data;
        } catch (error) {
          console.error("Error fetching categories:", error);
          alert("Failed to load categories");
        }
      },
      filterBooks() {
        const searchQueryLower = this.searchQuery.toLowerCase();
        this.filteredBooks = this.books.filter((book) => {
          const matchesSearch =
            book.judul.toLowerCase().includes(searchQueryLower) ||
            book.penulis.toLowerCase().includes(searchQueryLower) ||
            book.penerbit.toLowerCase().includes(searchQueryLower);
  
          const matchesCategory =
            this.selectedCategory === "" ||
            book.kategori.data.nama_kategori === this.selectedCategory;
  
          return matchesSearch && matchesCategory;
        });
        this.currentPage = 1; // Reset to first page after filtering
      },
      changePage(page) {
        if (page < 1 || page > this.totalPages) return;
        this.currentPage = page;
      },
      viewBook(bookId) {
        this.isViewClicked = true;
        this.$router.push({ name: 'ViewBookUser', params: { id: bookId } });
        setTimeout(() => {
          this.isViewClicked = false;
        }, 300);
      },
      borrowBook(bookId) {
        this.isBorrowClicked = true;
        alert(`Borrow Book ID: ${bookId}`);
        setTimeout(() => {
          this.isBorrowClicked = false;
        }, 300);
      },
    },
  };
  </script>
  
  <style scoped>
  .book-image {
    height: 300px;
    object-fit: cover;
  }
  
  .card {
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
  }
  
  .card:hover {
    transform: scale(1.03);
  }
  
  .card-footer {
    background-color: #f8f9fa;
    border-top: none;
  }
  
  .btn {
    width: 45%;
  }
  
  .btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
  }
  
  .btn-primary:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
  }
  
  .btn-clicked {
    animation: pulse 0.3s ease-in-out;
  }
  
  @keyframes pulse {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(0.95);
    }
    100% {
      transform: scale(1);
    }
  }
  </style>
  