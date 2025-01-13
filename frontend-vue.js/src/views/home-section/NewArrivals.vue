<template>
  <section class="new-arrivals py-5">
    <div class="container">
      <h2 class="section-title text-center mb-4">New Arrivals</h2>
      <div class="row justify-content-center">
        <div v-for="book in books" :key="book.id_buku" class="col-md-3 mb-4">
          <div class="card h-100 shadow-sm border-light book-card">
            <img :src="book.image" :alt="book.judul" class="card-img-top book-cover" />
            <div class="card-body text-center">
              <h5 class="card-title">{{ book.judul }}</h5>
              <p class="card-text text-muted">by {{ book.penulis }}</p>
              <p class="text-muted small"><{{ book.kategori.data.nama_kategori }}></p>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
        <button class="btn btn-primary" @click="goToBooks">View All New Books</button>
      </div>
    </div>
  </section>
</template>

<script>
import api from "../../api"; // Pastikan path ini sesuai dengan file api.js yang telah kamu buat

export default {
  name: "NewArrivals",
  data() {
    return {
      books: [],
    };
  },
  methods: {
    async fetchBooks() {
      try {
        const response = await api.get("/book");

        // Debugging: Cek respons
        console.log(response);

        // Pastikan respons memiliki data yang benar dan sudah berupa array
        if (response.data && Array.isArray(response.data)) {
          // Ambil hanya bagian 'data' dari setiap objek buku
          const books = response.data.map(item => item.data);

          // Sorting buku berdasarkan 'updated_at' (terbaru di atas)
          const sortedBooks = books.sort((a, b) => {
            return new Date(b.updated_at) - new Date(a.updated_at);
          });

          // Ambil hanya 3 buku terbaru
          this.books = sortedBooks.slice(0, 3);
        } else {
          console.error("Data buku tidak ditemukan di response.");
        }
      } catch (error) {
        console.error("Error fetching books:", error);
      }
    },
    goToBooks() {
      this.$router.push("/book-list").then(() => {
        window.scrollTo(0, 0);
      });
    },
  },
  mounted() {
    this.fetchBooks(); // Memanggil fetchBooks saat komponen dimuat
  },
};
</script>

<style scoped>
.new-arrivals {
  background-color: #f9f9f9;
}
.section-title {
  font-size: 2rem;
  font-weight: 700;
  color: #333;
}
.card-img-top {
  height: 400px; /* Menetapkan tinggi gambar lebih besar untuk tampilan persegi panjang */
  object-fit: cover; /* Agar gambar tetap proporsional dan mengisi card */
  width: 100%; /* Memastikan gambar memenuhi lebar card */
}
.card-body {
  padding: 1rem;
}
.card-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}
.card-text {
  font-size: 0.85rem;
}
.text-muted {
  color: #6c757d;
}
.book-card {
  border-radius: 8px;
  overflow: hidden;
  max-width: 100%;
  margin: 0 auto;
}
.row {
  gap: 1rem; /* Mengurangi jarak antar card */
}
.text-center {
  text-align: center;
}
.btn-primary {
  padding: 0.8rem 2rem;
  font-size: 1rem;
}
</style>
