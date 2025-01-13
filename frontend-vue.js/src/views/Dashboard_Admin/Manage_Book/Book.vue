<template>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Manage Books</h1>

    <!-- Tombol navigasi untuk menambah buku -->
    <router-link to="/dashboard-admin/book-list/add-book" class="btn btn-primary mb-3">Tambah Buku</router-link>

    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Tabel buku -->
    <table v-else class="table table-striped">
      <thead>
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
        <tr v-for="(book, index) in books" :key="book.id_buku">
          <td>{{ index + 1 }}</td>
          <td>
            <img :src="book.image" alt="Book Image" class="img-thumbnail" style="width: 50px; height: 50px;" />
          </td>
          <td>{{ book.judul }}</td>
          <td>{{ getCategoryName(book.kategori) }}</td>
          <td>{{ book.penulis }}</td>
          <td>{{ book.penerbit }}</td>
          <td>{{ book.stok }}</td>
          <td>
            <!-- Tombol Edit -->
            <router-link :to="`/dashboard-admin/book-list/edit-book/${book.id_buku}`" class="btn btn-warning btn-sm me-2">Edit</router-link>

            <!-- Tombol Hapus -->
            <button class="btn btn-danger btn-sm" @click="deleteBook(book.id_buku)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  data() {
    return {
      books: [],
      loading: false,
    };
  },
  methods: {
    // Ambil data buku
    async fetchBooks() {
      this.loading = true;
      try {
        const response = await api.get("/book");
        if (response.data && Array.isArray(response.data)) {
          this.books = response.data.map((item) => {
            // Mengambil kategori, jika tidak ada, beri nilai default "Unknown"
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
