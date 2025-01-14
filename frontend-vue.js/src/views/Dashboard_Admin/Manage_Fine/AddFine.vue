<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Add Fine</h2>
  
      <!-- Error Message -->
      <div v-if="errorMessage" class="alert alert-danger">
        {{ errorMessage }}
      </div>
  
      <!-- Success Message -->
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <form @submit.prevent="handleSubmit">
        <!-- Dropdown Transaction ID -->
        <div class="mb-3">
          <label for="transactionId" class="form-label">Transaction</label>
          <select v-model="formData.id_transaksi" id="transactionId" class="form-select" required>
            <option value="" disabled>Select Transaction</option>
            <option v-for="transaction in transactions" :key="transaction.id_transaksi" :value="transaction.id_transaksi">
              Transaction ID: {{ transaction.id_transaksi }} (User ID: {{ transaction.id_user }}, Book ID: {{ transaction.id_buku }})
            </option>
          </select>
        </div>
  
        <!-- Input for Fine Amount -->
        <div class="mb-3">
          <label for="fineAmount" class="form-label">Fine Amount</label>
          <input
            type="number"
            id="fineAmount"
            class="form-control"
            v-model="formData.jumlah_denda"
            required
            placeholder="Enter Fine Amount"
          />
        </div>
  
        <!-- Dropdown Status (Enum) -->
        <div class="mb-3">
          <label for="fineStatus" class="form-label">Fine Status</label>
          <select v-model="formData.status_denda" id="fineStatus" class="form-select" required>
            <option value="dibayar">Dibayar</option>
            <option value="belum dibayar">Belum Dibayar</option>
          </select>
        </div>
  
        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Add Fine</button>
          <button type="button" @click="goBack" class="btn btn-secondary ms-3">Back</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "AddFine",
    data() {
      return {
        formData: {
          id_transaksi: "",
          jumlah_denda: "",
          status_denda: "belum dibayar", // Default status is "belum dibayar"
        },
        transactions: [], // Data transactions
        errorMessage: "", // Untuk pesan error
        successMessage: "", // Untuk pesan success
      };
    },
    mounted() {
      this.fetchTransactions(); // Ambil semua transaksi
    },
    methods: {
      // Ambil semua transaksi untuk mendapatkan id_transaksi
      async fetchTransactions() {
        try {
          const response = await api.get("/transaction");
          if (response && response.data && Array.isArray(response.data.data)) {
            this.transactions = response.data.data;
          } else {
            throw new Error("Failed to load transactions.");
          }
        } catch (error) {
          console.error("Error fetching transactions:", error);
          this.errorMessage = "Failed to load transactions. Please try again.";
        }
      },
  
      // Submit form untuk menambahkan denda
      async handleSubmit() {
        try {
          const response = await api.post("/fine", this.formData);
          if (response && response.data && response.data.success) {
            this.successMessage = "Fine added successfully.";
            this.errorMessage = "";
            this.resetForm(); // Reset form setelah sukses
          } else {
            throw new Error("Failed to add fine.");
          }
        } catch (error) {
          console.error("Error adding fine:", error);
          this.errorMessage = "Failed to add fine. Please try again.";
        }
      },
  
      // Reset form
      resetForm() {
        this.formData = {
          id_transaksi: "",
          jumlah_denda: "",
          status_denda: "belum dibayar", // Reset to default
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
  