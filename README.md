# 🛠️ Micro CRM — Product and Order Management System

This project was developed as part of a **technical test**.  
It is a system for managing products, warehouses, orders, and stock movements, built with Laravel.
![Dashboard Screenshot](microcrm.png)
---

## 🚀 Technologies Used

- PHP 8.3.17
- Laravel 12.2
- MySQL
- Bootstrap 5
- Blade
- REST API
- Artisan commands

---

## 📦 Implemented Features

### ✅ Part 1: Basic Management
- CRUD for products
- CRUD for warehouses
- Stock management by warehouse
- Create and update orders (including canceling and completing)
- Automatic stock updates

### ✅ Part 2: Movement History
- `movements` table to track stock changes
- Record every movement (creation, update, order, cancellation, etc.)
- Web interface with filters: by warehouse, product, date
- REST API: `/api/movements` with support for filtering and pagination

### ✅ Part 3: Test Data
- Console command:
- php artisan seed:test-data

Will automatically create:

- ✅ 10 warehouses  
- ✅ 50 products  
- ✅ Over 1000 stock records  
- ✅ Product movement history


## 🔗 API Endpoint

**GET** `/api/movements`

Allows fetching a list of product movements with support for filters and pagination.

### Request Parameters:

- `product_id` — Product ID (optional)
- `warehouse_id` — Warehouse ID (optional)
- `from` — Start date (format YYYY-MM-DD)
- `to` — End date (format YYYY-MM-DD)
- `per_page` — Number of records per page (default 15)

### 📌 Example Request:

**GET /api/movements?product_id=5&warehouse_id=2&from=2024-01-01&to=2024-12-31&per_page=5**


# ⚙️ Project Setup
- git clone https://github.com/hallame/microcrm.git
- cd microcrm
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan migrate:fresh --seed
- php artisan serve


## 👤 Author
**Hormise ALLAME**
- Full Stack Developer
- Telegram: @hormise
- Website: [OMIZIX.COM](https://omizix.com)
