<template>
  <div class="profile-container">
    <div class="card shadow-lg rounded-lg profile-card">
      <div class="card-body d-flex align-items-center">
        <!-- Profile Image (on the left) -->
        <div class="profile-img-container me-4">
          <img
            v-if="user.image"
            :src="user.image"
            alt="User Image"
            class="img-thumbnail profile-img shadow-sm"
          />
          <p v-else>No Image</p>
        </div>

        <!-- Profile Details (on the right) -->
        <div class="profile-details">
          <h3 class="mb-3">{{ user.nama }}</h3>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <strong>Email:</strong> {{ user.email }}
            </li>
            <li class="list-group-item">
              <strong>Phone:</strong> {{ user.nomor_hp }}
            </li>
            <li class="list-group-item">
              <strong>Address:</strong> {{ user.alamat || 'No address provided' }}
            </li>
          </ul>
        </div>
      </div>

      <!-- Edit Profile Button (placed at the top) -->
      <div class="edit-profile-container">
        <button class="btn btn-primary shadow-sm" @click="editProfile">Edit Profile</button>
      </div>

      <!-- Logout Button (placed at the bottom right) -->
      <div class="logout-container">
        <button class="btn btn-danger shadow-sm" @click="logout">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import Api from '../../../api'; // Import API service

export default {
  name: 'Profile',
  data() {
    return {
      user: {} // Data user akan diisi dari API
    };
  },
  mounted() {
    this.fetchUserProfile();
  },
  methods: {
  async fetchUserProfile() {
    try {
      const userId = localStorage.getItem('user_id');
      if (!userId) {
        console.error('User ID not found');
        this.$router.push('/sign-in');
        return;
      }
      const response = await Api.get(`/user/${userId}`); // API endpoint untuk mengambil data user
      this.user = response.data.data;
    } catch (error) {
      console.error('Error fetching user profile:', error);
      this.$router.push('/sign-in');
    }
  },
  logout() {
    localStorage.removeItem('user_id');
    this.$router.push('/sign-in');
  },
  editProfile() {
    // Navigasi ke halaman edit profile dengan menyertakan id pengguna
    this.$router.push(`/user-dashboard/edit-profile/${this.user.id}`);
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
  max-width: 10000px;
  border-radius: 16px;
  cursor: pointer;
  transition: box-shadow 0.3s ease;
}

.profile-card {
  background-color: #ffffff;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
  display: flex;
  align-items: center;
  padding: 1.5rem;
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

.card:hover {
  box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
}

.edit-profile-container {
  position: absolute;
  top: 20px;
  right: 20px;
}

.edit-profile-container button {
  width: 150px;
  background-color: #007bff;
  color: white;
  font-weight: bold;
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
