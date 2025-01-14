<template>
  <div class="container py-5">
    <h2 class="text-center mb-4">Manage Fines</h2>

    <!-- Error Message -->
    <div v-if="errorMessage" class="alert alert-danger">
      {{ errorMessage }}
    </div>

    <!-- Success Message -->
    <div v-if="successMessage" class="alert alert-success">
      {{ successMessage }}
    </div>

    <!-- Add Fine and Back Buttons (Moved above the table) -->
    <div class="text-center mb-4">
      <button @click="addFine" class="btn btn-primary me-3">
        Add Fine
      </button>
      <button @click="goBack" class="btn btn-secondary">
        Back
      </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-3">
      <input
        type="text"
        v-model="searchQuery"
        class="form-control"
        placeholder="Search by User Name or Book Title"
      />
    </div>

    <!-- Fines Table -->
    <div v-if="filteredFines.length > 0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Fine ID</th>
            <th scope="col">User ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Book ID</th>
            <th scope="col">Book Title</th>
            <th scope="col">Fine Amount</th>
            <th scope="col">Fine Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fine in paginatedFines" :key="fine.id_denda">
            <td>{{ fine.id_denda }}</td>
            <td>{{ fine.id_user }}</td> <!-- Menampilkan ID User -->
            <td>{{ fine.userName }}</td>
            <td>{{ fine.id_buku }}</td> <!-- Menampilkan ID Buku -->
            <td>{{ fine.bookTitle }}</td>
            <td>{{ fine.jumlah_denda | currency }}</td>
            <td>{{ fine.status_denda }}</td>
            <td>
              <button @click="editFine(fine.id_denda)" class="btn btn-warning btn-sm me-2">
                Edit
              </button>
              <button @click="deleteFine(fine.id_denda)" class="btn btn-danger btn-sm">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <p>No fines found.</p>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li
            class="page-item"
            :class="{ disabled: currentPage === 1 }"
          >
            <button
              class="page-link"
              @click="changePage(currentPage - 1)"
              aria-label="Previous"
            >
              <span aria-hidden="true">&laquo;</span>
            </button>
          </li>
          <li
            class="page-item"
            v-for="page in totalPages"
            :key="page"
            :class="{ active: page === currentPage }"
          >
            <button
              class="page-link"
              @click="changePage(page)"
            >
              {{ page }}
            </button>
          </li>
          <li
            class="page-item"
            :class="{ disabled: currentPage === totalPages }"
          >
            <button
              class="page-link"
              @click="changePage(currentPage + 1)"
              aria-label="Next"
            >
              <span aria-hidden="true">&raquo;</span>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  name: "FineAdmin",
  data() {
    return {
      fines: [], // Array to store fines
      books: [], // Array to store books
      users: [], // Array to store users
      transactions: [], // Array to store transactions
      errorMessage: "", // Error message
      successMessage: "", // Success message
      loading: false, // Loading state
      searchQuery: "", // Search query
      currentPage: 1, // Current page for pagination
      itemsPerPage: 8, // Number of items per page
    };
  },
  computed: {
    // Filtered fines based on search query
    filteredFines() {
      return this.fines.filter(fine => {
        const searchLower = this.searchQuery.toLowerCase();
        return (
          fine.userName.toLowerCase().includes(searchLower) ||
          fine.bookTitle.toLowerCase().includes(searchLower)
        );
      });
    },
    // Paginated fines based on current page
    paginatedFines() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredFines.slice(start, end);
    },
    // Total pages for pagination
    totalPages() {
      return Math.ceil(this.filteredFines.length / this.itemsPerPage);
    },
  },
  mounted() {
    this.fetchBooks(); // Fetch all books when the component is mounted
    this.fetchUsers(); // Fetch all users when the component is mounted
    this.fetchTransactions(); // Fetch all transactions when the component is mounted
    this.fetchFines(); // Fetch all fines when the component is mounted
  },
  methods: {
    // Fetch all books
    async fetchBooks() {
      this.loading = true;
      try {
        const response = await api.get("/book");
        if (response.data && Array.isArray(response.data)) {
          this.books = response.data
            .map((item) => {
              const category = item.data.kategori ? item.data.kategori.data : null;
              return {
                ...item.data,
                kategori: category ? category.nama_kategori : "Unknown",
              };
            })
            .sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at)); // Sort descending by updated_at
        } else {
          throw new Error("Data buku tidak ditemukan");
        }
      } catch (err) {
        console.error("Error fetching books:", err);
        this.errorMessage = "Failed to load books.";
      } finally {
        this.loading = false;
      }
    },

    // Fetch all users
    async fetchUsers() {
      this.loading = true;
      try {
        const response = await api.get("/user");
        if (response.data && Array.isArray(response.data.data)) {
          this.users = response.data.data; // Map the users data
        } else {
          throw new Error("Data users tidak ditemukan");
        }
      } catch (err) {
        console.error("Error fetching users:", err);
        this.errorMessage = "Failed to load users.";
      } finally {
        this.loading = false;
      }
    },

    // Fetch all transactions
    async fetchTransactions() {
      this.loading = true;
      try {
        const response = await api.get("/transaction");
        if (response.data && Array.isArray(response.data.data)) {
          this.transactions = response.data.data; // Store the transactions data
        } else {
          throw new Error("Data transactions tidak ditemukan");
        }
      } catch (err) {
        console.error("Error fetching transactions:", err);
        this.errorMessage = "Failed to load transactions.";
      } finally {
        this.loading = false;
      }
    },

    // Fetch all fines and map user and book data based on transactions
    async fetchFines() {
      this.loading = true;
      try {
        const response = await api.get("/fine");
        if (response.data && Array.isArray(response.data.data)) {
          this.fines = response.data.data.map((fine) => {
            // Find the transaction that corresponds to this fine
            const transaction = this.transactions.find(transaction => transaction.id_transaksi === fine.id_transaksi);
            const user = this.users.find(user => user.id_user === transaction?.id_user);
            const book = this.books.find(book => book.id_buku === transaction?.id_buku);
            
            return {
              ...fine,
              userName: user ? user.nama : "Unknown User", // Add user name
              bookTitle: book ? book.judul : "Unknown Book", // Add book title
              id_user: transaction?.id_user, // Add user_id from transaction
              id_buku: transaction?.id_buku, // Add book_id from transaction
            };
          });
          this.successMessage = "Fines loaded successfully.";
        } else {
          throw new Error("No fines found.");
        }
      } catch (error) {
        console.error("Error fetching fines:", error);
        this.errorMessage = "Failed to load fines.";
      } finally {
        this.loading = false;
      }
    },

    // Handle the action of editing a fine
    editFine(fineId) {
      this.$router.push({ name: "EditFine", params: { id: fineId } });
    },

    // Handle the action of deleting a fine
    async deleteFine(fineId) {
      if (confirm("Are you sure you want to delete this fine?")) {
        try {
          await api.delete(`/fine/${fineId}`);
          this.successMessage = "Fine deleted successfully.";
          this.fetchFines(); // Reload fines after deletion
        } catch (error) {
          console.error("Error deleting fine:", error);
          this.errorMessage = "Failed to delete fine.";
        }
      }
    },

    // Handle the action of adding a fine
    addFine() {
      this.$router.push({ name: "AddFineAdmin" });
    },

    // Go back to the previous page
    goBack() {
      this.$router.go(-1);
    },

    // Change the page for pagination
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
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

button {
  margin-top: 20px;
}
</style>
