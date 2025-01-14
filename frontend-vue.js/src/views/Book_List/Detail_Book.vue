<template>
  <div class="book-detail-container">
    <div class="book-detail-card">
      <div class="book-image-wrapper">
        <img
          :src="book.image || '/src/assets/cover_book_default.png'"
          :alt="book.judul"
          class="book-image"
        />
      </div>

      <div class="book-info">
        <h1 class="book-title">{{ book.judul }}</h1>
        <p class="book-author">{{ book.penulis }}</p>
        <p class="book-category">
          <span class="label">Category:</span> {{ book.kategori?.data?.nama_kategori || 'Uncategorized' }}
        </p>
        <p class="book-publisher">
          <span class="label">Publisher:</span> {{ book.penerbit }}
        </p>
        <p class="book-stock">
          <span class="label">Stock Available:</span> {{ book.stok }}
        </p>
        <p class="book-description">{{ book.deskripsi || 'No description available for this book.' }}</p>

        <div class="action-buttons">
          <button
            class="borrow-btn"
            :disabled="book.stok === 0"
            @click="borrowBook(book.id_buku)"
          >
            Borrow Book
          </button>
          <button
            class="back-btn"
            @click="goBackToBookList"
          >
            Back to Book List
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../../api';  // Mengimpor axios instance

export default {
  data() {
    return {
      book: {},  // Menyimpan data buku yang akan diambil
    };
  },
  methods: {
    borrowBook() {
      this.$router.push('/sign-in');
      // Lakukan proses peminjaman buku, misalnya update stok di backend
    },
    goBackToBookList() {
      this.$router.push('/book-list');  // Mengarahkan kembali ke halaman BookList
    },
    async fetchBookDetails(bookId) {
      try {
        const response = await api.get(`/book/${bookId}`);  // Mengambil data buku dengan ID
        this.book = response.data.data;  // Menyimpan data buku yang diterima dari API
      } catch (error) {
        console.error(error);
        alert('Failed to fetch book details');
      }
    },
  },
  created() {
    const bookId = this.$route.params.id;  // Mengambil ID buku dari URL
    this.fetchBookDetails(bookId);  // Mengambil data buku berdasarkan ID
  },
};
</script>

<style scoped>
.book-detail-container {
  padding: 30px;
  display: flex;
  justify-content: center;
}

.book-detail-card {
  display: flex;
  max-width: 1200px;
  width: 100%;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  padding: 20px;
  margin-top: 40px;
}

.book-image-wrapper {
  width: 40%;
  padding-right: 20px;
}

.book-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
  object-fit: cover;
}

.book-info {
  width: 60%;
}

.book-title {
  font-size: 2rem;
  font-weight: 600;
  color: #333;
}

.book-author {
  font-size: 1.2rem;
  color: #666;
  margin-top: 10px;
}

.book-category,
.book-publisher,
.book-stock {
  font-size: 1rem;
  color: #555;
  margin-top: 10px;
}

.book-description {
  font-size: 1rem;
  color: #777;
  margin-top: 15px;
}

.label {
  font-weight: 600;
  color: #333;
}

.action-buttons {
  margin-top: 20px;
  display: flex;
  gap: 15px;
}

.borrow-btn,
.back-btn {
  width: 48%;
  padding: 15px;
  font-size: 1rem;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s;
}

.borrow-btn {
  background-color: #28a745;
  color: #fff;
}

.borrow-btn:disabled {
  background-color: #d6e8d3;
  cursor: not-allowed;
}

.borrow-btn:hover:not(:disabled) {
  background-color: #218838;
}

.back-btn {
  background-color: #f1f1f1;
  color: #333;
  border: 1px solid #ccc;
}

.back-btn:hover {
  background-color: #e2e2e2;
}

@media (max-width: 768px) {
  .book-detail-card {
    flex-direction: column;
  }

  .book-image-wrapper {
    width: 100%;
    margin-bottom: 20px;
  }

  .book-info {
    width: 100%;
  }

  .action-buttons {
    flex-direction: column;
    gap: 10px;
  }
}
</style>
