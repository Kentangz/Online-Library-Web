<template>
    <div>
      <h3>Your Transactions</h3>
  
      <!-- Back Button -->
      <button @click="goBack" class="btn btn-primary mb-3">
        <i class="bi bi-arrow-left"></i> Back
      </button>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
  
      <!-- Success Message -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <!-- Loading Indicator -->
      <div v-if="loading" class="text-center">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading transactions...
      </div>
  
      <!-- Transaction Table -->
      <div v-if="transactions.length > 0 && !loading">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Book ID</th>
              <th scope="col">Book Title</th>
              <th scope="col">Borrow Date</th>
              <th scope="col">Return Date</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="transaction in transactions" :key="transaction.id_transaksi">
              <td>{{ transaction.id_buku }}</td>
              <td>{{ transaction.bookTitle }}</td>
              <td>{{ transaction.tanggal_pinjam }}</td>
              <td>{{ transaction.tanggal_kembali || 'Not returned yet' }}</td>
              <td>{{ transaction.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <p v-if="!loading">No transactions found.</p>
      </div>
    </div>
  </template>
  
  <script>
  import api from "../../api"; // Pastikan path ke API sudah benar
  
  export default {
    name: "UserTransaction",
    data() {
      return {
        transactions: [], // Array untuk menyimpan data transaksi
        errorMessage: "", // Menyimpan pesan error
        successMessage: "", // Menyimpan pesan success
        loading: false, // Menyimpan status loading
      };
    },
    mounted() {
      this.fetchUserTransactions(); // Panggil fungsi untuk mengambil data transaksi saat komponen dimuat
    },
    methods: {
      // Fungsi untuk mengambil seluruh transaksi dan memfilter berdasarkan user_id
      async fetchUserTransactions() {
        this.loading = true; // Set loading menjadi true saat mulai fetch data
        const userId = localStorage.getItem("user_id"); // Ambil user_id dari localStorage
  
        if (!userId) {
          this.errorMessage = "User not logged in. Please login first.";
          this.loading = false; // Set loading menjadi false setelah error
          return;
        }
  
        try {
          const response = await api.get("/transaction"); // Ambil semua transaksi
  
          if (response && response.data && Array.isArray(response.data.data)) {
            // Filter transaksi berdasarkan id_user yang sama dengan userId
            this.transactions = response.data.data
              .filter(transaction => transaction.id_user === parseInt(userId))
              .map(async (transaction) => {
                // Fetch nama buku berdasarkan id_buku untuk setiap transaksi
                const bookResponse = await api.get(`/book/${transaction.id_buku}`);
                if (bookResponse && bookResponse.data && bookResponse.data.data) {
                  // Menambahkan nama buku (judul) ke transaksi
                  transaction.bookTitle = bookResponse.data.data.judul;
                }
                return transaction;
              });
  
            // Tunggu semua promise selesai
            this.transactions = await Promise.all(this.transactions);
  
            if (this.transactions.length === 0) {
              this.errorMessage = "No transactions found.";
            } else {
              this.successMessage = "Transactions loaded successfully.";
            }
          } else {
            throw new Error("Invalid response structure or data not found.");
          }
        } catch (error) {
          console.error("Error fetching transactions:", error);
          this.errorMessage = "Failed to load transactions. Please try again.";
        } finally {
          this.loading = false; // Set loading menjadi false setelah selesai fetch
        }
      },
  
      // Fungsi untuk kembali ke halaman sebelumnya
      goBack() {
        this.$router.go(-1); // Menggunakan router untuk kembali ke halaman sebelumnya
      },
    },
  };
  </script>
  
  <style scoped>
  /* Anda bisa menyesuaikan gaya CSS ini sesuai kebutuhan */
  .alert {
    text-align: center;
  }
  
  table {
    width: 100%;
    margin-top: 20px;
  }
  
  table th,
  table td {
    text-align: center;
  }
  
  .spinner-border {
    width: 2rem;
    height: 2rem;
    border-width: 0.3em;
  }
  
  button {
    margin-top: 15px;
  }
  </style>
  