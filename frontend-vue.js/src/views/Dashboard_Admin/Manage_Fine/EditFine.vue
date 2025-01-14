<template>
    <div class="container py-5">
      <h2 class="text-center mb-4">Edit Fine</h2>
  
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
          <label for="transactionId" class="form-label">Transaction</label>
          <select v-model="formData.id_transaksi" id="transactionId" class="form-select" required>
            <option value="" disabled>Select Transaction</option>
            <option v-for="transaction in transactions" :key="transaction.id_transaksi" :value="transaction.id_transaksi">
              {{ transaction.id_transaksi }} - Book ID: {{ transaction.id_buku }} (Status: {{ transaction.status }})
            </option>
          </select>
        </div>
  
        <div class="mb-3">
          <label for="fineAmount" class="form-label">Fine Amount</label>
          <input
            type="number"
            id="fineAmount"
            class="form-control"
            v-model="formData.jumlah_denda"
            required
          />
        </div>
  
        <div class="mb-3">
          <label for="status" class="form-label">Fine Status</label>
          <select v-model="formData.status_denda" id="status" class="form-select" required>
            <option value="dibayar">Paid</option>
            <option value="belum dibayar">Unpaid</option>
          </select>
        </div>
  
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Update Fine</button>
          <button type="button" @click="goBack" class="btn btn-secondary ms-3">Back</button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import api from "../../../api";
  
  export default {
    name: "EditFineAdmin",
    data() {
      return {
        formData: {
          id_transaksi: "",
          jumlah_denda: "", // Fine amount will be populated with the existing value
          status_denda: "belum dibayar",
        },
        transactions: [],
        errorMessage: "",
        successMessage: "",
      };
    },
    mounted() {
      const fineId = this.$route.params.id; // Get the fine ID from the route params
      this.fetchFine(fineId); // Fetch the fine details based on the fine ID
      this.fetchTransactions(); // Fetch all transactions
    },
    methods: {
      // Fetch the fine details by fine ID
      async fetchFine(fineId) {
        try {
          const response = await api.get(`/fine/${fineId}`);
          if (response.data) {
            const fine = response.data.data;
            this.formData.id_denda = fine.id_denda; // Set the fine ID
            this.formData.id_transaksi = fine.id_transaksi;
            this.formData.jumlah_denda = fine.jumlah_denda; // Set the fine amount
            this.formData.status_denda = fine.status_denda;
          } else {
            throw new Error("Failed to fetch fine data.");
          }
        } catch (error) {
          console.error("Error fetching fine:", error);
          this.errorMessage = "Failed to load fine data. Please try again.";
        }
      },
  
      // Fetch all transactions
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
  
      // Submit the form to update the fine
      async handleSubmit() {
  console.log("Form Data before submit:", this.formData); // Debugging line
  try {
    const response = await api.put(`/fine/${this.formData.id_denda}`, this.formData);
    if (response && response.data) {
      this.successMessage = "Fine updated successfully.";
      this.errorMessage = "";
      this.resetForm(); // Reset form after successful update
    } else {
      throw new Error("Failed to update fine.");
    }
  } catch (error) {
    console.error("Error updating fine:", error);
    this.errorMessage = "Failed to update fine. Please try again.";
  }
},

  
      // Reset the form data after submission
      resetForm() {
        this.formData = {
          id_transaksi: "",
          jumlah_denda: "",
          status_denda: "belum dibayar",
        };
      },
  
      // Go back to the previous page
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
  