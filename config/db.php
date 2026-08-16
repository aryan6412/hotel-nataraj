<?php
// Hotel Nataraj Hybrid Database Connection (MySQL + Zero-Config SQLite Fallback)

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'hotel_nataraj');
define('DB_USER', 'root');
define('DB_PASS', '');
define('SQLITE_PATH', __DIR__ . '/../database/hotel_nataraj.sqlite');

function getPDOConnection() {
    static $pdo = null;
    static $driverType = null;
    if ($pdo !== null) {
        return $pdo;
    }

    // 1. Try MySQL Connection First (if XAMPP/MySQL is running)
    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => 1,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        $driverType = 'mysql';
        return $pdo;
    } catch (PDOException $e) {
        // MySQL is not running or database not created
    }

    // 2. Fallback to Local Persistent SQLite File Database (Runs 100% locally without XAMPP)
    try {
        $dbDir = dirname(SQLITE_PATH);
        if (!is_dir($dbDir)) {
            mkdir($dbDir, 0777, true);
        }

        $isNewSqlite = !file_exists(SQLITE_PATH);
        $pdo = new PDO("sqlite:" . SQLITE_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        if ($isNewSqlite || filesize(SQLITE_PATH) === 0) {
            initSqliteDatabase($pdo);
        }

        $driverType = 'sqlite';
        return $pdo;
    } catch (Exception $e) {
        error_log("SQLite Connection Failed: " . $e->getMessage());
        return null;
    }
}

function getDatabaseDriver() {
    getPDOConnection();
    global $driverType;
    return $driverType ?? 'sqlite';
}

function initSqliteDatabase($pdo) {
    // Create Categories Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        slug TEXT NOT NULL UNIQUE,
        description TEXT,
        display_order INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create Menu Items Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS menu_items (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        category_id INTEGER NOT NULL,
        name TEXT NOT NULL,
        description TEXT,
        price REAL NOT NULL,
        is_veg INTEGER DEFAULT 1,
        spice_level TEXT DEFAULT 'Medium',
        image_url TEXT,
        is_featured INTEGER DEFAULT 0,
        is_available INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create Reservations Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS reservations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        booking_type TEXT DEFAULT 'Dining Table',
        guest_name TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT,
        guests_count INTEGER NOT NULL,
        reservation_date TEXT NOT NULL,
        reservation_time TEXT NOT NULL,
        event_type TEXT DEFAULT 'Dining',
        special_request TEXT,
        status TEXT DEFAULT 'Confirmed',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create Inquiries Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS inquiries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT,
        subject TEXT NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Seed Categories
    $categories = getMockCategories();
    $catStmt = $pdo->prepare("INSERT OR IGNORE INTO categories (id, name, slug, description) VALUES (:id, :name, :slug, :description)");
    foreach ($categories as $cat) {
        $catStmt->execute([':id' => $cat['id'], ':name' => $cat['name'], ':slug' => $cat['slug'], ':description' => $cat['description']]);
    }

    // Seed Menu Items
    $menuItems = getMockMenuItems();
    $menuStmt = $pdo->prepare("INSERT INTO menu_items (category_id, name, description, price, is_veg, spice_level, image_url, is_featured) 
                              VALUES (:cat_id, :name, :desc, :price, :is_veg, :spice, :img, :feat)");
    foreach ($menuItems as $item) {
        $menuStmt->execute([
            ':cat_id' => $item['category_id'],
            ':name' => $item['name'],
            ':desc' => $item['description'],
            ':price' => $item['price'],
            ':is_veg' => $item['is_veg'],
            ':spice' => $item['spice_level'],
            ':img' => $item['image_url'],
            ':feat' => $item['is_featured']
        ]);
    }
}

// Fallback Mock Data
function getMockCategories() {
    return [
        ['id' => 1, 'name' => 'Starters & Tandoor', 'slug' => 'starters-tandoor', 'description' => 'Authentic clay-oven tandoori appetizers and sizzling delights'],
        ['id' => 2, 'name' => 'Main Course', 'slug' => 'main-course', 'description' => 'Rich aromatic curries, gravies, and royal North Indian specialties'],
        ['id' => 3, 'name' => 'Biryani & Rice', 'slug' => 'biryani-rice', 'description' => 'Saffron-infused handi biryanis and fragrant basmati preparations'],
        ['id' => 4, 'name' => 'Tandoori Breads', 'slug' => 'breads', 'description' => 'Freshly baked naan, kulchas, and parathas straight from the tandoor'],
        ['id' => 5, 'name' => 'Desserts', 'slug' => 'desserts', 'description' => 'Royal Indian sweets and handcrafted icy treats'],
        ['id' => 6, 'name' => 'Mocktails & Drinks', 'slug' => 'beverages', 'description' => 'Refreshing artisanal cooler blends, lassis, and hot beverages']
    ];
}

function getMockMenuItems() {
    return [
        [
            'id' => 1, 'category_id' => 1, 'category_name' => 'Starters & Tandoor', 'category_slug' => 'starters-tandoor',
            'name' => 'Royal Tandoori Paneer Tikka', 'description' => 'Fresh cottage cheese cubes marinated in yellow mustard, yogurt, and aromatic tandoori spices, char-grilled to perfection.',
            'price' => 340.00, 'is_veg' => 1, 'spice_level' => 'Medium', 'image_url' => 'assets/images/paneer_tikka.jpg', 'is_featured' => 1
        ],
        [
            'id' => 2, 'category_id' => 1, 'category_name' => 'Starters & Tandoor', 'category_slug' => 'starters-tandoor',
            'name' => 'Hara Bhara Kabab', 'description' => 'Pan-seared spinach, green pea, and cashew patties infused with roasted cumin and royal garam masala.',
            'price' => 290.00, 'is_veg' => 1, 'spice_level' => 'Mild', 'image_url' => 'assets/images/paneer_tikka.jpg', 'is_featured' => 0
        ],
        [
            'id' => 3, 'category_id' => 2, 'category_name' => 'Main Course', 'category_slug' => 'main-course',
            'name' => 'Special Dal Makhani', 'description' => 'Overnight slow-cooked black lentils enriched with churned butter, fresh cream, and smoked tomatoes.',
            'price' => 310.00, 'is_veg' => 1, 'spice_level' => 'Mild', 'image_url' => 'assets/images/dal_makhani.jpg', 'is_featured' => 1
        ],
        [
            'id' => 4, 'category_id' => 2, 'category_name' => 'Main Course', 'category_slug' => 'main-course',
            'name' => 'Paneer Butter Masala', 'description' => 'Char-broiled cottage cheese simmered in a velvety tomato, cashew nut, and butter gravy with kasuri methi.',
            'price' => 360.00, 'is_veg' => 1, 'spice_level' => 'Medium', 'image_url' => 'assets/images/paneer_butter_masala.jpg', 'is_featured' => 1
        ],
        [
            'id' => 5, 'category_id' => 3, 'category_name' => 'Biryani & Rice', 'category_slug' => 'biryani-rice',
            'name' => 'Hotel Nataraj Special Shahi Biryani', 'description' => 'Long grain basmati rice cooked dum style with marinated cottage cheese, saffron, mint, fried onions, and dry fruits.',
            'price' => 390.00, 'is_veg' => 1, 'spice_level' => 'Medium', 'image_url' => 'assets/images/biryani.jpg', 'is_featured' => 1
        ],
        [
            'id' => 6, 'category_id' => 4, 'category_name' => 'Tandoori Breads', 'category_slug' => 'breads',
            'name' => 'Butter Garlic Naan', 'description' => 'Refined flour bread baked in tandoor, slathered with garlic butter and fresh cilantro.',
            'price' => 75.00, 'is_veg' => 1, 'spice_level' => 'Mild', 'image_url' => 'assets/images/dal_makhani.jpg', 'is_featured' => 1
        ],
        [
            'id' => 7, 'category_id' => 5, 'category_name' => 'Desserts', 'category_slug' => 'desserts',
            'name' => 'Saffron Gulab Jamun (2 Pcs)', 'description' => 'Warm milk dumplings soaked in saffron and cardamom scented sugar syrup, topped with silver leaf.',
            'price' => 150.00, 'is_veg' => 1, 'spice_level' => 'Mild', 'image_url' => 'assets/images/gulab_jamun.jpg', 'is_featured' => 1
        ],
        [
            'id' => 8, 'category_id' => 6, 'category_name' => 'Mocktails & Drinks', 'category_slug' => 'beverages',
            'name' => 'Royal Rose Blossom Mocktail', 'description' => 'Fragrant rose syrup infused with chilled sparkling soda, lime juice, and basil seeds.',
            'price' => 180.00, 'is_veg' => 1, 'spice_level' => 'Mild', 'image_url' => 'assets/images/drinks.jpg', 'is_featured' => 1
        ],
        [
            'id' => 9, 'category_id' => 6, 'category_name' => 'Mocktails & Drinks', 'category_slug' => 'beverages',
            'name' => 'Traditional Mango Panna', 'description' => 'Tangy raw mango cooler spiced with roasted cumin, black salt, and fresh mint leaves.',
            'price' => 150.00, 'is_veg' => 1, 'spice_level' => 'Medium', 'image_url' => 'assets/images/drinks.jpg', 'is_featured' => 1
        ]
    ];
}
