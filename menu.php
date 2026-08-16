<?php
require_once __DIR__ . '/config/db.php';
include __DIR__ . '/includes/header.php';

$pdo = getPDOConnection();
$categories = [];
$menuItems = [];

if ($pdo !== null) {
    try {
        $catStmt = $pdo->query("SELECT * FROM categories ORDER BY display_order ASC");
        $categories = $catStmt->fetchAll();

        $itemStmt = $pdo->query("SELECT m.*, c.name as category_name, c.slug as category_slug FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE m.is_available = 1 ORDER BY c.display_order ASC, m.name ASC");
        $menuItems = $itemStmt->fetchAll();
    } catch (Exception $e) {
        $categories = [];
        $menuItems = [];
    }
}

if (empty($categories)) {
    $categories = getMockCategories();
}

if (empty($menuItems)) {
    $menuItems = getMockMenuItems();
}
?>

<!-- Page Header Banner -->
<section class="page-banner">
    <div class="container text-center">
        <span class="sub-heading"><i class="fa-solid fa-crown text-gold"></i> Culinary Selection</span>
        <h1 class="page-title">Royal Menu & Delicacies</h1>
        <p class="page-subtitle">Prepared fresh using authentic spices, churned butter, and traditional clay-oven cooking.</p>
    </div>
</section>

<!-- Menu Interactive Section -->
<section class="section menu-page-section">
    <div class="container">
        <div class="menu-card-wrapper">
            <!-- Search & Filter Controls -->
            <div class="menu-controls-card">
                <div class="menu-search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="menuSearchInput" class="form-control search-input" placeholder="Search dishes (e.g. Paneer Tikka, Biryani, Dal Makhani)...">
                    <button type="button" id="clearSearchBtn" class="clear-btn">&times;</button>
                </div>

                <!-- Categories Tabs -->
                <div class="category-tabs" id="categoryTabs">
                    <button class="cat-tab active" data-category="all">All Specialties</button>
                    <?php foreach ($categories as $cat): ?>
                    <button class="cat-tab" data-category="<?php echo htmlspecialchars($cat['slug']); ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="menu-items-grid" id="menuItemsGrid">
                <?php foreach ($menuItems as $item): ?>
                <div class="dish-card menu-item-card tilt-card" data-category="<?php echo htmlspecialchars($item['category_slug']); ?>" data-name="<?php echo htmlspecialchars(strtolower($item['name'] . ' ' . $item['description'])); ?>">
                    <div class="dish-img-wrapper">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" loading="lazy">
                        <span class="veg-badge"><i class="fa-solid fa-circle text-success"></i> Pure Veg</span>
                        <button class="quick-view-btn magnetic-btn" 
                            data-id="<?php echo $item['id']; ?>" 
                            data-name="<?php echo htmlspecialchars($item['name']); ?>" 
                            data-price="₹<?php echo number_format($item['price'], 0); ?>" 
                            data-desc="<?php echo htmlspecialchars($item['description']); ?>" 
                            data-img="<?php echo htmlspecialchars($item['image_url']); ?>" 
                            data-category="<?php echo htmlspecialchars($item['category_name'] ?? 'Specialty'); ?>" 
                            data-spice="<?php echo $item['spice_level']; ?>">
                            <i class="fa-solid fa-eye"></i> Quick View
                        </button>
                    </div>
                    <div class="dish-content">
                        <div class="dish-header">
                            <h3 class="dish-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                            <span class="dish-price">₹<?php echo number_format($item['price'], 0); ?></span>
                        </div>
                        <p class="dish-desc"><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="dish-footer">
                            <span class="spice-level"><i class="fa-solid fa-pepper-hot"></i> <?php echo $item['spice_level']; ?></span>
                            <a href="tel:9898989898" class="order-link pulse-hover"><i class="fa-solid fa-phone"></i> Order: 9898989898</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Empty State -->
            <div id="noResultsMsg" class="no-results-box d-none text-center p-5">
                <i class="fa-solid fa-utensils text-muted fa-3x mb-3"></i>
                <h3>No Dishes Found</h3>
                <p>Try searching for another dish or select a different category tab.</p>
                <button class="btn btn-gold mt-3" id="resetFilterBtn">Reset Menu View</button>
            </div>
        </div>
    </div>
</section>

<!-- Callout Banner -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-card-wrapper glow-banner">
            <div class="cta-flex">
                <div class="cta-text">
                    <span class="cta-badge"><i class="fa-solid fa-crown text-gold"></i> INSTANT ORDER HOTLINE</span>
                    <h2 class="mt-2">Want to Order or Book a Party?</h2>
                    <p class="mt-2">Call our hotline directly at <a href="tel:9898989898" class="text-gold font-weight-bold">9898989898</a> for fast table reservation and takeout orders.</p>
                </div>
                <div class="cta-btn-group">
                    <a href="tel:9898989898" class="btn btn-gold btn-lg magnetic-btn glow-pulse"><i class="fa-solid fa-phone"></i> Call 9898989898</a>
                    <button class="btn btn-white btn-lg magnetic-btn" id="menuReserveBtn"><i class="fa-solid fa-calendar-check"></i> Reserve Table</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
