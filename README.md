
---

# 📚 Online Library Web Project

This project is intended for educational purposes. Feel free to use it and explore!

## 🚀 How to Use

### Prerequisites

- **Recommended**: Use [Laragon](https://laragon.org/)
- Ensure you have Git, Composer, PHP, and Node.js installed

### Steps to Set Up the Project

1. Clone the repository:  
   ```bash
   git clone https://github.com/Kentangz/Online-Library-Web.git
   ```

2. Create a database manually:  
   **Database name**: `online_library`

3. Import the provided SQL file:  
   `online_library.sql`  
   *(Make sure the collation is set to `utf8mb4_0900_ai_ci`)*

---

### Backend Setup (Laravel)

1. Navigate to the backend directory:  
   ```bash
   cd /backend-Laravel
   ```

2. Create a `.env` file by duplicating `.env.example`, then update the following lines:
   ```env
   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=online_library  
   DB_USERNAME=root  
   DB_PASSWORD=
   ```

3. Install dependencies:  
   ```bash
   composer install
   ```

4. Link storage:  
   ```bash
   php artisan storage:link
   ```

5. Start the server:  
   ```bash
   php artisan serve
   ```

---

### Frontend Setup (Vue.js)

1. Navigate to the frontend directory:  
   ```bash
   cd /frontend-vue.js
   ```

---

## 🧑‍💻 Admin & User Accounts

- **Admin Account** (only creatable via API):  
  - **Email**: `akuadminaseli@gmail.com`  
  - **Password**: `admin123`

- **User Account** (can sign up manually):  
  - **Email**: `bintangril@gmail.com`  
  - **Password**: `bintangpp`

---

## 🙌 Support

That’s all! I hope this helps you set up the project smoothly. Feel free to ask if you have any questions. 😊

---
