<template>
  <div class="container">
    <!-- Profile Section (Top Section) -->
    <div class="row mb-4">
      <div class="col-12">
        <!-- Menyisipkan komponen Profile tanpa merubah ukuran -->
        <Profile />
      </div>
    </div>

    <!-- Grid for Other Sections (Books, Transactions, etc.) -->
    <div class="row">
      <!-- Books Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/dashboard-admin/book-list')">
          <div class="card-body text-center">
            <i class="fas fa-book fa-3x mb-3"></i> <!-- Ikon buku -->
            <h5 class="card-title">Books</h5>
            <p class="card-text">Manage the books in the library.</p>
          </div>
        </div>
      </div>

      <!-- Categories Section (Moved next to Books) -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/dashboard-admin/category-list')">
          <div class="card-body text-center">
            <i class="fas fa-th-large fa-3x mb-3"></i> <!-- Ikon kategori -->
            <h5 class="card-title">Categories</h5>
            <p class="card-text">Organize books by categories.</p>
          </div>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/dashboard-admin/transaction')">
          <div class="card-body text-center">
            <i class="fas fa-exchange-alt fa-3x mb-3"></i> <!-- Ikon transaksi -->
            <h5 class="card-title">Transactions</h5>
            <p class="card-text">View all library transactions.</p>
          </div>
        </div>
      </div>

      <!-- Fines Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/dashboard-admin/fine')">
          <div class="card-body text-center">
            <i class="fas fa-money-bill-wave fa-3x mb-3"></i> <!-- Ikon denda -->
            <h5 class="card-title">Fines</h5>
            <p class="card-text">Manage overdue fines for books.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Mengimpor komponen Profile untuk ditampilkan langsung di dashboard
import Profile from './Profile.vue';

export default {
  name: "Dashboard",
  components: {
    Profile, // Menambahkan Profile sebagai komponen
  },
  methods: {
    navigateTo(route) {
      this.$router.push(route); // Navigasi ke halaman sesuai route
    }
  }
};
</script>

<style scoped>
.container {
  padding: 30px;
  background-color: #f8f9fa;
}

.card {
  border-radius: 16px;
  cursor: pointer; /* Menambah efek pointer untuk menunjukkan bisa diklik */
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 280px; /* Mengatur tinggi kartu agar sama */
  display: flex;
  flex-direction: column;
}

.card-body {
  padding: 25px;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Menjaga isi agar tetap rapi */
}

.card-title {
  font-size: 1.3rem;
  font-weight: bold;
  color: #333;
}

.card-text {
  margin-bottom: 20px;
  color: #555;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
}

.card-body i {
  color: #007bff; /* Warna ikon */
}

.card-body .btn {
  border-radius: 50px;
  padding: 12px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.card-body .btn:hover {
  background-color: #007bff;
}

@media (max-width: 767px) {
  .card-body {
    padding: 20px;
  }

  .card-title {
    font-size: 1.2rem;
  }

  .col-md-6 {
    padding-left: 15px;
    padding-right: 15px;
  }
}

@media (max-width: 575px) {
  .card-title {
    font-size: 1rem;
  }

  .card-body {
    padding: 15px;
  }
}
</style>
