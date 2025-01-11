<template>
    <div class="book-list-container">
      <div class="container">
        <h2 class="section-title text-center mb-4">Discover Your Next Favorite Book</h2>
  
        <!-- Search and Filter -->
        <div class="row mb-4 justify-content-center align-items-center text-center">
          <SearchBar
            :searchQuery="searchQuery"
            :suggestions="suggestions"
            :showSuggestions="showSuggestions"
            @update:searchQuery="updateSearchQuery"
            @search-input="onSearchInput"
            @clear-search="clearSearch"
            @select-suggestion="selectSuggestion"
          />
          <CategoryFilter
            :categories="categories"
            :selectedCategory="selectedCategory"
            @filter-category="filterByCategory"
          />
        </div>
  
        <!-- Book List -->
        <div class="row">
          <BookCard
            v-for="book in filteredBooks"
            :key="book.id"
            :book="book"
          />
        </div>
  
        <!-- No Books Found -->
        <div v-if="filteredBooks.length === 0" class="text-center mt-4">
          <p class="text-muted">
            No books found matching your search or filter criteria.
          </p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import SearchBar from "../components/book-list-section/SearchBar.vue";
  import CategoryFilter from "../components/book-list-section/CategoryFilter.vue";
  import BookCard from "../components/book-list-section/BookCard.vue";
  
  export default {
    name: "BookList",
    components: {
      SearchBar,
      CategoryFilter,
      BookCard
    },
    data() {
      return {
        searchQuery: "",
        suggestions: [],
        showSuggestions: false,
        selectedCategory: "",
        books: [
          {
            id: 1,
            title: "The Great Gatsby",
            description: "A novel about the American dream, set in the 1920s.",
            coverImage: "src/assets/featured-book/hujan.jpg",
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
        ],
        categories: [
          "Fiction",
          "Classic",
          "Dystopian",
          "Romance",
          "Science Fiction",
          "Fantasy",
        ],
      };
    },
    computed: {
      filteredBooks() {
        return this.books.filter((book) => {
          const matchesSearch =
            book.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            book.description.toLowerCase().includes(this.searchQuery.toLowerCase());
          const matchesCategory = this.selectedCategory
            ? this.selectedCategory === "all" || book.category === this.selectedCategory
            : true;
          return matchesSearch && matchesCategory;
        });
      },
    },
    methods: {
      updateSearchQuery(query) {
        this.searchQuery = query;
      },
      onSearchInput(query) {
        if (query.length > 2) {
          this.suggestions = this.books
            .filter((book) => book.title.toLowerCase().includes(query.toLowerCase()))
            .map((book) => book.title);
        } else {
          this.suggestions = [];
        }
      },
      clearSearch() {
        this.searchQuery = "";
        this.suggestions = [];
        this.showSuggestions = false;
      },
      selectSuggestion(suggestion) {
        this.searchQuery = suggestion;
        this.suggestions = [];
        this.showSuggestions = false;
      },
      filterByCategory(category) {
        this.selectedCategory = category;
      },
    },
  };
  </script>
  
  <style scoped>
  .book-list-container {
    position: relative;
    background: url('src/assets/book-list_background.jpg') no-repeat center center fixed;
    background-size: cover; /* Agar gambar menutupi seluruh area */
    padding: 4rem 0;
    font-family: "Arial", sans-serif;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    color: #fff; /* Warna teks menjadi putih untuk kontras */
  }
  
  .book-list-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    backdrop-filter: blur(10px); /* Efek blur pada gambar */
    z-index: 1;
  }
  
  .container {
    position: relative;
    z-index: 2; /* Pastikan konten tetap di atas overlay */
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #ffffff; /* Warna teks lebih cerah untuk kontras */
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  .row {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }
  
  .text-center {
    text-align: center;
  }
  
  .book-list-container .row {
    gap: 2rem;
  }
  
  /* Search bar styles */
  .search-bar-container {
    margin-bottom: 2rem;
  }
  
  /* Category filter styling */
  .category-filter-container {
    margin-bottom: 2rem;
  }
  
  /* Book Card Styles */
  .book-card {
    background-color: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }
  
  .book-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }
  
  .book-card img {
    height: 250px;
    object-fit: cover;
    border-bottom: 2px solid #ddd;
  }
  
  .book-card .card-body {
    padding: 1.5rem;
  }
  
  .book-card .card-title {
    font-size: 1.25rem;
    font-weight: bold;
  }
  
  .book-card .card-text {
    font-size: 1rem;
    color: #6c757d;
  }
  
  .book-card .badge {
    background-color: #007bff;
    color: white;
  }
  
  .text-muted {
    font-style: italic;
    color: #6c757d;
  }
  </style>
  