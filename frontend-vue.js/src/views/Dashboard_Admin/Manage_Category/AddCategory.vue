// AddCategory.vue
<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white text-center">
            <h4>Tambah Kategori</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" v-model="category.nama_kategori" placeholder="Masukkan nama kategori" required />
              </div>

              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Simpan</button>
                <router-link to="/dashboard-admin/category-list" class="btn btn-secondary">Batal</router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  data() {
    return {
      category: {
        nama_kategori: "",
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        await api.post("/category", this.category);
        this.$router.push("/dashboard-admin/category-list");
      } catch (error) {
        console.error("Error adding category:", error);
      }
    },
  },
};
</script>

<style scoped>
.card {
  border-radius: 10px;
}
.card-header {
  border-radius: 10px 10px 0 0;
}
</style>