<template>
    <div class="col-md-6 col-12 mb-3 fade-in">
      <div class="input-group search-container mx-auto">
        <input
          v-bind:value="searchQuery" 
          type="text"
          class="form-control search-input shadow-sm"
          placeholder="🔍 Search books by title or author"
          @input="onSearchInput"
          @focus="showSuggestions = true"
        />
        <button
          v-if="searchQuery"
          class="btn btn-outline-danger"
          @click="clearSearch"
        >
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div
        v-if="suggestions.length && showSuggestions"
        class="search-suggestions shadow"
      >
        <ul>
          <li
            v-for="(suggestion, index) in suggestions"
            :key="index"
            @click="selectSuggestion(suggestion)"
          >
            {{ suggestion }}
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      searchQuery: {
        type: String,
        required: true
      },
      suggestions: {
        type: Array,
        required: true
      },
      showSuggestions: {
        type: Boolean,
        required: true
      },
    },
    methods: {
      onSearchInput(event) {
        const value = event.target.value;
        this.$emit("update:searchQuery", value);  // Emit perubahan nilai
        this.$emit("search-input", value);
      },
      clearSearch() {
        this.$emit("update:searchQuery", "");  // Emit nilai kosong
        this.$emit("clear-search");
      },
      selectSuggestion(suggestion) {
        this.$emit("update:searchQuery", suggestion);  // Emit suggestion yang dipilih
        this.$emit("select-suggestion", suggestion);
      }
    }
  };
  </script>
  
  <style scoped>
  .search-container {
    position: relative;
  }
  
  .search-input {
    padding: 0.8rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    border: 2px solid #007bff;
  }
  
  .search-input:focus {
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
  }
  
  .search-suggestions {
    position: absolute;
    background-color: white;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 10;
  }
  
  .search-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .search-suggestions li {
    padding: 0.8rem;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .search-suggestions li:hover {
    background-color: #f1f1f1;
  }
  
  /* Fade-in Animation */
  .fade-in {
    animation: fadeInLeft 1.5s ease-in-out;
  }
  
  /* Keyframes for fade-in from left */
  @keyframes fadeInLeft {
    from {
      opacity: 0;
      transform: translateX(-10%);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }
  </style>
  