# 👑 Hotel Nataraj - Royal Fine Dining & Grand Banquet Hall

A luxury, fully-animated web application and management system for **Hotel Nataraj**, featuring authentic Indian gastronomy, clay-tandoor delicacies, slow-cooked royal gravies, and grand banquet reservations.

---

## ✨ Features

- 🎬 **Cinematic Video Hero**: Ultra-high-definition restaurant atmosphere video background with 100% transparent floating glass navbar.
- 🍲 **Dynamic Menu System**: 22 authentic signature dishes with live dietary tags (100% Pure Veg / Non-Veg), spice levels, and prices in ₹ INR.
- 📅 **Online Table & Banquet Reservations**: Instant booking modal with AJAX confirmation and booking reference ID generation.
- 🗄️ **Zero-Config Hybrid Database**:
  - **MySQL Mode**: Automatic connection to MySQL (`hotel_nataraj`) on port 3306.
  - **SQLite Offline Mode**: Zero-server local file database fallback (`database/hotel_nataraj.sqlite`), enabling full persistence without running XAMPP or MySQL.
- 📊 **Live Database Admin Manager**: Integrated browser dashboard at `/admin.php` to inspect all records, categories, reservations, and contact inquiries.
- ✨ **GSAP & Canvas Animations**: Smooth scroll triggers, 3D tilt cards, custom cursor follower, and floating gold dust particles.

---

## 🚀 Getting Started

### 1. Prerequisites
- **PHP 8.0+** installed on your system.

### 2. Run Locally
Start the built-in development server:
```bash
php -S localhost:8000
```
Open your browser at **[http://localhost:8000](http://localhost:8000)**.

---

## 🗂️ Project Structure

```
├── about.php               # About Us story and culinary heritage
├── admin.php               # Live database inspector & admin dashboard
├── contact.php             # Contact information and inquiry form
├── index.php               # Homepage with cinematic video hero
├── menu.php                # Royal menu catalog with interactive filters
├── schema.sql              # MySQL database schema
├── seed.sql                # Initial menu dishes & category seeds
├── api/                    # Backend API handlers (reservation, inquiry)
├── assets/                 # Images & optimized 60fps web video assets
├── config/                 # Hybrid database connection (MySQL + SQLite)
├── css/                    # Custom luxury CSS styling & design tokens
├── database/               # Local SQLite database storage
├── includes/               # Reusable header and footer components
└── js/                     # GSAP animations, video engine, and modal logic
```

---

## 📜 License
&copy; Hotel Nataraj. All rights reserved.
