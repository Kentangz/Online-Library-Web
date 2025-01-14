<template>
    <div>
      <h3>Your Fines</h3>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
  
      <!-- Success Message -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <!-- Fines Table -->
      <div v-if="fines.length > 0">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Book ID</th>
              <th scope="col">Book Title</th>
              <th scope="col">Fine Amount</th>
              <th scope="col">Fine Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="fine in fines" :key="fine.id_denda">
              <td>{{ fine.id_buku }}</td> <!-- Menampilkan ID Buku -->
              <td>{{ fine.bookTitle }}</td> <!-- Menampilkan Judul Buku -->
              <td>{{ fine.jumlah_denda | currency }}</td>
              <td>{{ fine.status_denda }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <p>No fines found.</p>
      </div>
  
      <!-- Back Button -->
      <button class="btn btn-secondary" @click="goBack">Back</button>
    </div>
  </template>
  
  <script>
  import api from "../../api"; // Pastikan path ke API sudah benar
  
  export default {
    name: "UserFines",
    data() {
      return {
        fines: [], // Array untuk menyimpan data denda
        books: [], // Array untuk menyimpan data buku
        errorMessage: "", // Menyimpan pesan error
        successMessage: "", // Menyimpan pesan sukses
        loading: false, // Status loading
      };
    },
    mounted() {
      this.fetchBooks(); // Ambil data buku saat komponen dimuat
      this.fetchUserFines(); // Panggil fungsi untuk mengambil data denda saat komponen dimuat
    },
    methods: {
      // Fungsi untuk mengambil seluruh buku
      async fetchBooks() {
        this.loading = true;
        try {
          const response = await api.get("/book");
          if (response.data && Array.isArray(response.data)) {
            this.books = response.data
              .map((item) => item.data) // Ambil data buku dari response
              .sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at)); // Sort descending by updated_at
          } else {
            throw new Error("Data buku tidak ditemukan");
          }
        } catch (err) {
          console.error("Error fetching books:", err);
        } finally {
          this.loading = false;
        }
      },
  
      // Fungsi untuk mengambil seluruh denda dan memfilter berdasarkan user_id
      async fetchUserFines() {
        const userId = localStorage.getItem("user_id"); // Ambil user_id dari localStorage
  
        if (!userId) {
          this.errorMessage = "User not logged in. Please login first.";
          return;
        }
  
        try {
          // Ambil seluruh data denda
          const finesResponse = await api.get("/fine");
          const transactionsResponse = await api.get("/transaction");
  
          if (
            finesResponse &&
            finesResponse.data &&
            Array.isArray(finesResponse.data.data) &&
            transactionsResponse &&
            transactionsResponse.data &&
            Array.isArray(transactionsResponse.data.data)
          ) {
            // Filter transaksi berdasarkan id_user yang sama dengan userId dan status transaksi "telat"
            const userTransactions = transactionsResponse.data.data.filter(
              (transaction) =>
                transaction.id_user === parseInt(userId) && transaction.status === "telat"
            );
  
            // Filter denda yang terkait dengan transaksi yang terlambat
            this.fines = finesResponse.data.data
              .filter((fine) =>
                userTransactions.some(
                  (transaction) => transaction.id_transaksi === fine.id_transaksi
                )
              )
              .map((fine) => {
                // Cari nama buku berdasarkan id_buku untuk setiap transaksi yang terkait dengan denda
                const relatedTransaction = userTransactions.find(
                  (transaction) => transaction.id_transaksi === fine.id_transaksi
                );
                const book = this.books.find(
                  (b) => b.id_buku === relatedTransaction.id_buku
                );
                return {
                  ...fine,
                  bookTitle: book ? book.judul : "Unknown Book", // Menambahkan judul buku
                  id_buku: relatedTransaction.id_buku, // Menambahkan id_buku
                };
              });
  
            if (this.fines.length === 0) {
              this.errorMessage = "No fines found.";
            } else {
              this.successMessage = "Fines loaded successfully.";
            }
          } else {
            throw new Error("Invalid response structure or data not found.");
          }
        } catch (error) {
          console.error("Error fetching fines:", error);
          this.errorMessage = "Failed to load fines. Please try again.";
        }
      },
  
      // Fungsi untuk kembali ke halaman sebelumnya
      goBack() {
        this.$router.go(-1);
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
  
  button {
    margin-top: 20px;
  }
  </style>
  