# Online Library Web Project

This project is created for educational purposes. Feel free to explore, modify, and use it as you wish!

## How to Use:

### 1. Recommended Environment:
We recommend using **Laragon** as your local development environment.

### 2. Clone the Repository:
```bash
git clone https://github.com/Kentangz/Online-Library-Web.git
```

### 3. Database Setup:
- Create a new database manually with the name `online_library`.
- Import the `online_library.sql` file.
  - Make sure the collation is set to **utf8mb4_0900_ai_ci**.

### 4. Backend Setup (Laravel):
1. Navigate to the backend directory:
   ```bash
   cd /backend-Laravel
   ```
2. Create a `.env` file by duplicating `.env.example`:
   ```bash
   cp .env.example .env
   ```
3. Update the database configuration in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=online_library
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Install Laravel dependencies:
   ```bash
   composer install
   ```
5. Link storage:
   ```bash
   php artisan storage:link
   ```
6. Start the Laravel server:
   ```bash
   php artisan serve
   ```

### 5. Frontend Setup (Vue.js):
1. Navigate to the frontend directory:
   ```bash
   cd /frontend-vue.js
   ```
2. Install npm dependencies:
   ```bash
   npm install
   ```
3. Install Bootstrap:
   ```bash
   npm install bootstrap
   ```
4. Start the development server:
   ```bash
   npm run dev
   ```

## Demo Accounts:

### Admin Account (can only create accounts via API):
- **Email:** akuadminaseli@gmail.com  
- **Password:** admin123

### User Account (can sign up):
- **Email:** bintangril@gmail.com  
- **Password:** bintangpp

## Need Help?
If you encounter any issues or have questions, feel free to ask!

Happy coding, and we hope this project helps you learn something new. :)

---
Thank you for using this project!

