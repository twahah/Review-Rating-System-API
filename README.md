#  Review & Rating System API

A **Laravel-based REST API** for managing **categories, gigs, reviews, and ratings**, complete with **authentication**, **filtering**, and **database seeding**.
Perfect for marketplaces, gig platforms, and service-based applications.

---

## 🚀 Features

* 🗂 **Category Management** (CRUD)
* 🎭 **Gig Management** (CRUD + filtering)
* ⭐ **Review & Rating System**
* 🔐 **User Authentication** (Laravel Sanctum)
* 🎛 **API Resources & Validation**
* 🌱 **Database Seeder** (sample data)

---

## 📋 Requirements

* PHP **8.1+**
* Laravel **10+**
* Composer
* MySQL / PostgreSQL / SQLite

---

## 🛠 Installation

### **1. Clone the repository**

```bash
git clone <repository-url>
cd review-rating-api
```

### **2. Install dependencies**

```bash
composer install
```

### **3. Configure environment**

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=review_rating_api
DB_USERNAME=root
DB_PASSWORD=
```

### **4. Migrate & seed database**

```bash
php artisan migrate --seed
```

### **5. Publish Sanctum configuration**

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

---

## 🔑 Authentication

This API uses **Laravel Sanctum**.

Include your token in protected requests:

```
Authorization: Bearer YOUR_TOKEN_HERE
```

---

## 📡 API Endpoints

### **Public Endpoints**

| Method | Endpoint               | Description                        |
| ------ | ---------------------- | ---------------------------------- |
| GET    | `/api/categories`      | List all categories                |
| GET    | `/api/categories/{id}` | Get category details               |
| GET    | `/api/gigs`            | List all gigs (supports filtering) |
| GET    | `/api/gigs/{id}`       | Get gig details                    |

---

### **Protected Endpoints**

📌 *Require Bearer Token*

#### **Gigs**

| Method | Endpoint         | Description  |
| ------ | ---------------- | ------------ |
| POST   | `/api/gigs`      | Create a gig |
| PUT    | `/api/gigs/{id}` | Update a gig |
| DELETE | `/api/gigs/{id}` | Delete a gig |

#### **Reviews**

| Method | Endpoint                  | Description           |
| ------ | ------------------------- | --------------------- |
| GET    | `/api/gigs/{gig}/reviews` | Get reviews for a gig |
| POST   | `/api/gigs/{gig}/reviews` | Create a review       |
| PUT    | `/api/reviews/{id}`       | Update a review       |
| DELETE | `/api/reviews/{id}`       | Delete a review       |

---

## 🎛 Gig Query Parameters

| Parameter     | Description                             |
| ------------- | --------------------------------------- |
| `category_id` | Filter by category                      |
| `seller_id`   | Filter by seller                        |
| `search`      | Search by title                         |
| `active_only` | Show only active gigs (default: `true`) |

---

## 🗄 Database Schema

### **categories**

* id
* name
* slug
* description
* timestamps

### **gigs**

* id
* title
* slug
* description
* price
* category_id
* seller_id
* is_active
* timestamps

### **reviews**

* id
* comment
* rating
* gig_id
* user_id
* timestamps

---

## 🌱 Database Seeding

The seeder generates:

* 5 categories
* 10 sellers
* 20 buyers
* 50 gigs
* Random reviews

Run again anytime:

```bash
php artisan migrate --seed
```
---

## 📄 License

This project is licensed under the **MIT License**.


