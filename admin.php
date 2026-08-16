<?php
require_once __DIR__ . '/config/db.php';

$pdo = getPDOConnection();
$isDbConnected = ($pdo !== null);

// Fetch data from MySQL or Fallback
$categories = [];
$menuItems = [];
$reservations = [];
$inquiries = [];

if ($isDbConnected) {
    try {
        $categories = $pdo->query("SELECT * FROM categories ORDER BY id ASC")->fetchAll();
        $menuItems = $pdo->query("SELECT m.*, c.name as category_name FROM menu_items m LEFT JOIN categories c ON m.category_id = c.id ORDER BY m.id ASC")->fetchAll();
        $reservations = $pdo->query("SELECT * FROM reservations ORDER BY id DESC")->fetchAll();
        $inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY id DESC")->fetchAll();
    } catch (Exception $e) {
        $dbError = $e->getMessage();
    }
} else {
    $categories = getMockCategories();
    $menuItems = getMockMenuItems();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Dashboard & Admin | Hotel Nataraj</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0F0D0A;
            --bg-card: #171410;
            --bg-table: #1C1813;
            --border-gold: rgba(212, 175, 55, 0.25);
            --color-gold: #D4AF37;
            --color-gold-light: #F7E7B6;
            --text-main: #FDFBF7;
            --text-muted: #A39B8F;
            --radius-md: 12px;
            --radius-sm: 6px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            padding: 30px 20px;
            line-height: 1.5;
        }
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border-gold);
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .brand-title {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            color: var(--color-gold);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-title span {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-family: 'Outfit', sans-serif;
            display: block;
        }
        .header-actions {
            display: flex;
            gap: 12px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }
        .btn-gold {
            background: linear-gradient(135deg, #D4AF37, #B89324);
            color: #14110E;
        }
        .btn-outline {
            background: transparent;
            border-color: var(--border-gold);
            color: var(--text-main);
        }
        .btn-outline:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
        }
        .db-status-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            padding: 16px 24px;
            border-radius: var(--radius-md);
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 14px;
        }
        .status-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #2E7D32;
            box-shadow: 0 0 10px #2E7D32;
        }
        .status-info {
            color: var(--text-muted);
            font-size: 0.88rem;
        }
        .status-info strong {
            color: var(--color-gold-light);
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .metric-card {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            padding: 20px;
            border-radius: var(--radius-md);
        }
        .metric-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .metric-val {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            color: var(--color-gold);
            font-weight: 700;
        }
        .tabs-nav {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            overflow-x: auto;
        }
        .tab-btn {
            background: transparent;
            border: 1px solid transparent;
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .tab-btn:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
        }
        .tab-btn.active {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--color-gold);
            color: var(--color-gold-light);
        }
        .tab-content {
            display: none;
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: var(--radius-md);
            overflow: hidden;
        }
        .tab-content.active {
            display: block;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }
        th {
            background: #14110D;
            color: var(--color-gold);
            font-family: 'Cinzel', serif;
            font-size: 0.82rem;
            letter-spacing: 1px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-gold);
            white-space: nowrap;
        }
        td {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--text-main);
        }
        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-veg { background: rgba(46, 125, 50, 0.2); color: #81C784; border: 1px solid #2E7D32; }
        .badge-gold { background: rgba(212, 175, 55, 0.2); color: var(--color-gold-light); border: 1px solid var(--color-gold); }
        .badge-confirmed { background: rgba(33, 150, 243, 0.2); color: #64B5F6; border: 1px solid #1976D2; }
        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--text-muted);
        }
        .client-guide {
            margin-top: 40px;
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            padding: 24px;
            border-radius: var(--radius-md);
        }
        .client-guide h3 {
            font-family: 'Cinzel', serif;
            color: var(--color-gold);
            margin-bottom: 12px;
        }
        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }
        .guide-box {
            background: #110E0B;
            padding: 16px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .guide-box strong {
            color: var(--color-gold-light);
            display: block;
            margin-bottom: 6px;
        }
        .guide-box code {
            background: rgba(0,0,0,0.5);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.85rem;
            color: #E0E0E0;
        }
    </style>
</head>
<body>

<div class="admin-container">
    
    <header class="admin-header">
        <div class="brand-title">
            <i class="fa-solid fa-database"></i>
            <div>
                Hotel Nataraj Database Manager
                <span>Live MySQL Viewer & Records Inspector</span>
            </div>
        </div>
        <div class="header-actions">
            <a href="index.php" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> View Website</a>
            <a href="menu.php" class="btn btn-gold"><i class="fa-solid fa-utensils"></i> Live Menu</a>
        </div>
    </header>

    <!-- DB Status Bar -->
    <div class="db-status-bar">
        <div class="status-tag">
            <span class="status-dot"></span>
            <span>Active Database Engine: <strong><?php echo (getDatabaseDriver() === 'mysql') ? 'MySQL / MariaDB' : 'SQLite (Zero-Server Local File)'; ?></strong></span>
        </div>
        <div class="status-info">
            <?php if (getDatabaseDriver() === 'mysql'): ?>
                Type: <strong>MySQL Server</strong> &bull; Database: <strong>hotel_nataraj</strong> &bull; Host: <strong>localhost:3306</strong>
            <?php else: ?>
                Storage: <strong>database/hotel_nataraj.sqlite</strong> &bull; Mode: <strong>Zero-Config Offline (No XAMPP Required)</strong>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Metrics -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-label">Menu Items <i class="fa-solid fa-bowl-food text-gold"></i></div>
            <div class="metric-val"><?php echo count($menuItems); ?></div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Categories <i class="fa-solid fa-layer-group text-gold"></i></div>
            <div class="metric-val"><?php echo count($categories); ?></div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Reservations & Bookings <i class="fa-solid fa-calendar-check text-gold"></i></div>
            <div class="metric-val"><?php echo count($reservations); ?></div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Inquiries & Contact <i class="fa-solid fa-envelope text-gold"></i></div>
            <div class="metric-val"><?php echo count($inquiries); ?></div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs-nav">
        <button class="tab-btn active" onclick="switchTab('tabMenu')"><i class="fa-solid fa-utensils"></i> Menu Items (<?php echo count($menuItems); ?>)</button>
        <button class="tab-btn" onclick="switchTab('tabReservations')"><i class="fa-solid fa-calendar-check"></i> Reservations (<?php echo count($reservations); ?>)</button>
        <button class="tab-btn" onclick="switchTab('tabCategories')"><i class="fa-solid fa-layer-group"></i> Categories (<?php echo count($categories); ?>)</button>
        <button class="tab-btn" onclick="switchTab('tabInquiries')"><i class="fa-solid fa-envelope"></i> Inquiries (<?php echo count($inquiries); ?>)</button>
    </div>

    <!-- Tab 1: Menu Items -->
    <div class="tab-content active" id="tabMenu">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Item Name</th>
                        <th>Price (₹)</th>
                        <th>Diet</th>
                        <th>Spice</th>
                        <th>Featured</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($menuItems)): ?>
                        <?php foreach ($menuItems as $item): ?>
                            <tr>
                                <td><strong>#<?php echo htmlspecialchars($item['id']); ?></strong></td>
                                <td><span class="badge badge-gold"><?php echo htmlspecialchars($item['category_name'] ?? 'General'); ?></span></td>
                                <td><strong><?php echo htmlspecialchars($item['name']); ?></strong><br><small style="color:var(--text-muted);"><?php echo htmlspecialchars($item['description'] ?? ''); ?></small></td>
                                <td><strong>₹<?php echo number_format($item['price'], 2); ?></strong></td>
                                <td><span class="badge badge-veg"><?php echo !empty($item['is_veg']) ? '100% Pure Veg' : 'Non-Veg'; ?></span></td>
                                <td><?php echo htmlspecialchars($item['spice_level'] ?? 'Medium'); ?></td>
                                <td><?php echo !empty($item['is_featured']) ? '<span class="badge badge-gold">★ Featured</span>' : '<span style="color:var(--text-muted);">-</span>'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="empty-state">No menu items found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 2: Reservations -->
    <div class="tab-content" id="tabReservations">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Guest Name</th>
                        <th>Phone</th>
                        <th>Guests</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reservations)): ?>
                        <?php foreach ($reservations as $res): ?>
                            <tr>
                                <td>#<?php echo htmlspecialchars($res['id']); ?></td>
                                <td><span class="badge badge-gold"><?php echo htmlspecialchars($res['booking_type']); ?></span></td>
                                <td><strong><?php echo htmlspecialchars($res['guest_name']); ?></strong><br><small><?php echo htmlspecialchars($res['email'] ?? ''); ?></small></td>
                                <td><a href="tel:<?php echo htmlspecialchars($res['phone']); ?>" style="color:var(--color-gold-light);"><?php echo htmlspecialchars($res['phone']); ?></a></td>
                                <td><?php echo htmlspecialchars($res['guests_count']); ?> Guests</td>
                                <td><?php echo htmlspecialchars($res['reservation_date']); ?> @ <?php echo htmlspecialchars($res['reservation_time']); ?></td>
                                <td><span class="badge badge-confirmed"><?php echo htmlspecialchars($res['status']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="empty-state"><i class="fa-solid fa-inbox fa-2x" style="display:block;margin-bottom:10px;"></i> No reservations submitted yet. New bookings from the website will appear here in real time!</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 3: Categories -->
    <div class="tab-content" id="tabCategories">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($cat['id']); ?></td>
                            <td><strong><?php echo htmlspecialchars($cat['name']); ?></strong></td>
                            <td><code><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                            <td><?php echo htmlspecialchars($cat['description'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab 4: Inquiries -->
    <div class="tab-content" id="tabInquiries">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Received At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($inquiries)): ?>
                        <?php foreach ($inquiries as $inq): ?>
                            <tr>
                                <td>#<?php echo htmlspecialchars($inq['id']); ?></td>
                                <td><strong><?php echo htmlspecialchars($inq['name']); ?></strong></td>
                                <td><?php echo htmlspecialchars($inq['phone']); ?></td>
                                <td><?php echo htmlspecialchars($inq['subject']); ?></td>
                                <td><?php echo htmlspecialchars($inq['message']); ?></td>
                                <td><?php echo htmlspecialchars($inq['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="empty-state">No inquiries received yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- External Database Connection Guide -->
    <div class="client-guide">
        <h3><i class="fa-solid fa-plug text-gold"></i> Other Ways to View & Connect to this Database</h3>
        <p style="color:var(--text-muted);font-size:0.9rem;">You can also inspect and manage the <code>hotel_nataraj</code> MySQL database using external tools:</p>
        <div class="guide-grid">
            <div class="guide-box">
                <strong>1. phpMyAdmin (Web Interface)</strong>
                Open <a href="http://localhost/phpmyadmin" target="_blank" style="color:var(--color-gold-light);">http://localhost/phpmyadmin</a> in your browser and select the <code>hotel_nataraj</code> database.
            </div>
            <div class="guide-box">
                <strong>2. DBeaver / HeidiSQL / MySQL Workbench</strong>
                Host: <code>127.0.0.1</code><br>
                Port: <code>3306</code><br>
                User: <code>root</code> | Pass: <code>(none)</code><br>
                Database: <code>hotel_nataraj</code>
            </div>
            <div class="guide-box">
                <strong>3. Raw SQL Source Files in Codebase</strong>
                Structure: <a href="schema.sql" style="color:var(--color-gold-light);"><code>schema.sql</code></a><br>
                Sample Data: <a href="seed.sql" style="color:var(--color-gold-light);"><code>seed.sql</code></a>
            </div>
        </div>
    </div>

</div>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    event.currentTarget.classList.add('active');
    const target = document.getElementById(tabId);
    if (target) target.classList.add('active');
}
</script>

</body>
</html>
