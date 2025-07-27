# Post Management Platform ( Task ) - Setup and Documentation

This is a web application built with a **Laravel** backend and a **Vue.js** frontend, bundled using **Vite**. This document provides all the necessary instructions to get the project up and running on a local development machine.

## Table of Contents
1.  [Prerequisites](#prerequisites)
2.  [Installation & Setup](#installation--setup)
3.  [Running the Application](#running-the-application)
4.  [API Collection (Postman)](#api-collection-postman)
5.  [Default Login Credentials](#default-login-credentials)

---

## Prerequisites

Before you begin, ensure you have the following software installed on your system:

-   **PHP** (>= 8.1)
-   **Composer** (PHP Package Manager)
-   **Node.js** (>= 16) & **npm**
-   **A database server** (e.g., MySQL, MariaDB, PostgreSQL)
-   **Git**

---

## Installation & Setup

Follow these steps in order to set up your local development environment.

### 1. Clone the Repository

First, clone the project repository to your local machine:

```bash
git clone https://github.com/dev-mohamed-ayman/post-management-platform.git
cd post-management-platform
```

### 2. Backend Setup (Laravel)

a. **Install PHP Dependencies:** Use Composer to install the required packages.

```bash
composer install
```

b. **Create Environment File (`.env`):** Copy the example environment file. This file will hold your local configuration.

```bash
cp .env.example .env
```

c. **Generate Application Key:** This key is used for session security and data encryption.

```bash
php artisan key:generate
```

d. **Configure Database:**
- Open the `.env` file you just created.
- Update the `DB_*` variables to match your local database credentials. For example (MySQL):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

- Make sure you have created a database with the name you specified in `DB_DATABASE`.

e. **Run Migrations and Seeders:**
- **Migrations** create the database tables.
- **Seeders** populate the tables with initial data, including the default users for testing.

Run the following command to execute both:

   ```bash
   php artisan migrate --seed
   ```

### 3. Frontend Setup (Vue & Vite)

a. **Install JavaScript Dependencies:** Navigate to the project root and run npm to install all required packages for the frontend.

```bash
npm install
```

---

## Running the Application

To run the project, you will need **two separate terminal windows**: one for the Vite development server and one for the Laravel backend server.

### 🖥️ Terminal 1: Run the Vite Dev Server

This server handles the frontend assets and provides Hot Module Replacement (HMR) for a fast development experience.

```bash
npm run dev
```

### ⚙️ Terminal 2: Run the Laravel Server

This server handles all API requests and backend logic.

```bash
php artisan serve
```

### 🚀 Accessing the App

Once both servers are running, you can access the application by navigating to the URL provided by the `php artisan serve` command (usually):

**http://127.0.0.1:8000**

---

## API Collection (Postman)

To make API testing easier, a Postman collection is included in the project root.

**File Location:** `Post Management Platform (Task).postman_collection.json`
*(**Note**: Make sure you add your exported Postman file with this name to the project's root directory).*

### How to Use:
1.  **Import:** Open Postman, click on `Import`, and select the `Post Management Platform (Task).postman_collection.json` file from the project directory.
2.  **Configure Environment:** For best results, create a new Postman Environment and add a variable:
    -   **Variable:** `url`
    -   **Value:** `http://127.0.0.1:8000/api/`
    -   **Variable:** `token`
3.  Now you can use the imported collection to test all the API endpoints like login, register, posts, etc.

---

## Default Login Credentials

The database seeder (`db:seed` command) creates a set of default users to help you test the application immediately. You can log in with the following credentials on the login page:

| Role        | Email            | Password  |
|-------------|------------------|-----------|
| **Admin**   | `admin@demo.com` | `demo123`|
| **User**    | `user@demo.com`  | `demo123`|

