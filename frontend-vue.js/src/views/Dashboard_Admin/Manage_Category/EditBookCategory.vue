<template>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Edit Kategori</h1>

    <!-- Tombol Kembali -->
    <router-link to="/dashboard-admin/category-list" class="btn btn-secondary mb-3">Kembali</router-link>

    <div v-if="loading" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Form Edit Kategori -->
    <form v-else @submit.prevent="updateCategory">
      <div class="mb-3">
        <label for="previousCategory" class="form-label">Nama Kategori Sebelumnya</label>
        <input
          type="text"
          id="previousCategory"
          class="form-control"
          :value="previousData.nama_kategori"
          disabled
        />
      </div>
      <div class="mb-3">
        <label for="categoryName" class="form-label">Nama Kategori Baru</label>
        <input
          type="text"
          id="categoryName"
          v-model="form.nama_kategori"
          class="form-control"
          placeholder="Masukkan nama kategori baru"
          required
        />
      </div>
      <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  data() {
    return {
      form: {
        nama_kategori: "",
      },
      previousData: {}, // Data kategori sebelumnya
      loading: true,
    };
  },
  methods: {
    // Ambil data kategori berdasarkan ID
    async fetchCategoryData() {
      try {
        const response = await api.get(`/category/${this.$route.params.id}`);
        this.previousData = response.data.data;
        this.form.nama_kategori = this.previousData.nama_kategori;
      } catch (error) {
        console.error("Error fetching category data:", error);
      } finally {
        this.loading = false;
      }
    },

    // Perbarui kategori
    async updateCategory() {
      try {
        await api.put(`/category/${this.$route.params.id}`, this.form);
        alert("Kategori berhasil diperbarui!");
      } catch (error) {
        console.error("Error updating category:", error);
      }        this.$router.push("/dashboard-admin/category-list");

    },
  },
  mounted() {
    this.fetchCategoryData(); // Ambil data kategori saat komponen dimuat
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
</style>
