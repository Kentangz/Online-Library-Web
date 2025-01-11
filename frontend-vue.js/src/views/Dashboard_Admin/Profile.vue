<template>
  <div class="profile-container">
    <div class="card shadow-lg rounded-lg profile-card">
      <div class="card-body d-flex align-items-center">
        <!-- Profile Image (on the left) -->
        <div class="profile-img-container me-4">
          <img
            v-if="admin.image_url"
            :src="admin.image_url"
            alt="Admin Image"
            class="img-thumbnail profile-img shadow-sm"
          />
          <p v-else>No Image</p>
        </div>

        <!-- Profile Details (on the right) -->
        <div class="profile-details">
          <h3 class="mb-3">Admin Profile</h3>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <strong>ID:</strong> {{ admin.id }}
            </li>
            <li class="list-group-item">
              <strong>Name:</strong> {{ admin.nama }}
            </li>
            <li class="list-group-item">
              <strong>Email:</strong> {{ admin.email }}
            </li>
          </ul>
        </div>
      </div>
      <!-- Logout Button (placed at the bottom right) -->
      <div class="logout-container">
        <button class="btn btn-danger shadow-sm" @click="logout">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import Api from '../../api'; // Import API service

export default {
  name: 'Profile',
  data() {
    return {
      admin: {} // Data admin akan diisi dari API
    };
  },
  mounted() {
    this.fetchAdminProfile();
  },
  methods: {
    async fetchAdminProfile() {
      try {
        const adminId = localStorage.getItem('admin_id');
        if (!adminId) {
          console.error('Admin ID not found');
          this.$router.push('/sign-in');
          return;
        }
        const response = await Api.get(`/admin/${adminId}`);
        this.admin = response.data.data;
      } catch (error) {
        console.error('Error fetching admin profile:', error);
        this.$router.push('/sign-in');
      }
    },
    logout() {
      localStorage.removeItem('admin_id');
      this.$router.push('/sign-in');
    }
  }
};
</script>

<style scoped>
.profile-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f7f7f7;
  padding: 0;
  width: 100%;
}

.card {
  width: 100%;
  max-width: 10000px; /* Membuat card lebih lebar agar pas dengan kotak dashboard */
  border-radius: 16px;
  cursor: pointer; /* Menambah efek pointer untuk menunjukkan bisa diklik */
  transition: box-shadow 0.3s ease; /* Menghilangkan efek transform, hanya shadow yang berubah */
}

.profile-card {
  background-color: #ffffff;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
  display: flex;
  align-items: center;
  padding: 1.5rem; /* Mengurangi padding agar lebih ringkas */
}

.profile-img-container {
  flex-shrink: 0;
  text-align: center;
}

.profile-img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.profile-details {
  flex-grow: 1;
}

h3 {
  font-size: 1.75rem;
  color: #333;
  font-weight: bold;
}

.list-group {
  margin-top: 1rem;
}

.list-group-item {
  border: none;
  font-size: 1.1rem;
}

/* Styling for the logout button positioned at the bottom right */
.logout-container {
  position: absolute;
  bottom: 20px;
  right: 20px;
}

button {
  width: 150px;
  border-radius: 30px;
  padding: 10px;
  font-weight: bold;
}

button:hover {
  background-color: #e74c3c;
}

/* Efek shadow saat hover tanpa transform */
.card:hover {
  box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1); /* Menambahkan efek shadow lebih besar saat hover */
}

@media (max-width: 768px) {
  .card {
    max-width: 100%;
  }

  .profile-img {
    width: 120px;
    height: 120px;
  }

  h3 {
    font-size: 1.5rem;
  }

  .list-group-item {
    font-size: 1rem;
  }
}
</style>
