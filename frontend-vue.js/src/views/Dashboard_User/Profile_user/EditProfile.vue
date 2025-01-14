<template>
    <div class="container">
      <div class="card shadow-lg rounded-lg">
        <div class="card-body">
          <h3 class="text-center mb-4">Edit Profile</h3>
  
          <!-- Profile Picture Section -->
          <div class="profile-picture-container text-center mb-4">
            <img
              v-if="user.image"
              :src="user.image"
              alt="User Profile"
              class="profile-img"
            />
            <p v-else class="text-muted">No Profile Picture</p>
            <div class="mt-3">
              <input
                type="file"
                @change="handleFileUpload"
                class="form-control-file"
                accept="image/*"
              />
            </div>
          </div>
  
          <!-- Profile Form -->
          <form @submit.prevent="updateProfile">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                type="text"
                id="name"
                v-model="user.nama"
                class="form-control"
                required
              />
            </div>
  
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                id="email"
                v-model="user.email"
                class="form-control"
                required
              />
            </div>
  
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input
                type="text"
                id="phone"
                v-model="user.nomor_hp"
                class="form-control"
                required
              />
            </div>
  
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea
                id="address"
                v-model="user.alamat"
                class="form-control"
              ></textarea>
            </div>
  
            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" @click="cancel">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary">
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import api from '../../../api'; // Import API instance
  
  export default {
    name: 'EditProfileUser',
    data() {
      return {
        user: {
          id_user: null,
          nama: '',
          email: '',
          nomor_hp: '',
          alamat: '',
          image: null // URL gambar profil atau null
        },
        selectedFile: null // File yang dipilih untuk diunggah
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
  
          const response = await api.get(`/user/${userId}`);
          const { data } = response.data;
          this.user = {
            ...data,
            image: data.image ? `${data.image}` : null
          };
        } catch (error) {
          console.error('Error fetching user profile:', error);
          this.$router.push('/sign-in');
        }
      },
      handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
          this.selectedFile = file;
          this.user.image = URL.createObjectURL(file); // Preview gambar
        }
      },
      async updateProfile() {
        try {
          const userId = localStorage.getItem('user_id');
          if (!userId) {
            console.error('User ID not found');
            return;
          }
  
          const formData = new FormData();
          formData.append('_method', 'PUT'); // Laravel expects _method for PUT requests
          formData.append('nama', this.user.nama);
          formData.append('email', this.user.email);
          formData.append('nomor_hp', this.user.nomor_hp);
          formData.append('alamat', this.user.alamat);
  
          // Tambahkan file jika ada
          if (this.selectedFile) {
            formData.append('image', this.selectedFile);
          }
  
          await api.post(`/user/${userId}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
          });
  
          alert('Profile updated successfully');
          this.$router.push('/user-dashboard');
        } catch (error) {
          console.error('Error updating profile:', error);
          alert('Failed to update profile');
        }
      },
      cancel() {
        this.$router.push('/user-dashboard'); // Kembali ke halaman profil tanpa menyimpan
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    padding: 30px;
    background-color: #f8f9fa;
  }
  
  .card {
    width: 100%;
    max-width: 600px;
    margin: auto;
    border-radius: 16px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .card-body {
    padding: 20px;
  }
  
  h3 {
    font-size: 1.75rem;
  }
  
  .profile-picture-container {
    text-align: center;
  }
  
  .profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #007bff;
  }
  
  .form-label {
    font-weight: bold;
  }
  
  .form-control {
    border-radius: 8px;
  }
  
  button {
    border-radius: 30px;
    padding: 10px 20px;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>
  