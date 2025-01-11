<template>
    <div class="col-md-4 col-12 fade-in-right">
      <div class="category-chips-container mx-auto">
        <!-- Dropdown for categories -->
        <div class="dropdown">
          <button
            class="btn btn-light dropdown-toggle"
            type="button"
            id="categoryDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <span v-if="selectedCategory" class="fw-bold">{{ selectedCategory }}</span>
            <span v-else class="text-muted">All Categories</span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
            <!-- All Categories option first -->
            <li @click="filterByCategory('')" class="dropdown-item">
              <strong>All Categories</strong>
            </li>
            <li><hr class="dropdown-divider" /></li>
            
            <!-- Search input for categories -->
            <li>
              <input
                type="text"
                class="form-control search-input"
                v-model="searchQuery"
                placeholder="Search categories"
                @input="filterCategories"
              />
            </li>
            <li><hr class="dropdown-divider" /></li>
  
            <!-- Loop over categories and display them in the dropdown -->
            <template v-if="filteredCategories.length > 0">
              <li
                v-for="category in filteredCategories"
                :key="category"
                @click="filterByCategory(category)"
                class="dropdown-item"
              >
                {{ category }}
              </li>
            </template>
  
            <!-- Display message if no category found -->
            <template v-else>
              <li class="dropdown-item text-muted">
                Category not found
              </li>
            </template>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      categories: {
        type: Array,
        required: true
      },
      selectedCategory: {
        type: String,
        required: false
      }
    },
    data() {
      return {
        searchQuery: '', // for search input
        filteredCategories: this.categories.sort() // Sort categories alphabetically
      };
    },
    methods: {
      filterByCategory(category) {
        this.$emit("filter-category", category);
        this.selectedCategory = category;
      },
      filterCategories() {
        // Filter categories based on search query and sort them
        this.filteredCategories = this.categories
          .filter(category =>
            category.toLowerCase().includes(this.searchQuery.toLowerCase())
          )
          .sort();
      }
    }
  };
  </script>
  
  <style scoped>
  .category-chips-container {
    text-align: center;
    padding: 1rem;
  }
  
  .dropdown-toggle {
    font-size: 1rem;
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    background-color: #f8f9fa;
    border: none;
    font-weight: 500;
    transition: all 0.3s ease;
  }
  
  .dropdown-toggle:hover {
    background-color: #e9ecef;
    cursor: pointer;
  }
  
  .dropdown-menu {
    max-height: 250px;
    overflow-y: auto;
    border: none;
    border-radius: 8px;
    box-shadow: none;
  }
  
  .dropdown-item {
    cursor: pointer;
    padding: 12px 16px;
    font-weight: 400;
    transition: background-color 0.3s;
  }
  
  .dropdown-item:hover {
    background-color: #007bff;
    color: white;
  }
  
  .dropdown-item:active {
    background-color: #0056b3;
  }
  
  .dropdown-divider {
    border-color: #f1f1f1;
  }
  
  .btn-light {
    background-color: #f8f9fa;
    color: #007bff;
  }
  
  .search-input {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
    margin: 0;
    width: 100%;
  }
  
  .search-input::placeholder {
    color: #bbb;
  }
  
  .text-muted {
    text-align: center;
    font-style: italic;
  }
  
  /* Fade-in Animation from Right to Left */
  .fade-in-right {
    animation: fadeInRight 1.5s ease-in-out;
  }
  
  /* Keyframes for fade-in from right */
  @keyframes fadeInRight {
    from {
      opacity: 0;
      transform: translateX(10%);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  </style>
  