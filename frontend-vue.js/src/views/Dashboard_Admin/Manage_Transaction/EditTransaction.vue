<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Edit Transaction</h2>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
  
      <!-- Success Message -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <!-- Edit Transaction Form -->
      <form @submit.prevent="updateTransaction" class="mt-4">
        <div class="mb-3">
          <label for="user" class="form-label">User</label>
          <select v-model="transaction.id_user" id="user" class="form-select" required>
            <option value="" disabled>Select a user</option>
            <option v-for="user in users" :key="user.id_user" :value="user.id_user">
              {{ user.nama }}
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="book" class="form-label">Book</label>
          <select v-model="transaction.id_buku" id="book" class="form-select" required>
            <option value="" disabled>Select a book</option>
            <option v-for="book in books" :key="book.id_buku" :value="book.id_buku">
              {{ book.judul }}
            </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="borrow-date" class="form-label">Borrow Date</label>
          <input
            type="date"
            v-model="transaction.tanggal_pinjam"
            id="borrow-date"
            class="form-control"
            required
          />
        </div>
        <div class="mb-3">
          <label for="return-date" class="form-label">Return Date</label>
          <input
            type="date"
            v-model="transaction.tanggal_kembali"
            id="return-date"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select v-model="transaction.status" id="status" class="form-select" required>
            <option value="dipinjam">Dipinjam</option>
            <option value="kembali">Kembali</option>
            <option value="telat">Telat</option>
          </select>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" @click="goBack" class="btn btn-secondary">Back</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "EditTransactionAdmin",
    data() {
      return {
        transaction: {
          id_user: "",
          id_buku: "",
          tanggal_pinjam: "",
          tanggal_kembali: "",
          status: "",
        },
        users: [], // List of users
        books: [], // List of books
        errorMessage: "",
        successMessage: "",
        loading: false,
      };
    },
    mounted() {
      this.fetchTransactionDetails(); // Load existing transaction data
      this.fetchUsers(); // Load user list
      this.fetchBooks(); // Load book list
    },
    methods: {
      // Fetch transaction details by ID
      async fetchTransactionDetails() {
        const transactionId = this.$route.params.id; // Get ID from route params
        try {
          const response = await api.get(`/transaction/${transactionId}`);
          if (response && response.data) {
            // Populate transaction fields with fetched data
            this.transaction = {
              id_user: response.data.data.id_user,
              id_buku: response.data.data.id_buku,
              tanggal_pinjam: response.data.data.tanggal_pinjam,
              tanggal_kembali: response.data.data.tanggal_kembali,
              status: response.data.data.status,
            };
          } else {
            throw new Error("Transaction not found.");
          }
        } catch (error) {
          console.error("Error fetching transaction details:", error);
          this.errorMessage = "Failed to load transaction details.";
        }
      },
  
      // Fetch all users
      async fetchUsers() {
        try {
          const response = await api.get("/user");
          if (response && response.data && Array.isArray(response.data.data)) {
            this.users = response.data.data;
          } else {
            throw new Error("No users found.");
          }
        } catch (error) {
          console.error("Error fetching users:", error);
          this.errorMessage = "Failed to load users.";
        }
      },
  
      // Fetch all books
      async fetchBooks() {
        try {
          const response = await api.get("/book");
          if (response && response.data && Array.isArray(response.data)) {
            this.books = response.data.map((item) => item.data);
          } else {
            throw new Error("No books found.");
          }
        } catch (error) {
          console.error("Error fetching books:", error);
          this.errorMessage = "Failed to load books.";
        }
      },
  
      // Update transaction
      async updateTransaction() {
        const transactionId = this.$route.params.id;
        try {
          this.loading = true;
          const response = await api.put(`/transaction/${transactionId}`, this.transaction);
          if (response && response.data) {
            this.successMessage = "Transaction updated successfully.";
            this.errorMessage = "";
          } else {
            throw new Error("Failed to update transaction.");
          }
        } catch (error) {
          console.error("Error updating transaction:", error);
          this.errorMessage = "Failed to update transaction.";
        } finally {
          this.loading = false;
        }
      },
  
      // Navigate back to the previous page
      goBack() {
        this.$router.go(-1);
      },
    },
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
  }
  
  form {
    margin-top: 20px;
  }
  
  button {
    min-width: 120px;
  }
  
  .alert {
    text-align: center;
  }
  </style>
  