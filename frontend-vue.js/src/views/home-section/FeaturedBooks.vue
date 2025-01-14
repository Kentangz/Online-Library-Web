<template>
  <section class="featured-books py-5 parallax-bg">
    <div class="container">
      <h2 class="section-title text-center mb-4">Featured Books</h2>
      <div class="row justify-content-center">
        <div v-for="book in featuredBooks" :key="book.id_buku" class="col-md-3 mb-4">
          <div class="card h-1000 shadow-sm  book-card">
            <div class="card-img-wrapper">
              <img :src="book.image" :alt="book.judul" class="card-img-top book-cover" />
            </div>
            <div class="card-body text-center">
              <h5 class="card-title">{{ book.judul }}</h5>
              <p class="card-text text-muted">by {{ book.penulis }}</p>
              <span class="badge">{{ book.kategori.data.nama_kategori }}</span>
              <button class="btn btn-outline-primary mt-3 view-book-btn" @click="goToDetail(book.id_buku)">
                View Book
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import api from "../../api";

export default {
  name: "FeaturedBooks",
  data() {
    return {
      featuredBooks: [],
    };
  },
  methods: {
    async fetchFeaturedBooks() {
      try {
        const response = await api.get("/book");

        if (response.data && Array.isArray(response.data)) {
          const books = response.data.map((item) => item.data);
          const filteredBooks = books.filter((book) => [1, 7, 11].includes(book.id_buku));
          this.featuredBooks = filteredBooks;
        }
      } catch (error) {
        console.error("Error fetching featured books:", error);
      }
    },
    goToDetail(bookId) {
      this.$router.push(`/book-list/detail-book/${bookId}`);
    },
  },
  mounted() {
    this.fetchFeaturedBooks();
  },
};
</script>

<style scoped>
.parallax-bg {
  background-image: url('src/assets/home/featured_section.png');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  background-repeat: no-repeat;
  position: relative;
  border-radius: 20%;
  z-index: 0;
}

.featured-books {
  background-color: rgba(248, 249, 250, 0.9);
  padding-top: 4rem;
  padding-bottom: 4rem;
  position: relative;
  z-index: 1;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 2rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  -webkit-text-stroke: 1px #ffffff;
}

.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 15px;
  overflow: hidden;
  border: 4px solid #026300;
  position: relative;
}

.card:hover {
  transform: translateY(-12px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
  border-color: #007bff;
}

.card-img-wrapper {
  overflow: hidden;
  height: 380px;
  position: relative;
  border-bottom: 4px solid rgb(221, 221, 221);
}

.card-img-top {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
  border-radius: 8px;
  border: 4px solid #ff0000;
}

.card-img-wrapper:hover .card-img-top {
  transform: scale(1.1);
}

.card-body {
  padding: 1.5rem;
  background-color: #fff;
  position: relative;
  z-index: 1;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-top: 1rem;
  color: #333;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.card-text {
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
  color: #6c757d;
}

.badge {
  font-size: 0.9rem;
  padding: 0.5rem;
  background-color: #9a9494;
  color: #fff;
  text-transform: uppercase;
  border-radius: 25px;
}

.view-book-btn {
  font-size: 1rem;
  padding: 0.6rem 1.8rem;
  border-radius: 50px;
  background-color: transparent;
  color: #3d8de3;
  border: 2px solid #007bff;
  transition: all 0.3s ease;
  text-transform: uppercase;
}

.view-book-btn:hover {
  background-color: #007bff;
  color: #fff;
  border-color: #000000;
  box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
}

.card-body:hover .view-book-btn {
  transform: scale(1.1);
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }

  .card-img-wrapper {
    height: 250px;
  }

  .card-title {
    font-size: 1.1rem;
  }

  .card-body {
    padding: 1rem;
  }

  .view-book-btn {
    padding: 0.5rem 1.5rem;
  }
}
</style>
