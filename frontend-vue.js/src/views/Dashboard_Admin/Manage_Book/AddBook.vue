<template>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header text-center bg-success text-white">
              <h4>Tambah Buku</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="submitForm">
                <!-- Judul Buku -->
                <div class="mb-3">
                  <label for="judul" class="form-label">Judul Buku</label>
                  <input type="text" class="form-control" id="judul" v-model="book.judul" placeholder="Masukkan judul buku" required />
                </div>
  
                <!-- Penulis -->
                <div class="mb-3">
                  <label for="penulis" class="form-label">Penulis</label>
                  <input type="text" class="form-control" id="penulis" v-model="book.penulis" placeholder="Masukkan nama penulis" required />
                </div>
  
                <!-- Penerbit -->
                <div class="mb-3">
                  <label for="penerbit" class="form-label">Penerbit</label>
                  <input type="text" class="form-control" id="penerbit" v-model="book.penerbit" placeholder="Masukkan nama penerbit" required />
                </div>
  
                <!-- Stok -->
                <div class="mb-3">
                  <label for="stok" class="form-label">Stok</label>
                  <input type="number" class="form-control" id="stok" v-model="book.stok" placeholder="Jumlah stok buku" required />
                </div>
  
                <!-- Kategori -->
                <div class="mb-3">
                  <label for="kategori" class="form-label">Kategori</label>
                  <select class="form-select" id="kategori" v-model="book.kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option v-for="category in categories" :key="category.id_kategori" :value="category.id_kategori">
                      {{ category.nama_kategori }}
                    </option>
                  </select>
                </div>
  
                <!-- Gambar Buku -->
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar Buku</label>
                  <input type="file" class="form-control" id="image" @change="handleImageUpload" />
                  <small class="text-muted">Format gambar: JPG, PNG</small>
                  <!-- Menampilkan gambar preview -->
                  <div v-if="book.imagePreview" class="mt-3">
                    <img :src="book.imagePreview" alt="Preview Gambar Buku" class="img-thumbnail" style="width: 150px; height: auto;" />
                  </div>
                </div>
  
                <!-- Tombol Submit -->
                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-success">Simpan Buku</button>
                  <router-link to="/dashboard-admin/book-list" class="btn btn-secondary">Batal</router-link>
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
        book: {
          judul: "",
          penulis: "",
          penerbit: "",
          stok: "",
          kategori: "",
          image: null,
          imagePreview: null,
        },
        categories: [],
      };
    },
    methods: {
      // Ambil data kategori untuk dropdown
      async fetchCategories() {
        try {
          const response = await api.get("/category");
          this.categories = response.data.data;
        } catch (error) {
          console.error("Error fetching categories:", error);
        }
      },
  
      // Handle perubahan gambar
      handleImageUpload(event) {
        this.book.image = event.target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
          this.book.imagePreview = reader.result;
        };
        reader.readAsDataURL(this.book.image);
      },
  
      // Kirim data form untuk menambah buku
      async submitForm() {
        const formData = new FormData();
        formData.append("judul", this.book.judul);
        formData.append("penulis", this.book.penulis);
        formData.append("penerbit", this.book.penerbit);
        formData.append("stok", this.book.stok);
        formData.append("kategori_id", this.book.kategori);  // Menggunakan kategori_id
        if (this.book.image) formData.append("image", this.book.image);
  
        // Debugging: Menampilkan data FormData di console
        for (let pair of formData.entries()) {
          console.log(pair[0] + ': ' + pair[1]);
        }
  
        try {
          await api.post("/book", formData);
          this.$router.push("/dashboard-admin/book-list");
        } catch (error) {
          console.error("Error submitting form:", error.response ? error.response.data : error);
        }
      },
    },
    mounted() {
      this.fetchCategories(); // Ambil data kategori saat halaman dimuat
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
  button[type="submit"] {
    width: 48%;
  }
  button[type="button"] {
    width: 48%;
  }
  </style>
  