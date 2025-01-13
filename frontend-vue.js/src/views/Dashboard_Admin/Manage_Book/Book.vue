<template>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-center">Manage Books</h1>
      <!-- Tombol Back -->
      <router-link to="/dashboard-admin" class="btn btn-secondary">Kembali</router-link>
    </div>

    <!-- Tombol navigasi untuk menambah buku -->
    <router-link to="/dashboard-admin/book-list/add-book" class="btn btn-primary mb-3">Tambah Buku</router-link>

    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Tabel buku -->
    <table v-else class="table table-striped table-hover">
      <thead class="table-success">
        <tr>
          <th>#</th>
          <th>Gambar</th>
          <th>Judul</th>
          <th>Kategori</th>
          <th>Penulis</th>
          <th>Penerbit</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(book, index) in paginatedBooks" :key="book.id_buku">
          <td>{{ index + 1 + (currentPage - 1) * perPage }}</td>
          <td>
            <img
              :src="book.image"
              alt="Book Image"
              class="img-thumbnail"
              style="width: 100px; height: 150px; object-fit: cover;"
            />
          </td>
          <td>{{ book.judul }}</td>
          <td>{{ getCategoryName(book.kategori) }}</td>
          <td>{{ book.penulis }}</td>
          <td>{{ book.penerbit }}</td>
          <td>{{ book.stok }}</td>
          <td>
            <!-- Tombol Edit -->
            <router-link :to="`/dashboard-admin/book-list/edit-book/${book.id_buku}`" class="btn btn-warning btn-sm me-2">
              Edit
            </router-link>

            <!-- Tombol Hapus -->
            <button class="btn btn-danger btn-sm" @click="deleteBook(book.id_buku)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <nav v-if="totalPages > 1" aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="currentPage--" :disabled="currentPage === 1">Previous</button>
        </li>
        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
          <button class="page-link" @click="currentPage = page">{{ page }}</button>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <button class="page-link" @click="currentPage++" :disabled="currentPage === totalPages">Next</button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  data() {
    return {
      books: [],
      loading: false,
      currentPage: 1,
      perPage: 10, // Jumlah buku per halaman
    };
  },
  computed: {
    // Buku yang ditampilkan pada halaman saat ini
    paginatedBooks() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.books.slice(start, end);
    },
    // Total halaman
    totalPages() {
      return Math.ceil(this.books.length / this.perPage);
    },
  },
  methods: {
    // Ambil data buku
    async fetchBooks() {
      this.loading = true;
      try {
        const response = await api.get("/book");
        if (response.data && Array.isArray(response.data)) {
          this.books = response.data.map((item) => {
            const category = item.data.kategori ? item.data.kategori.data : null;
            return {
              ...item.data,
              kategori: category ? category.nama_kategori : "Unknown",
            };
          });
        } else {
          throw new Error("Data buku tidak ditemukan");
        }
      } catch (err) {
        console.error("Error fetching books:", err);
      } finally {
        this.loading = false;
      }
    },

    // Mendapatkan nama kategori
    getCategoryName(category) {
      return category ? category : "Unknown";
    },

    // Menghapus buku
    async deleteBook(id) {
      if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
        try {
          await api.delete(`/book/${id}`);
          this.fetchBooks(); // Memperbarui daftar buku setelah penghapusan
        } catch (error) {
          console.error("Error deleting book:", error);
        }
      }
    },
  },
  mounted() {
    this.fetchBooks(); // Mengambil data buku saat halaman dimuat
  },
};
</script>

<style scoped>
.table img {
  border-radius: 4px;
}
.page-item.active .page-link {
  background-color: #28a745;
  border-color: #28a745;
}
</style>
