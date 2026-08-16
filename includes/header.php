<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Nataraj | Royal Fine Dining & Grand Banquet Hall</title>
    <meta name="description" content="Welcome to Hotel Nataraj - Experience authentic Indian fine dining, rich tandoori specialties, saffron biryanis, and our grand banquet hall for luxury celebrations.">
    <meta name="keywords" content="Hotel Nataraj, Restaurant, Fine Dining, Indian Food, Banquet Hall, Wedding Venue, Paneer Tikka, Biryani, Food Delivery">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- GSAP & ScrollTrigger Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
</head>
<body>

    <!-- Glowing Custom Cursor Follower -->
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- Sticky Announcement Bar -->
    <div class="announcement-bar">
        <div class="container announcement-content">
            <span class="announcement-badge"><i class="fa-solid fa-crown text-gold"></i> Welcome to Hotel Nataraj — Experiential Fine Dining & Celebrations</span>
            <div class="announcement-right">
                <a href="tel:9898989898" class="phone-link pulse-hover"><i class="fa-solid fa-phone"></i> Call Hotline: <strong>9898989898</strong></a>
                <span class="divider">|</span>
                <span><i class="fa-regular fa-clock"></i> 11:00 AM – 11:30 PM Daily</span>
            </div>
        </div>
    </div>

    <!-- Main Header & Glass Navigation -->
    <header class="site-header" id="mainHeader">
        <div class="container header-container">
            <a href="index.php" class="brand-logo" id="brandLogo">
                <div class="logo-icon spin-glow">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div class="logo-text">
                    <span class="brand-name">Hotel Nataraj</span>
                    <span class="brand-sub">FINE DINING & BANQUET</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="main-nav" id="mainNav">
                <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
                <a href="menu.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : ''; ?>">Menu</a>
                <a href="index.php#banquetSection" class="nav-link">Banquet Hall</a>
                <a href="about.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About Us</a>
                <a href="contact.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact Us</a>
            </nav>

            <!-- Action Buttons -->
            <div class="header-actions">
                <a href="tel:9898989898" class="btn btn-outline-gold call-btn magnetic-btn" id="callHeaderBtn">
                    <i class="fa-solid fa-phone"></i> 9898989898
                </a>
                <button class="btn btn-gold reserve-btn magnetic-btn glow-btn" id="openReserveModal">
                    <i class="fa-solid fa-calendar-check"></i> Reserve Table
                </button>

                <!-- Mobile Hamburger Toggle -->
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="mobile-drawer-header">
            <span class="brand-name">Hotel Nataraj</span>
            <button class="close-drawer" id="closeDrawer">&times;</button>
        </div>
        <nav class="mobile-nav">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <a href="menu.php"><i class="fa-solid fa-book-open"></i> Explore Menu</a>
            <a href="index.php#banquetSection"><i class="fa-solid fa-building-columns"></i> Banquet Hall</a>
            <a href="about.php"><i class="fa-solid fa-circle-info"></i> About Us</a>
            <a href="contact.php"><i class="fa-solid fa-envelope"></i> Contact Us</a>
            <hr class="drawer-hr">
            <a href="tel:9898989898" class="drawer-call"><i class="fa-solid fa-phone text-gold"></i> Call Hotline: 9898989898</a>
            <button class="btn btn-gold w-100 mt-3" id="mobileReserveBtn">Reserve Table / Event</button>
        </nav>
    </div>

    <!-- Floating Hotline Sticky Widget (Icon Only) -->
    <div class="floating-hotline-widget" id="floatingHotline">
        <a href="tel:9898989898" class="hotline-pill" title="Call Hotel Nataraj: 9898989898" aria-label="Call Hotline">
            <div class="hotline-icon"><i class="fa-solid fa-phone"></i></div>
        </a>
    </div>
