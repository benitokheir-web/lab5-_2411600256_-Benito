# Lab5_2411600256_Benito - Hardware Inventory Management System

Laravel MVC Inventory Management System for the Laboratory Exercise 5.

## Requirements
- XAMPP (Apache + MySQL)
- PHP 8.2+
- Composer
- Node.js + npm
- VS Code
- Browser

## Setup

1. Extract this folder to:
   `C:\xampp\htdocs\`

2. Open the folder in VS Code.

3. Open Terminal and run:
```bash
composer install
copy .env.example .env
php artisan key:generate
```

4. Create a MySQL database named:
`hardware_inventory`

5. Edit `.env` if your MySQL settings are different.

6. Run:
```bash
php artisan migrate:fresh --seed
```

7. Start the Laravel server:
```bash
php artisan serve
```

8. Open:
`http://127.0.0.1:8000`

## Login
Use the seeded account:
- Email: admin@example.com
- Password: password

## Main Features
- Login/logout
- Dashboard with real database statistics
- Product CRUD
- Low-stock and out-of-stock status
- Stock In
- Stock Out
- Inventory transaction history
- Reports
- MySQL persistence through Eloquent
- Lab 4 green color theme

## Important
The `vendor/` folder is intentionally not included. Run `composer install` once after opening the project.
