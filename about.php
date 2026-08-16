<?php
require_once __DIR__ . '/config/db.php';
include __DIR__ . '/includes/header.php';
?>

<!-- Banner -->
<section class="page-banner">
    <div class="container text-center">
        <span class="sub-heading"><i class="fa-solid fa-crown text-gold"></i> Heritage & Passion</span>
        <h1 class="page-title">About Hotel Nataraj</h1>
        <p class="page-subtitle">A quarter-century legacy of authentic Indian hospitality, fine dining, and grand celebrations.</p>
    </div>
</section>

<!-- About Detail Section -->
<section class="section about-detail-section">
    <div class="container">
        <div class="about-card-wrapper">
            <div class="about-detail-grid">
                <div class="about-text gsap-left-reveal">
                    <span class="sub-heading"><i class="fa-solid fa-hotel text-gold"></i> Welcome to Our World</span>
                    <h2 class="section-title">The Legend of Hotel Nataraj</h2>
                    <p class="story-body-text">
                        Founded with a mission to bring royal, authentic, and pure Indian culinary experiences to every guest, <strong>Hotel Nataraj</strong> has evolved into a premier destination for fine dining and grand celebrations.
                    </p>
                    <p class="story-body-text mt-3">
                        Located at <strong>124 Heritage Royal Road, Near City Center</strong>, our restaurant offers a bright, warm, and inviting atmosphere where families, friends, and corporate groups gather to enjoy timeless recipes.
                    </p>

                    <div class="about-features-grid mt-4">
                        <div class="feature-item tilt-card">
                            <div class="feature-icon-wrapper"><i class="fa-solid fa-fire-burner feature-icon text-gold"></i></div>
                            <div>
                                <h4>Clay Tandoor Mastered</h4>
                                <p>Our naans, paneer tikka, and kebabs are cooked in authentic clay tandoors for natural smoky flavors.</p>
                            </div>
                        </div>

                        <div class="feature-item tilt-card">
                            <div class="feature-icon-wrapper"><i class="fa-solid fa-leaf feature-icon text-success"></i></div>
                            <div>
                                <h4>100% Pure Vegetarian</h4>
                                <p>Prepared in dedicated hygienic kitchens using fresh daily produce and churned desi ghee.</p>
                            </div>
                        </div>

                        <div class="feature-item tilt-card">
                            <div class="feature-icon-wrapper"><i class="fa-solid fa-building-columns feature-icon text-gold"></i></div>
                            <div>
                                <h4>Grand Banquet Hall</h4>
                                <p>Spacious, air-conditioned banquet hall hosting up to 300+ guests for weddings, parties, and corporate events.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-img-stack gsap-right-reveal">
                    <div class="img-wrapper-card tilt-card">
                        <img src="assets/images/restaurant_interior.jpg" alt="Interior Dining" class="img-responsive rounded-card open-lightbox-img" data-caption="Bright Luxury Dining Hall at Hotel Nataraj">
                        <span class="img-caption-badge"><i class="fa-solid fa-sparkles text-gold"></i> Dining Ambiance</span>
                    </div>
                    <div class="img-wrapper-card tilt-card mt-4">
                        <img src="assets/images/banquet_hall.jpg" alt="Banquet Hall" class="img-responsive rounded-card open-lightbox-img" data-caption="Grand Banquet Hall Setup for Events">
                        <span class="img-caption-badge"><i class="fa-solid fa-crown text-gold"></i> Banquet Hall</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kitchen & Quality Standards -->
<section class="section standards-section">
    <div class="container">
        <div class="standards-card-wrapper">
            <div class="section-header text-center gsap-header">
                <span class="sub-heading"><i class="fa-solid fa-shield-halved text-gold"></i> Safety & Excellence</span>
                <h2 class="section-title">Our Quality & Hygiene Promise</h2>
                <p class="section-subtitle">We follow stringent quality controls to ensure every bite is safe, pure, and unforgettable.</p>
            </div>

            <div class="standards-grid mt-5">
                <div class="standard-card tilt-card">
                    <div class="standard-icon"><i class="fa-solid fa-mortar-pestle text-gold"></i></div>
                    <h3>House-Ground Spices</h3>
                    <p>We grind whole spices in-house every morning to preserve natural essential oils and rich aroma.</p>
                </div>

                <div class="standard-card tilt-card">
                    <div class="standard-icon"><i class="fa-solid fa-droplet text-gold"></i></div>
                    <h3>Pure Cow Ghee</h3>
                    <p>All our gravies, lentils, and breads are finished with 100% pure cow ghee for wholesome taste.</p>
                </div>

                <div class="standard-card tilt-card">
                    <div class="standard-icon"><i class="fa-solid fa-sparkles text-gold"></i></div>
                    <h3>Sanitized Dining</h3>
                    <p>Strict kitchen sanitization, clean tableware, and regular health checks for all service staff.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-card-wrapper glow-banner">
            <div class="cta-flex">
                <div class="cta-text">
                    <span class="cta-badge"><i class="fa-solid fa-crown text-gold"></i> DINING & EVENTS HOTLINE</span>
                    <h2 class="mt-2">Plan Your Dining Experience or Event Today</h2>
                    <p class="mt-2">Call <a href="tel:9898989898" class="text-gold font-weight-bold">9898989898</a> for table reservations or banquet inquiries.</p>
                </div>
                <div class="cta-btn-group">
                    <a href="tel:9898989898" class="btn btn-gold btn-lg magnetic-btn glow-pulse"><i class="fa-solid fa-phone"></i> Call 9898989898</a>
                    <button class="btn btn-white btn-lg magnetic-btn" id="aboutReserveBtn"><i class="fa-solid fa-calendar-check"></i> Reserve Table</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
