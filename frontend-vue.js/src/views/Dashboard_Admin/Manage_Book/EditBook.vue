<template>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header text-center bg-warning text-white">
              <h4>Edit Buku</h4>
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
  
                <!-- Gambar Buku Lama -->
                <div class="mb-3" v-if="book.imageUrl">
                  <label class="form-label">Gambar Buku Lama</label>
                  <div>
                    <img :src="book.imageUrl" alt="Gambar Buku Lama" class="img-thumbnail" style="width: 150px; height: auto;" />
                  </div>
                </div>
  
                <!-- Gambar Buku Baru -->
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar Buku Baru</label>
                  <input type="file" class="form-control" id="image" @change="handleImageUpload" />
                  <small class="text-muted">Format gambar: JPG, PNG</small>
                  <!-- Menampilkan gambar preview jika sudah diupload -->
                  <div v-if="book.imagePreview" class="mt-3">
                    <img :src="book.imagePreview" alt="Preview Gambar Buku" class="img-thumbnail" style="width: 150px; height: auto;" />
                  </div>
                </div>
  
                <!-- Tombol Submit -->
                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
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
          id: null,
          judul: "",
          penulis: "",
          penerbit: "",
          stok: "",
          kategori: "",
          imageUrl: null, // Untuk gambar buku yang lama
          imagePreview: null, // Untuk gambar preview yang baru diupload
          image: null, // Untuk gambar yang diupload
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
  
      // Ambil data buku berdasarkan ID
      async fetchBook() {
        try {
          const response = await api.get(`/book/${this.$route.params.id}`);
          const bookData = response.data.data;
          this.book.id = bookData.id_buku;
          this.book.judul = bookData.judul;
          this.book.penulis = bookData.penulis;
          this.book.penerbit = bookData.penerbit;
          this.book.stok = bookData.stok;
          this.book.kategori = bookData.kategori ? bookData.kategori.id_kategori : "";
          this.book.imageUrl = bookData.image; // Menyimpan URL gambar lama
        } catch (error) {
          console.error("Error fetching book:", error);
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
  
      // Kirim data form untuk mengedit buku
      async submitForm() {
        const formData = new FormData();
        formData.append("judul", this.book.judul);
        formData.append("penulis", this.book.penulis);
        formData.append("penerbit", this.book.penerbit);
        formData.append("stok", this.book.stok);
        formData.append("kategori", this.book.kategori);
        if (this.book.image) formData.append("image", this.book.image);
  
        // Tambahkan _method untuk mengubah menjadi PUT
        formData.append("_method", "PUT");
  
        try {
          await api.post(`/book/${this.book.id}`, formData); // Menggunakan POST untuk mengirim PUT
          this.$router.push("/dashboard-admin/book-list"); // Redirect setelah berhasil mengedit buku
        } catch (error) {
          console.error("Error submitting form:", error);
        }
      },
    },
    mounted() {
      this.fetchCategories();
      this.fetchBook(); // Ambil data buku berdasarkan ID yang ada di URL
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
  