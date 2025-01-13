<template>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="text-center">Manage Categories</h1>
      <!-- Tombol Back -->
      <router-link to="/dashboard-admin" class="btn btn-secondary">Kembali</router-link>
    </div>

    <!-- Tombol navigasi untuk menambah kategori -->
    <router-link to="/dashboard-admin/category-list/add-category" class="btn btn-primary mb-3">Tambah Kategori</router-link>

    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Tabel kategori -->
    <table v-else class="table table-striped table-hover">
      <thead class="table-success">
        <tr>
          <th>#</th>
          <th>Nama Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(category, index) in paginatedCategories" :key="category.id_kategori">
          <td>{{ index + 1 + (currentPage - 1) * perPage }}</td>
          <td>{{ category.nama_kategori }}</td>
          <td>
            <!-- Tombol Edit -->
            <router-link :to="`/dashboard-admin/category-list/edit-category/${category.id_kategori}`" class="btn btn-warning btn-sm me-2">Edit</router-link>

            <!-- Tombol Hapus -->
            <button class="btn btn-danger btn-sm" @click="deleteCategory(category.id_kategori)">Hapus</button>
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
      categories: [],
      loading: false,
      currentPage: 1,
      perPage: 10, // Jumlah kategori per halaman
    };
  },
  computed: {
    // Kategori yang ditampilkan pada halaman saat ini
    paginatedCategories() {
      const start = (this.currentPage - 1) * this.perPage;
      const end = start + this.perPage;
      return this.categories.slice(start, end);
    },
    // Total halaman
    totalPages() {
      return Math.ceil(this.categories.length / this.perPage);
    },
  },
  methods: {
    // Ambil data kategori
    async fetchCategories() {
      this.loading = true;
      try {
        const response = await api.get("/category");
        this.categories = response.data.data;
      } catch (error) {
        console.error("Error fetching categories:", error);
      } finally {
        this.loading = false;
      }
    },

    // Menghapus kategori
    async deleteCategory(id) {
      if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
        try {
          await api.delete(`/category/${id}`);
          this.fetchCategories(); // Memperbarui daftar kategori setelah penghapusan
        } catch (error) {
          console.error("Error deleting category:", error);
        }
      }
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>

<style scoped>
.table {
  margin-top: 20px;
}
.page-item.active .page-link {
  background-color: #28a745;
  border-color: #28a745;
}
</style>
