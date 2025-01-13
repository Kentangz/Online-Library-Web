<template>
  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 fade-in">
    <div class="card shadow-sm book-card">
      <div class="book-cover-wrapper">
        <img
          :src="book.image || '/src/assets/cover_book_default.png'"
          :alt="book.judul"
          class="card-img-top book-cover"
        />
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ book.judul }}</h5>
        <p class="card-author" style="font-size: 0.9rem; color: #555;">By {{ book.penulis }}</p>
        <p class="card-text" style="font-size: 0.9rem;">{{ book.deskripsi }}</p>
        <p class="card-stock" style="font-size: 0.9rem; color: #6c757d;">
          Stock: <strong>{{ book.stok }}</strong>
        </p>
        <span class="badge bg-secondary mb-3">{{ book.kategori?.data?.nama_kategori || 'Uncategorized' }}</span>

        <div class="d-flex flex-column justify-content-between align-items-center mt-3">
          <button
            class="btn btn-info btn-sm shadow-sm mb-2 w-100"
            @click="viewBook(book.id_buku)"
          >
            <i class="fas fa-eye me-1"></i> View Book
          </button>

          <button
            class="btn btn-success btn-sm shadow-sm w-100"
            @click="borrowBook(book.id_buku)"
          >
            <i class="fas fa-book-reader me-1"></i> Borrow
          </button>
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
      required: true,
    },
  },
  methods: {
    borrowBook(bookId) {
      alert(`You have borrowed the book with ID: ${bookId}`);
    },
    viewBook(bookId) {
      // Menavigasi ke halaman DetailBook dengan ID
      this.$router.push({ name: 'DetailBook', params: { id: bookId } });
    },
  },
};
</script>

<style scoped>
.book-card {
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  height: 100%;
  width: 100%;
}

.book-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
}

/* Wrapper untuk memastikan gambar buku tampil sesuai dengan ukuran asli dan latar belakang putih */
.book-cover-wrapper {
  width: 100%;
  height: 350px; /* Ukuran tinggi yang lebih sesuai agar lebih proporsional */
  background-color: white; /* Latar belakang putih jika gambar tidak ada */
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  position: relative;
}

.book-cover {
  object-fit: contain; /* Menjaga gambar dengan proporsi asli */
  width: 100%;
  height: 100%;
  max-width: 100%;
  max-height: 100%;
  background-color: white; /* Menjaga latar belakang putih jika gambar lebih kecil */
}

.card-body {
  padding: 0.75rem; /* Padding yang lebih kecil untuk card-body */
}

.card-title {
  font-size: 1.1rem; /* Ukuran font judul buku */
  font-weight: 600;
}

.card-author {
  font-size: 0.9rem; /* Ukuran font penulis yang lebih kecil */
  color: #555;
  margin-top: 0.5rem;
}

.card-text {
  font-size: 0.9rem;
  color: #6c757d;
}

/* Menambahkan gaya untuk stok buku */
.card-stock {
  font-size: 0.9rem;
  color: #6c757d;
  margin-top: 1rem;
}

.badge {
  font-size: 0.8rem;
}

.btn {
  font-size: 0.875rem;
  padding: 0.5rem 1rem;
  min-width: 100px; /* Menjamin tombol tidak terlalu kecil */
  text-align: center; /* Pastikan teks berada di tengah */
  transition: all 0.2s ease;
}

/* Tombol View Book */
.btn-info {
  background-color: #17a2b8;
  border-color: #17a2b8;
}

/* Tombol Borrow */
.btn-success {
  background-color: #28a745;
  border-color: #28a745;
}

/* Responsif untuk layar lebih kecil */
@media (max-width: 768px) {
  .btn {
    font-size: 0.875rem; /* Ukuran font tetap konsisten */
    padding: 0.5rem 0.75rem; /* Mengurangi padding agar tombol tidak terlalu besar */
  }
}

@media (max-width: 576px) {
  .btn {
    font-size: 0.875rem; /* Ukuran font tetap */
    padding: 0.5rem 0.75rem; /* Padding sedikit lebih kecil */
    min-width: 90px; /* Menyesuaikan ukuran tombol */
  }
}

.d-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.fade-in {
  animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
