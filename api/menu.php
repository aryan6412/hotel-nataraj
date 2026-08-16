<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../config/db.php';

$categorySlug = isset($_GET['category']) ? trim($_GET['category']) : 'all';
$searchQuery  = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$featuredOnly = isset($_GET['featured']) && $_GET['featured'] === '1';

$pdo = getPDOConnection();

if ($pdo !== null) {
    try {
        $sql = "SELECT m.*, c.name AS category_name, c.slug AS category_slug 
                FROM menu_items m 
                JOIN categories c ON m.category_id = c.id 
                WHERE m.is_available = 1";
        
        $params = [];

        if ($categorySlug !== 'all') {
            $sql .= " AND c.slug = :category_slug";
            $params[':category_slug'] = $categorySlug;
        }

        if ($featuredOnly) {
            $sql .= " AND m.is_featured = 1";
        }

        if ($searchQuery !== '') {
            $sql .= " AND (LOWER(m.name) LIKE :query OR LOWER(m.description) LIKE :query)";
            $params[':query'] = '%' . $searchQuery . '%';
        }

        $sql .= " ORDER BY c.display_order ASC, m.name ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $items = $stmt->fetchAll();

        // Fetch categories list
        $catStmt = $pdo->query("SELECT * FROM categories ORDER BY display_order ASC");
        $categories = $catStmt->fetchAll();

        echo json_encode([
            'status' => 'success',
            'categories' => $categories,
            'items' => $items,
            'source' => 'mysql'
        ]);
        exit;
    } catch (Exception $e) {
        // Fallback to mock data on DB query error
    }
}

// Fallback logic using mock data
$allCategories = getMockCategories();
$allItems = getMockMenuItems();

$filteredItems = array_filter($allItems, function($item) use ($categorySlug, $searchQuery, $featuredOnly) {
    if ($categorySlug !== 'all' && $item['category_slug'] !== $categorySlug) {
        return false;
    }
    if ($featuredOnly && empty($item['is_featured'])) {
        return false;
    }
    if ($searchQuery !== '') {
        $nameMatch = strpos(strtolower($item['name']), $searchQuery) !== false;
        $descMatch = strpos(strtolower($item['description']), $searchQuery) !== false;
        if (!$nameMatch && !$descMatch) {
            return false;
        }
    }
    return true;
});

echo json_encode([
    'status' => 'success',
    'categories' => $allCategories,
    'items' => array_values($filteredItems),
    'source' => 'mock'
]);
