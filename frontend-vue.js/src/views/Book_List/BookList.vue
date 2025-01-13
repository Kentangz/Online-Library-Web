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
      </div>

      <!-- Book List -->
      <div class="row">
        <BookCard
          v-for="book in paginatedBooks"
          :key="book.id_buku"
          :book="book"
        />
      </div>

      <!-- No Books Found -->
      <div v-if="filteredBooks.length === 0" class="text-center mt-4">
        <p class="text-muted">No books found matching your search criteria.</p>
      </div>

      <!-- Pagination -->
      <div v-if="filteredBooks.length > 8" class="text-center mt-4">
        <ul class="pagination">
          <li class="page-item" :class="{ disabled: currentPage === 1 }" @click="changePage(currentPage - 1)">
            <a class="page-link" href="#">Previous</a>
          </li>
          <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: page === currentPage }" @click="changePage(page)">
            <a class="page-link" href="#">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }" @click="changePage(currentPage + 1)">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Api from "../../api";
import SearchBar from "../../components/book-list-section/SearchBar.vue";
import BookCard from "../../components/book-list-section/BookCard.vue";

export default {
  name: "BookList",
  components: {
    SearchBar,
    BookCard,
  },
  data() {
    return {
      searchQuery: "",
      suggestions: [],
      showSuggestions: false,
      books: [],
      loading: true,
      error: null,
      currentPage: 1,
      itemsPerPage: 6,
    };
  },
  computed: {
    filteredBooks() {
      // Filter hanya berdasarkan query pencarian
      return this.books.filter((book) => {
        const matchesSearch =
          book.judul.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          book.penulis.toLowerCase().includes(this.searchQuery.toLowerCase());
        return matchesSearch;
      });
    },
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredBooks.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.filteredBooks.length / this.itemsPerPage);
    },
  },
  methods: {
    async fetchBooks() {
      try {
        const response = await Api.get("/book");
        if (response.data && Array.isArray(response.data)) {
          this.books = response.data.map((item) => item.data);
        } else {
          throw new Error("Data buku tidak ditemukan");
        }
      } catch (err) {
        console.error("Error fetching books:", err);
        this.error = "Gagal memuat buku. Coba lagi nanti.";
      } finally {
        this.loading = false;
      }
    },
    updateSearchQuery(query) {
      this.searchQuery = query;
    },
    clearSearch() {
      this.searchQuery = "";
      this.suggestions = [];
      this.showSuggestions = false;
    },
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
  },
  async mounted() {
    console.log("Fetching books...");
    await this.fetchBooks();
    console.log("Initial fetch complete");
  },
};
</script>

<style scoped>
.book-list-container {
  position: relative;
  background: url('src/assets/book-list_background.jpg') no-repeat center center fixed;
  background-size: cover;
  padding: 4rem 0;
  font-family: "Arial", sans-serif;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  color: #fff;
}

.book-list-container::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(10px);
  z-index: 1;
}

.container {
  position: relative;
  z-index: 2;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #ffffff;
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

.search-bar-container {
  margin-bottom: 2rem;
}

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

.pagination {
  display: inline-flex;
  justify-content: center;
  padding: 1rem;
}

.page-item {
  margin: 0 5px;
}

.page-link {
  background-color: #fff;
  color: #007bff;
  border: 1px solid #ddd;
  padding: 10px 15px;
  font-size: 1rem;
  border-radius: 5px;
  transition: background-color 0.3s, color 0.3s;
}

.page-link:hover {
  background-color: #007bff;
  color: #fff;
}

.page-item.disabled .page-link {
  background-color: #f8f9fa;
  color: #6c757d;
  pointer-events: none;
}

.page-item.active .page-link {
  background-color: #007bff;
  color: white;
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }

  .pagination {
    flex-direction: column;
  }
}
</style>
