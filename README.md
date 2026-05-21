# 📦 Order Tracking & Delivery Updates Portal

A full-stack real-time order tracking and delivery management system built with **Laravel 12**, **MongoDB**, and **Bootstrap 5**. The platform enables customers to track their shipments, admins to manage the entire delivery network, and delivery agents to update order statuses in real-time.

---

## 🚀 Features

### 🔐 Authentication & Role-Based Access
- Secure registration and login system using Laravel Auth.
- Three user roles: **Customer**, **Admin**, and **Delivery Agent**.
- Customers can apply to become delivery agents from their dashboard.
- Admins can approve or revoke agent roles.

### 👤 Customer Dashboard
- View all personal orders with product images and delivery progress trackers.
- **Real-time search bar** — filters order cards instantly as you type.
- **Status dropdown filter** — filter orders by Packed, Shipped, Out for Delivery, or Delivered.
- Click any order to view a detailed tracking page with live status updates and a visual timeline.

### 🛡️ Admin Dashboard
- **Overview Stats Cards** — Total Shipments, Active Drivers, Delivered count, and Pending Approvals with week-over-week growth percentages calculated from real database data.
- **Pending Driver Approvals** — Approve or reject customer applications to become delivery agents.
- **Active Shipments Table** — View, create, assign drivers, and delete shipments.
- **Active Drivers List** — See all approved drivers with the option to revoke access.
- **Recent Support Messages** — View messages submitted via the Contact page, with a "Resolve" button to mark them as handled.
- **All Shipments Page** — Dedicated page with real-time search and status filters, plus pagination.

### 🚚 Delivery Agent Dashboard
- View all assigned orders.
- Update order status step-by-step (Packed → Shipped → Out for Delivery → Delivered).
- Each status update is logged with a timestamp for the customer to see.

### 📄 Public Pages
- **Landing Page (Welcome)** — Modern hero section, feature highlights, stats, and call-to-action.
- **About Page** — Company information and mission.
- **Contact Page** — Functional contact form that stores messages in MongoDB and shows them on the admin dashboard.
- **Privacy Policy, Terms of Service, Cookie Policy** — Legal pages.
- **Services, Fleet, Solutions** — Informational pages about the platform.

### ✨ UI/UX Highlights
- Fully responsive design using **Bootstrap 5**.
- Grayscale, black & white color theme (no generic blue/red).
- Smooth hover animations and micro-interactions.
- Reusable footer partial across all public pages.
- Premium card-based layouts with shadow effects.
- Emoji-enhanced status dropdowns.

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 12 (PHP 8.2+) |
| **Database** | MongoDB (via `mongodb/laravel-mongodb`) |
| **Frontend** | Blade Templates + Bootstrap 5 |
| **Build Tool** | Vite |
| **Icons** | Font Awesome 6 |
| **Auth** | Laravel UI (Bootstrap scaffolding) |

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Admin dashboard, approvals, shipments, messages
│   │   ├── AgentController.php      # Agent dashboard, status updates
│   │   ├── TrackingController.php   # Customer orders, tracking, search & filter
│   │   ├── OrderController.php      # CRUD for orders/shipments
│   │   └── HomeController.php       # Role-based redirect after login
│   ├── Models/
│   │   ├── User.php                 # User model with roles (customer/admin/agent)
│   │   ├── Order.php                # Order/Shipment model
│   │   ├── OrderUpdate.php          # Status update history model
│   │   └── ContactMessage.php       # Contact form submissions
│   └── Http/Middleware/
│       └── RoleMiddleware.php       # Role-based route protection
├── resources/views/
│   ├── admin/
│   │   ├── dashboard.blade.php      # Admin main dashboard
│   │   └── shipments.blade.php      # All shipments page
│   ├── agent/
│   │   └── dashboard.blade.php      # Agent dashboard
│   ├── customer/
│   │   ├── orders.blade.php         # Customer orders dashboard
│   │   └── tracking.blade.php       # Order tracking detail page
│   ├── auth/                        # Login & Register views
│   ├── layouts/app.blade.php        # Main layout
│   ├── partials/footer.blade.php    # Reusable footer
│   ├── welcome.blade.php            # Landing page
│   ├── about.blade.php              # About page
│   ├── contact.blade.php            # Contact page
│   ├── privacy.blade.php            # Privacy Policy
│   └── ...                          # Other public pages
├── routes/web.php                   # All application routes
└── public/images/                   # Static images for pages
```

---

## ⚙️ How to Run

### Prerequisites
- **PHP 8.2+**
- **Composer**
- **Node.js & npm**
- **MongoDB** (local or cloud Atlas)

### Setup Steps

```bash
# 1. Clone the repository
git clone https://github.com/Yatishydv/Order-Tracking-Delivery-Updates-Portal.git
cd Order-Tracking-Delivery-Updates-Portal

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Copy environment file and set your config
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your MongoDB connection in .env
#    DB_CONNECTION=mongodb
#    DB_HOST=127.0.0.1
#    DB_PORT=27017
#    DB_DATABASE=your_database_name

# 7. (Optional) Seed the database
php artisan db:seed

# 8. Start the Laravel server (Terminal 1)
php artisan serve

# 9. Start Vite dev server (Terminal 2)
npm run dev

# 10. Open in browser
#     http://localhost:8000
```

---

## 🔑 User Roles & Access

| Role | Access |
|------|--------|
| **Customer** | View personal orders, track shipments, apply to become a driver |
| **Admin** | Full dashboard, manage shipments, approve/revoke drivers, view support messages |
| **Agent (Driver)** | View assigned deliveries, update order statuses step-by-step |

---

## 📬 Routes Overview

| Route | Method | Description |
|-------|--------|-------------|
| `/` | GET | Landing page |
| `/about` | GET | About page |
| `/contact` | GET | Contact page |
| `/contact-submit` | POST | Submit contact form |
| `/login` | GET | Login page |
| `/register` | GET | Registration page |
| `/admin/dashboard` | GET | Admin dashboard |
| `/admin/shipments` | GET | All shipments (admin) |
| `/agent/dashboard` | GET | Agent dashboard |
| `/customer/orders` | GET | Customer orders |
| `/customer/tracking/{order}` | GET | Order tracking detail |

---

## 👨‍💻 Developed By

**Yatish Yadav**
3rd Year Student

---

## 📝 License

This project is built for educational purposes.
