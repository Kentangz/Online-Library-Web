<template>
  <div class="container py-5">
    <h2 class="text-center mb-4">Manage Transactions</h2>

    <!-- Error Message -->
    <div v-if="errorMessage" class="alert alert-danger">
      {{ errorMessage }}
    </div>

    <!-- Success Message -->
    <div v-if="successMessage" class="alert alert-success">
      {{ successMessage }}
    </div>

    <!-- Search Bar -->
    <div class="mb-3 row">
      <div class="col-md-6">
        <input
          v-model="searchQuery"
          @input="filterTransactions"
          type="text"
          class="form-control"
          placeholder="Search by User ID, Username, or Book Title"
        />
      </div>
    </div>

    <!-- Add Transaction Button -->
    <div class="text-center">
      <button @click="addTransaction" class="btn btn-primary me-3">
        Add Transaction
      </button>
      <button @click="goBack" class="btn btn-secondary">
        Back
      </button>
    </div>

    <!-- Loading Spinner -->
    <div v-if="loading" class="text-center my-4">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- Transaction Table -->
    <div v-else-if="filteredTransactions.length > 0" class="mt-4">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Transaction ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Book ID</th>
            <th scope="col">Book Title</th>
            <th scope="col">Borrow Date</th>
            <th scope="col">Return Date</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="transaction in paginatedTransactions"
            :key="transaction.id_transaksi"
          >
            <td>{{ transaction.id_transaksi }}</td>
            <td>{{ transaction.id_user }}</td>
            <td>{{ getUserName(transaction.id_user) }}</td>
            <td>{{ transaction.id_buku }}</td>
            <td>{{ getBookTitle(transaction.id_buku) }}</td>
            <td>{{ transaction.tanggal_pinjam }}</td>
            <td>{{ transaction.tanggal_kembali || 'Not returned yet' }}</td>
            <td>{{ transaction.status }}</td>
            <td>
              <button
                @click="editTransaction(transaction.id_transaksi)"
                class="btn btn-warning btn-sm me-2"
              >
                Edit
              </button>
              <button
                @click="deleteTransaction(transaction.id_transaksi)"
                class="btn btn-danger btn-sm"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <p>No transactions found.</p>
    </div>

    <!-- Pagination -->
    <nav v-if="totalPages > 1" class="mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="goToPage(currentPage - 1)">
            Previous
          </button>
        </li>
        <li
          class="page-item"
          v-for="page in totalPages"
          :key="page"
          :class="{ active: currentPage === page }"
        >
          <button class="page-link" @click="goToPage(page)">
            {{ page }}
          </button>
        </li>
        <li
          class="page-item"
          :class="{ disabled: currentPage === totalPages }"
        >
          <button class="page-link" @click="goToPage(currentPage + 1)">
            Next
          </button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  name: "ManageTransactions",
  data() {
    return {
      transactions: [], // Array to store transactions
      books: [], // Array to store books
      users: [], // Array to store users
      filteredTransactions: [], // Array for filtered transactions
      currentPage: 1, // Current page for pagination
      itemsPerPage: 8, // Items per page for pagination
      searchQuery: "", // Search query
      loading: true, // Loading state
      errorMessage: "", // Error message
      successMessage: "", // Success message
    };
  },
  mounted() {
    this.fetchAllData(); // Fetch all data when the component is mounted
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredTransactions.length / this.itemsPerPage);
    },
    paginatedTransactions() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredTransactions.slice(start, end);
    },
  },
  methods: {
    async fetchAllData() {
      this.loading = true;
      try {
        await Promise.all([this.fetchTransactions(), this.fetchBooks(), this.fetchUsers()]);
        this.filteredTransactions = this.transactions;
      } catch (error) {
        this.errorMessage = "Failed to load data. Please try again.";
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async fetchTransactions() {
      const response = await api.get("/transaction");
      if (response && response.data && Array.isArray(response.data.data)) {
        this.transactions = response.data.data;
      } else {
        throw new Error("No transactions found.");
      }
    },
    async fetchBooks() {
      const response = await api.get("/book");
      if (response && response.data && Array.isArray(response.data)) {
        this.books = response.data.map((item) => item.data);
      } else {
        throw new Error("No books found.");
      }
    },
    async fetchUsers() {
      const response = await api.get("/user");
      if (response && response.data && Array.isArray(response.data.data)) {
        this.users = response.data.data;
      } else {
        throw new Error("No users found.");
      }
    },
    getBookTitle(bookId) {
      const book = this.books.find((book) => book.id_buku === bookId);
      return book ? book.judul : "Unknown Book";
    },
    getUserName(userId) {
      const user = this.users.find((user) => user.id_user === userId);
      return user ? user.nama : "Unknown User";
    },
    addTransaction() {
      this.$router.push({ name: 'AddTransactionAdmin'});
    },
    editTransaction(transactionId) {
      this.$router.push(`/admin/transaction/edit/${transactionId}`);
    },
    async deleteTransaction(transactionId) {
      if (confirm("Are you sure you want to delete this transaction?")) {
        try {
          await api.delete(`/transaction/${transactionId}`);
          this.successMessage = "Transaction deleted successfully.";
          this.fetchAllData();
        } catch (error) {
          this.errorMessage = "Failed to delete transaction.";
        }
      }
    },
    goBack() {
      this.$router.go(-1);
    },
    filterTransactions() {
      const query = this.searchQuery.toLowerCase();
      this.filteredTransactions = this.transactions.filter(
        (transaction) =>
          transaction.id_user.toString().includes(query) ||
          this.getUserName(transaction.id_user).toLowerCase().includes(query) ||
          this.getBookTitle(transaction.id_buku).toLowerCase().includes(query)
      );
      this.currentPage = 1; // Reset to first page after filtering
    },
    goToPage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
  },
};
</script>

<style scoped>
.table th,
.table td {
  text-align: center;
}
.pagination .page-link {
  cursor: pointer;
}
</style>
