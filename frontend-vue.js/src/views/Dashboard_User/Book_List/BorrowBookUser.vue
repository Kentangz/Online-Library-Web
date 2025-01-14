<template>
  <div class="container py-5">
    <h2 class="text-center mb-4">Borrow Book</h2>

    <!-- Book Details -->
    <div class="row mb-4 body-center" v-if="book">
    <div class="col-md-4 mx-auto">
        <div class="card shadow-lg border-0 rounded-3 book-card">
          <img
            :src="book.image"
            alt="Book Cover"
            class="card-img-top book-image rounded-top"
          />
          <div class="card-body text-center">
            <h5 class="card-title text-primary">{{ book.judul }}</h5>
            <p class="card-text text-muted">
              <strong>Author:</strong> {{ book.penulis }} <br />
              <strong>Publisher:</strong> {{ book.penerbit }} <br />
              <strong>Category:</strong> {{ book.kategori.data.nama_kategori }}<br />
              <strong>Stock:</strong> {{ book.stok }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Error or Success Message -->
    <div v-if="errorMessage" class="alert alert-danger mt-4">
      <strong>Error:</strong> {{ errorMessage }}
    </div>
    <div v-if="successMessage" class="alert alert-success mt-4">
      <strong>Success:</strong> {{ successMessage }}
    </div>

    <!-- Borrow Form -->
    <div v-if="book" class="row justify-content-center">
      <div class="col-md-6">
        <form @submit.prevent="borrowBook">
          <div class="form-group mb-4">
            <label for="borrowDate" class="fw-semibold">Borrow Date</label>
            <input
              type="date"
              id="borrowDate"
              class="form-control shadow-sm"
              v-model="borrowDate"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary w-100 shadow-sm py-2" :disabled="isBorrowing">
            <span v-if="isBorrowing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            {{ isBorrowing ? 'Processing...' : 'Borrow Book' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../../../api";

export default {
  name: "BorrowBookUser",
  data() {
    return {
      book: null, // Book details fetched from the API
      borrowDate: "", // The date when the book will be borrowed
      isBorrowing: false, // To disable the borrow button while processing
      errorMessage: "", // To show error messages
      successMessage: "", // To show success messages
    };
  },
  mounted() {
    console.log("User ID at mounted:", localStorage.getItem("user_id")); // Debugging log
    this.fetchBookDetails();
  },
  methods: {
    // Fetch book details from the API using the book ID
    async fetchBookDetails() {
      const bookId = this.$route.params.id; // Get the book ID from the route
      try {
        const response = await api.get(`/book/${bookId}`);
        console.log("API Response:", response); // Log the entire response

        if (response && response.data && response.data.data) {
          this.book = response.data.data; // Assign book details
        } else {
          throw new Error("Invalid response structure or data not found");
        }
      } catch (error) {
        console.error("Error fetching book details:", error);
        this.errorMessage = "Failed to load book details";
      }
    },

    // Handle borrowing book
    async borrowBook() {
      if (!this.borrowDate) {
        this.errorMessage = "Please select a borrow date.";
        return;
      }

      this.isBorrowing = true;
      const bookId = this.$route.params.id;

      // Ambil ID pengguna dari localStorage (atau bisa dari parameter route jika ada)
      const userId = localStorage.getItem("user_id");
      console.log("User ID from localStorage:", userId); // Debugging log

      if (!userId) {
        this.errorMessage = "User not logged in. Please login first.";
        this.isBorrowing = false;
        return;
      }

      if (this.book.stok <= 0) {
        this.errorMessage = "Sorry, this book is out of stock.";
        this.isBorrowing = false;
        return;
      }

      try {
        // Send the transaction to the API
        const response = await api.post("/transaction", {
          id_user: userId,
          id_buku: bookId,
          tanggal_pinjam: this.borrowDate,
          status: "dipinjam", // Set status to "dipinjam" by default
        });

        // Handle successful borrow
        this.successMessage = "Book successfully borrowed!";
        this.errorMessage = "";
      } catch (error) {
        console.error("Error borrowing book:", error);
        this.errorMessage = "Failed to borrow the book. Please try again.";
        this.successMessage = "";
      } finally {
        this.isBorrowing = false;
      }
    },
  },
};
</script>

<style scoped>
.book-image {
  height: 350px;
  width: 100%;
  object-fit: cover;
  border-top-left-radius: 16px;
  border-top-right-radius: 16px;
}

.card {
  border-radius: 16px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.card-body {
  padding: 20px;
  text-align: center;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
}

.card-text {
  font-size: 1rem;
  line-height: 1.5;
}

.card-text strong {
  color: #333;
}

.btn {
  background-color: #007bff;
  border-color: #007bff;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}

.alert {
  text-align: center;
}

.form-control {
  border-radius: 8px;
}

.shadow-sm {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.text-muted {
  color: #6c757d;
}

.fw-semibold {
  font-weight: 600;
}
</style>
