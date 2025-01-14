<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Add Transaction</h2>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
  
      <!-- Success Message -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label for="userId" class="form-label">User</label>
          <select v-model="formData.id_user" id="userId" class="form-select" required>
            <option value="" disabled>Select User</option>
            <option v-for="user in users" :key="user.id_user" :value="user.id_user">
              {{ user.nama }} (ID: {{ user.id_user }})
            </option>
          </select>
        </div>
  
        <div class="mb-3">
          <label for="bookId" class="form-label">Book</label>
          <select v-model="formData.id_buku" id="bookId" class="form-select" required>
            <option value="" disabled>Select Book</option>
            <option v-for="book in books" :key="book.id_buku" :value="book.id_buku">
              {{ book.judul }} (ID: {{ book.id_buku }})
            </option>
          </select>
        </div>
  
        <div class="mb-3">
          <label for="borrowDate" class="form-label">Borrow Date</label>
          <input
            type="date"
            id="borrowDate"
            class="form-control"
            v-model="formData.tanggal_pinjam"
            required
          />
        </div>
  
        <div class="mb-3">
          <label for="returnDate" class="form-label">Return Date</label>
          <input
            type="date"
            id="returnDate"
            class="form-control"
            v-model="formData.tanggal_kembali"
          />
        </div>
  
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select v-model="formData.status" id="status" class="form-select" required>
            <option value="" disabled>Select Status</option>
            <option value="dipinjam">Dipinjam</option>
            <option value="kembali">Kembali</option>
            <option value="telat">Telat</option>
          </select>
        </div>
  
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Add Transaction</button>
          <button type="button" @click="goBack" class="btn btn-secondary ms-3">Back</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "AddTransactionAdmin",
    data() {
      return {
        formData: {
          id_user: "",
          id_buku: "",
          tanggal_pinjam: "",
          tanggal_kembali: null,
          status: "dipinjam",
        },
        users: [], // Data users
        books: [], // Data books
        errorMessage: "", // Untuk pesan error
        successMessage: "", // Untuk pesan success
      };
    },
    mounted() {
      this.fetchUsers(); // Ambil semua user
      this.fetchBooks(); // Ambil semua buku
    },
    methods: {
      // Ambil semua user
      async fetchUsers() {
        try {
          const response = await api.get("/user");
          if (response && response.data && Array.isArray(response.data.data)) {
            this.users = response.data.data;
          } else {
            throw new Error("Failed to load users.");
          }
        } catch (error) {
          console.error("Error fetching users:", error);
          this.errorMessage = "Failed to load users. Please try again.";
        }
      },
  
      // Ambil semua buku
      async fetchBooks() {
        try {
          const response = await api.get("/book");
          if (response && response.data && Array.isArray(response.data)) {
            this.books = response.data.map((item) => item.data);
          } else {
            throw new Error("Failed to load books.");
          }
        } catch (error) {
          console.error("Error fetching books:", error);
          this.errorMessage = "Failed to load books. Please try again.";
        }
      },
  
      // Submit form untuk menambahkan transaksi
      async handleSubmit() {
        try {
          const response = await api.post("/transaction", this.formData);
          if (response && response.data && response.data.success) {
            this.successMessage = "Transaction added successfully.";
            this.errorMessage = "";
            this.resetForm(); // Reset form setelah sukses
          } else {
            throw new Error("Failed to add transaction.");
          }
        } catch (error) {
          console.error("Error adding transaction:", error);
          this.errorMessage = "Failed to add transaction. Please try again.";
        }
      },
  
      // Reset form
      resetForm() {
        this.formData = {
          id_user: "",
          id_buku: "",
          tanggal_pinjam: "",
          tanggal_kembali: null,
          status: "dipinjam",
        };
      },
  
      // Kembali ke halaman sebelumnya
      goBack() {
        this.$router.go(-1);
      },
    },
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 600px;
  }
  
  .form-label {
    font-weight: bold;
  }
  
  .text-center {
    margin-top: 20px;
  }
  </style>
  