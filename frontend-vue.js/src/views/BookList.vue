<template>
    <div class="book-list-container">
      <div class="container">
        <!-- Title and Search Bar -->
        <h2 class="section-title text-center mb-4">Discover Your Next Favorite Book</h2>
  
        <!-- Search and Category Filter -->
        <div class="row mb-4 justify-content-center align-items-center">
          <!-- Search Bar -->
          <div class="col-md-6 col-12 mb-3">
            <div class="input-group search-container">
              <input
                v-model="searchQuery"
                type="text"
                class="form-control search-input"
                placeholder="Search books by title or author"
                @input="onSearchInput"
              />
              <button
                v-if="searchQuery"
                class="btn btn-outline-secondary"
                @click="clearSearch"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- Search Suggestions Dropdown -->
            <div v-if="suggestions.length" class="search-suggestions">
              <ul>
                <li v-for="(suggestion, index) in suggestions" :key="index" @click="selectSuggestion(suggestion)">
                  {{ suggestion }}
                </li>
              </ul>
            </div>
          </div>
  
          <!-- Category Dropdown Filter -->
          <div class="col-md-4 col-12">
            <div class="dropdown category-dropdown">
              <button class="btn btn-primary dropdown-toggle w-100" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ selectedCategory ? selectedCategory : 'Select Category' }}
              </button>
              <ul class="dropdown-menu w-100" aria-labelledby="categoryDropdown">
                <li v-for="category in categories" :key="category">
                  <a class="dropdown-item" href="#" @click.prevent="filterByCategory(category)">
                    {{ category }}
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#" @click.prevent="filterByCategory('')">
                    All Categories
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Book List -->
        <div class="row">
          <div v-for="book in filteredBooks" :key="book.id" class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm book-card">
              <img :src="book.coverImage" :alt="book.title" class="card-img-top book-cover" />
              <div class="card-body">
                <h5 class="card-title">{{ book.title }}</h5>
                <p class="card-text">{{ book.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <button class="btn btn-success btn-sm" @click="borrowBook(book.id)">
                    Borrow
                  </button>
                  <span class="badge bg-secondary">{{ book.category }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- No Books Found Message -->
        <div v-if="filteredBooks.length === 0" class="text-center mt-4">
          <p>No books found matching your search or filter criteria.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "BookList",
    data() {
      return {
        searchQuery: "",
        suggestions: [],
        selectedCategory: "",
        books: [
          {
            id: 1,
            title: "The Great Gatsby",
            description: "A novel about the American dream, set in the 1920s.",
            coverImage: "https://example.com/gatsby.jpg",
            category: "Fiction",
          },
          {
            id: 2,
            title: "To Kill a Mockingbird",
            description: "A gripping story of racial injustice in the Deep South.",
            coverImage: "https://example.com/mockingbird.jpg",
            category: "Classic",
          },
          {
            id: 3,
            title: "1984",
            description: "A dystopian novel about a totalitarian regime.",
            coverImage: "https://example.com/1984.jpg",
            category: "Dystopian",
          },
          {
            id: 4,
            title: "Pride and Prejudice",
            description: "A story of love and societal expectations in 19th-century England.",
            coverImage: "https://example.com/pride.jpg",
            category: "Romance",
          },
          // Additional books...
        ],
        categories: ["Fiction", "Classic", "Dystopian", "Romance"],
      };
    },
    computed: {
      filteredBooks() {
        return this.books
          .filter(book => {
            const matchesSearch = book.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || book.description.toLowerCase().includes(this.searchQuery.toLowerCase());
            const matchesCategory = this.selectedCategory ? book.category === this.selectedCategory : true;
            return matchesSearch && matchesCategory;
          });
      },
    },
    methods: {
      borrowBook(bookId) {
        alert(`You have borrowed the book with ID: ${bookId}`);
      },
      filterByCategory(category) {
        this.selectedCategory = category;
      },
      clearSearch() {
        this.searchQuery = "";
        this.suggestions = [];
      },
      onSearchInput() {
        if (this.searchQuery.length > 2) {
          this.suggestions = this.books
            .filter(book => book.title.toLowerCase().includes(this.searchQuery.toLowerCase()))
            .map(book => book.title);
        } else {
          this.suggestions = [];
        }
      },
      selectSuggestion(suggestion) {
        this.searchQuery = suggestion;
        this.suggestions = [];
      },
    },
  };
  </script>
  
  <style scoped>
  .book-list-container {
    background-color: #f9f9f9;
    padding: 4rem 0;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
  }
  
  .search-container {
    position: relative;
  }
  
  .search-input {
    padding: 0.8rem 1rem;
    border-radius: 5px;
    font-size: 1rem;
    border: 2px solid #007bff;
  }
  
  .search-input:focus {
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  
  .search-suggestions {
    position: absolute;
    background-color: white;
    width: 100%;
    max-height: 150px;
    overflow-y: auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 1000;
  }
  
  .search-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .search-suggestions li {
    padding: 0.5rem;
    cursor: pointer;
  }
  
  .search-suggestions li:hover {
    background-color: #f1f1f1;
  }
  
  .category-dropdown {
    position: relative;
  }
  
  .dropdown-menu {
    width: 100%;
  }
  
  .book-card {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    border: none;
  }
  
  .book-card:hover {
    transform: translateY(-10px);
  }
  
  .book-cover {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
  }
  
  .card-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
  }
  
  .card-text {
    font-size: 1rem;
    color: #666;
    margin-bottom: 1rem;
  }
  
  .borrow-btn {
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s;
  }
  
  .borrow-btn:hover {
    background-color: #218838;
  }
  
  .badge {
    font-size: 0.85rem;
    padding: 0.4rem 0.6rem;
    background-color: #6c757d;
    color: white;
    border-radius: 10px;
  }
  
  .text-center {
    font-size: 1.2rem;
    color: #666;
    margin-top: 2rem;
  }
  
  .btn-outline-secondary {
    border-color: #007bff;
  }
  
  .dropdown-toggle {
    width: 100%;
    font-size: 1rem;
  }
  
  .dropdown-item {
    cursor: pointer;
  }
  
  .dropdown-item:hover {
    background-color: #007bff;
    color: white;
  }
  
  @media (max-width: 768px) {
    .search-container {
      margin-bottom: 1rem;
    }
  }
  </style>
  