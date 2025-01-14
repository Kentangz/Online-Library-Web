<template>
  <div class="container">
    <!-- Profile Section (Top Section) -->
    <div class="row mb-4">
      <div class="col-12">
        <!-- Menampilkan Profile User -->
        <Profile />  <!-- Komponen Profil User diimpor dan digunakan disini -->
      </div>
    </div>

    <!-- Grid for User Sections (Books, Transactions, Fines) -->
    <div class="row">
      <!-- Booklist Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/user-dashboard/book-list-user')">
          <div class="card-body text-center">
            <i class="fas fa-book fa-3x mb-3"></i> <!-- Ikon buku -->
            <h5 class="card-title">Book List</h5>
            <p class="card-text">View and manage your borrowed books.</p>
          </div>
        </div>
      </div>

      <!-- Transactions Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/user-dashboard/transaction-user')">
          <div class="card-body text-center">
            <i class="fas fa-exchange-alt fa-3x mb-3"></i> <!-- Ikon transaksi -->
            <h5 class="card-title">Transactions</h5>
            <p class="card-text">View your transaction history.</p>
          </div>
        </div>
      </div>

      <!-- Fines Section -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card shadow-custom" @click="navigateTo('/user/fines')">
          <div class="card-body text-center">
            <i class="fas fa-money-bill-wave fa-3x mb-3"></i> <!-- Ikon denda -->
            <h5 class="card-title">Fines</h5>
            <p class="card-text">View and pay any outstanding fines.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Mengimpor komponen Profile
import Profile from './Profile_user/Profile.vue'; // Pastikan path sesuai dengan lokasi komponen

export default {
  name: 'DashboardUser',
  components: {
    Profile, // Mendaftarkan komponen Profile
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
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 280px;
  display: flex;
  flex-direction: column;
}

.card-body {
  padding: 25px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
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
  color: #007bff;
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
