<?php
require_once __DIR__ . '/config/db.php';
include __DIR__ . '/includes/header.php';

// Fetch featured signature items with guaranteed fallback
$featuredItems = [];
$pdo = getPDOConnection();
if ($pdo !== null) {
    try {
        $stmt = $pdo->query("SELECT m.*, c.name as category_name FROM menu_items m JOIN categories c ON m.category_id = c.id WHERE m.is_featured = 1 AND m.is_available = 1 LIMIT 6");
        $featuredItems = $stmt->fetchAll();
    } catch (Exception $e) {
        $featuredItems = [];
    }
}

if (empty($featuredItems)) {
    $featuredItems = array_values(array_filter(getMockMenuItems(), fn($item) => !empty($item['is_featured'])));
}
?>

<!-- Realistic Cinematic Camera Hero Section -->
<section class="hero-section hero-cinematic-section" id="hero">
    <!-- Cinematic Video Rig & Fallback Container -->
    <div class="hero-video-viewport" id="heroVideoViewport">
        <video id="heroCinematicVideo" class="hero-bg-video active-video" autoplay muted loop playsinline poster="assets/images/restaurant_hero_cinematic.jpg" preload="auto">
            <source src="assets/videos/luxury_dining.webm" type="video/webm">
        </video>
        <video id="heroFlambeVideo" class="hero-bg-video" muted loop playsinline preload="none">
            <source src="assets/videos/chef_flambe.webm" type="video/webm">
        </video>
        
        <!-- Ultra-realistic 8K Feast Still Backdrop Layer (Scene 3) -->
        <div class="hero-bg-still" id="heroBgStill" style="background-image: url('assets/images/restaurant_hero_cinematic.jpg');"></div>

        <!-- Cinematic Editorial Film Vignette & Warm Natural Lighting Layers -->
        <div class="cinematic-film-grain"></div>
        <div class="hero-cinematic-vignette"></div>
        <div class="hero-warm-overlay"></div>
    </div>

    <!-- Ambient Gold Dust Floating Particles -->
    <canvas id="heroParticles" class="hero-particles-canvas"></canvas>



    <div class="container hero-container hero-compact-container">
        
        <div class="hero-mini-badge gsap-reveal">
            <i class="fa-solid fa-crown text-gold"></i> HOTEL NATARAJ • EST. 1998
        </div>

        <h1 class="hero-title hero-title-compact gsap-reveal">
            Royal <span class="gradient-text">Fine Dining</span> Experience
        </h1>

        <p class="hero-tagline gsap-reveal">
            Authentic Charcoal Tandoor • Hand-Ground Spices • Grand Banquet Celebrations
        </p>

        <div class="hero-buttons hero-buttons-compact gsap-reveal">
            <a href="menu.php" class="btn btn-gold magnetic-btn"><i class="fa-solid fa-utensils"></i> View Menu</a>
            <button class="btn btn-outline-light magnetic-btn" id="heroReserveBtn"><i class="fa-solid fa-calendar-check"></i> Book Table</button>
            <button class="btn btn-glass-play magnetic-btn" id="heroReelPlayBtn" title="Play 4K Reel"><i class="fa-solid fa-play text-gold"></i> <span>Reel</span></button>
        </div>

        <!-- Sleek Bottom Scene Switcher Strip -->
        <div class="hero-scene-bar gsap-reveal">
            <div class="scene-buttons-group">
                <button class="scene-pill active" data-scene="1" id="sceneBtn1">
                    <i class="fa-solid fa-hotel text-gold"></i> Ambiance
                </button>
                <button class="scene-pill" data-scene="2" id="sceneBtn2">
                    <i class="fa-solid fa-fire text-gold"></i> Live Chef
                </button>
                <button class="scene-pill" data-scene="3" id="sceneBtn3">
                    <i class="fa-solid fa-image text-gold"></i> Saffron Feast
                </button>
            </div>
        </div>

    </div>
</section>

<!-- Fullscreen Cinematic Theatre Modal -->
<div class="cinematic-theatre-modal" id="theatreModal" aria-hidden="true" role="dialog">
    <div class="theatre-backdrop" id="theatreBackdrop"></div>
    <div class="theatre-container">
        <button class="theatre-close-btn" id="theatreCloseBtn" aria-label="Close Theatre Mode">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="theatre-video-wrap">
            <video id="theatreVideo" controls playsinline poster="assets/images/restaurant_hero_cinematic.jpg">
                <source src="assets/videos/luxury_dining.webm" type="video/webm">
            </video>
            <div class="theatre-caption">
                <div class="theatre-caption-brand"><i class="fa-solid fa-crown text-gold"></i> HOTEL NATARAJ CINEMATIC REEL</div>
                <h3>Art of Royal Indian Gastronomy & Opulent Celebrations</h3>
                <p>From charcoal-fired clay tandoors to hand-ground masala gravies and hand-crafted saffron biryanis.</p>
            </div>
        </div>
    </div>
</div>

<!-- Visual Highlights Counter Bar with Scroll Trigger Count-Up -->
<section class="highlights-bar">
    <div class="container highlights-grid">
        <div class="highlight-box tilt-card" data-counter="25">
            <h2 class="highlight-number"><span class="counter-val">0</span>+</h2>
            <p class="highlight-label">Years of Culinary Excellence</p>
        </div>
        <div class="highlight-box tilt-card" data-counter="60">
            <h2 class="highlight-number"><span class="counter-val">0</span>+</h2>
            <p class="highlight-label">Signature Dishes & Delicacies</p>
        </div>
        <div class="highlight-box tilt-card" data-counter="300">
            <h2 class="highlight-number"><span class="counter-val">0</span></h2>
            <p class="highlight-label">Capacity Grand Banquet Hall</p>
        </div>
        <div class="highlight-box tilt-card" data-counter="100">
            <h2 class="highlight-number"><span class="counter-val">0</span>%</h2>
            <p class="highlight-label">Pure Desi Ghee & Fresh Spices</p>
        </div>
    </div>
</section>

<!-- Signature Dishes Showcase with 3D Parallax Tilt -->
<section class="section signature-section bg-light" id="signatureDishes">
    <div class="container">
        <div class="section-header text-center gsap-header">
            <span class="sub-heading"><i class="fa-solid fa-crown text-gold"></i> Chef's Selection</span>
            <h2 class="section-title">Our Signature Creations</h2>
            <p class="section-subtitle">Hand-picked delicacies crafted with authentic spices, rich creamy textures, and royal garnishes.</p>
        </div>

        <div class="dishes-grid">
            <?php foreach ($featuredItems as $dish): ?>
            <div class="dish-card tilt-card gsap-card-item" data-id="<?php echo $dish['id']; ?>" data-name="<?php echo htmlspecialchars($dish['name']); ?>" data-price="₹<?php echo number_format($dish['price'], 0); ?>" data-desc="<?php echo htmlspecialchars($dish['description']); ?>" data-img="<?php echo $dish['image_url']; ?>" data-category="<?php echo htmlspecialchars($dish['category_name'] ?? 'Specialty'); ?>" data-spice="<?php echo $dish['spice_level']; ?>">
                <div class="dish-img-wrapper">
                    <img src="<?php echo $dish['image_url']; ?>" alt="<?php echo htmlspecialchars($dish['name']); ?>" loading="lazy">
                    <span class="veg-badge"><i class="fa-solid fa-circle text-success"></i> Pure Veg</span>
                    <button class="quick-view-btn magnetic-btn"><i class="fa-solid fa-eye"></i> Quick View</button>
                </div>
                <div class="dish-content">
                    <div class="dish-header">
                        <h3 class="dish-name"><?php echo htmlspecialchars($dish['name']); ?></h3>
                        <span class="dish-price">₹<?php echo number_format($dish['price'], 0); ?></span>
                    </div>
                    <p class="dish-desc"><?php echo htmlspecialchars($dish['description']); ?></p>
                    <div class="dish-footer">
                        <span class="spice-level"><i class="fa-solid fa-pepper-hot"></i> <?php echo $dish['spice_level']; ?></span>
                        <a href="tel:9898989898" class="order-link pulse-hover"><i class="fa-solid fa-phone"></i> Order Now</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="menu.php" class="btn btn-gold btn-lg magnetic-btn glow-pulse"><i class="fa-solid fa-book-open"></i> View Full Royal Menu</a>
        </div>
    </div>
</section>

<!-- GRAND BANQUET HALL FEATURE SECTION WITH PARALLAX & GSAP -->
<section class="section banquet-section" id="banquetSection">
    <div class="container banquet-grid">
        <div class="banquet-image-card tilt-card gsap-left-reveal">
            <img src="assets/images/banquet_hall.jpg" alt="Hotel Nataraj Grand Banquet Hall" class="img-responsive open-lightbox-img" data-caption="Hotel Nataraj Grand Banquet Hall - Wedding & Party Venue">
            <div class="banquet-floating-badge">
                <i class="fa-solid fa-crown text-gold"></i>
                <span>Grand Banquet • 300+ Guests</span>
            </div>
        </div>
        <div class="banquet-info gsap-right-reveal">
            <span class="sub-heading"><i class="fa-solid fa-building-columns text-gold"></i> Celebrations & Events</span>
            <h2 class="section-title">Grand Banquet Hall at Hotel Nataraj</h2>
            <p class="banquet-desc">
                Make your special occasions memorable in our spacious, elegantly illuminated <strong>Grand Banquet Hall</strong>. Whether hosting a dream wedding reception, birthday party, corporate gala, or family reunion, we offer end-to-end luxury setup and custom catering.
            </p>

            <ul class="banquet-amenities">
                <li class="amenity-item"><i class="fa-solid fa-circle-check text-gold"></i> <strong>Seating Capacity:</strong> Up to 300+ Guests comfortably</li>
                <li class="amenity-item"><i class="fa-solid fa-circle-check text-gold"></i> <strong>Custom Buffet Catering:</strong> Pure Veg & Multi-Cuisine options</li>
                <li class="amenity-item"><i class="fa-solid fa-circle-check text-gold"></i> <strong>Modern Amenities:</strong> Central Air Conditioning, DJ Stage & Lighting</li>
                <li class="amenity-item"><i class="fa-solid fa-circle-check text-gold"></i> <strong>Dedicated Event Coordinator:</strong> Seamless planning & management</li>
            </ul>

            <div class="banquet-actions mt-4">
                <button class="btn btn-gold btn-lg magnetic-btn glow-btn" id="bookBanquetBtn"><i class="fa-solid fa-calendar-plus"></i> Inquire / Book Banquet</button>
                <a href="tel:9898989898" class="btn btn-outline-dark btn-lg magnetic-btn"><i class="fa-solid fa-phone text-gold"></i> Call 9898989898</a>
            </div>
        </div>
    </div>
</section>

<!-- Chef's Philosophy & Story -->
<section class="section story-section">
    <div class="container">
        <div class="story-card-wrapper">
            <div class="story-grid">
                <div class="story-content gsap-left-reveal">
                    <span class="sub-heading"><i class="fa-solid fa-heart text-gold"></i> Our Culinary Philosophy</span>
                    <h2 class="section-title">Crafting Pure Flavor With Passion & Tradition</h2>
                    
                    <div class="story-quote-box mt-3">
                        <i class="fa-solid fa-quote-left quote-icon"></i>
                        <p class="story-quote-text">
                            "At <strong>Hotel Nataraj</strong>, we believe every meal should be a celebration of authentic heritage, rich spices, and Indian hospitality."
                        </p>
                    </div>

                    <p class="story-body-text mt-3">
                        Our recipes have been refined over 25+ years, using authentic whole spices ground in-house every morning, churned pure cow ghee, and farm-fresh daily market ingredients.
                    </p>
                    <p class="story-body-text mt-2">
                        From our clay tandoor baked garlic naans to our slow-simmered 12-hour Dal Makhani, every dish is prepared under strict hygiene standards by our master chefs.
                    </p>

                    <div class="story-highlights mt-4">
                        <div class="story-pill pulse-hover"><i class="fa-solid fa-leaf text-success"></i> 100% Pure Vegetarian</div>
                        <div class="story-pill pulse-hover"><i class="fa-solid fa-mortar-pestle text-gold"></i> Hand-Ground Spices</div>
                        <div class="story-pill pulse-hover"><i class="fa-solid fa-hands-bubbles text-primary"></i> Hygiene Certified</div>
                    </div>
                </div>

                <div class="story-img-container gsap-right-reveal">
                    <div class="story-img-wrapper tilt-card">
                        <img src="assets/images/chef_story.jpg" alt="Master Chef at Hotel Nataraj" class="img-responsive rounded-card open-lightbox-img" data-caption="Master Chef garnishing authentic Indian delicacy">
                        
                        <div class="story-floating-badge">
                            <i class="fa-solid fa-award text-gold"></i>
                            <span>Master Chef Legacy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photo Gallery Visual Tour -->
<section class="section gallery-section">
    <div class="container">
        <div class="gallery-card-wrapper">
            <div class="section-header text-center gsap-header">
                <span class="sub-heading"><i class="fa-solid fa-camera text-gold"></i> Visual Tour & Ambiance</span>
                <h2 class="section-title">Hotel Nataraj Photo Showcase</h2>
                <p class="section-subtitle">Explore our fine dining atmosphere, grand banquet setup, and handcrafted signature dishes.</p>
            </div>

            <!-- Gallery Filter Buttons -->
            <div class="gallery-filter-tabs mt-4 mb-4 text-center">
                <button class="gallery-tab active" data-filter="all">All Photos</button>
                <button class="gallery-tab" data-filter="ambiance">Dining Ambiance</button>
                <button class="gallery-tab" data-filter="dishes">Signature Dishes</button>
                <button class="gallery-tab" data-filter="banquet">Banquet Hall</button>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item tilt-card gsap-gallery-item" data-category="ambiance">
                    <img src="assets/images/restaurant_interior.jpg" alt="Restaurant Interior" class="open-lightbox-img" data-caption="Main Dining Hall - Hotel Nataraj">
                    <div class="gallery-badge"><i class="fa-solid fa-sparkles text-gold"></i> Ambiance</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Full Screen</span>
                    </div>
                </div>

                <div class="gallery-item tilt-card gsap-gallery-item" data-category="dishes">
                    <img src="assets/images/paneer_tikka.jpg" alt="Paneer Tikka" class="open-lightbox-img" data-caption="Royal Tandoori Paneer Tikka">
                    <div class="gallery-badge"><i class="fa-solid fa-fire text-gold"></i> Starter</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Paneer Tikka</span>
                    </div>
                </div>

                <div class="gallery-item tilt-card gsap-gallery-item" data-category="banquet">
                    <img src="assets/images/banquet_hall.jpg" alt="Banquet Hall" class="open-lightbox-img" data-caption="Grand Banquet Hall for Celebrations">
                    <div class="gallery-badge"><i class="fa-solid fa-building-columns text-gold"></i> Banquet</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Banquet Hall</span>
                    </div>
                </div>

                <div class="gallery-item tilt-card gsap-gallery-item" data-category="dishes">
                    <img src="assets/images/biryani.jpg" alt="Shahi Biryani" class="open-lightbox-img" data-caption="Saffron Handi Dum Biryani">
                    <div class="gallery-badge"><i class="fa-solid fa-bowl-food text-gold"></i> Dum Biryani</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Shahi Biryani</span>
                    </div>
                </div>

                <div class="gallery-item tilt-card gsap-gallery-item" data-category="dishes">
                    <img src="assets/images/dal_makhani.jpg" alt="Dal Makhani" class="open-lightbox-img" data-caption="Special Dal Makhani & Garlic Naan">
                    <div class="gallery-badge"><i class="fa-solid fa-utensils text-gold"></i> Main Course</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Dal Makhani</span>
                    </div>
                </div>

                <div class="gallery-item tilt-card gsap-gallery-item" data-category="dishes">
                    <img src="assets/images/drinks.jpg" alt="Mocktails" class="open-lightbox-img" data-caption="Royal Rose Blossom & Mango Panna">
                    <div class="gallery-badge"><i class="fa-solid fa-wine-glass text-gold"></i> Mocktails</div>
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>View Drinks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section (UPGRADED LUXURY CARD WRAPPER) -->
<section class="section testimonials-section">
    <div class="container">
        <div class="testimonial-card-wrapper">
            <div class="section-header text-center gsap-header">
                <span class="sub-heading"><i class="fa-solid fa-quote-left text-gold"></i> Guest Stories & Reviews</span>
                <h2 class="section-title">What Our Guests Say</h2>
                <p class="section-subtitle">Real experiences from our valued diners and event hosts at Hotel Nataraj.</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card tilt-card gsap-testimonial-item">
                    <div class="testimonial-header">
                        <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        <span class="verified-badge"><i class="fa-solid fa-circle-check text-success"></i> Verified Diner</span>
                    </div>
                    <p class="testimonial-text">"Hotel Nataraj's Dal Makhani and Garlic Naan are unmatched in the city! We also hosted our daughter's birthday party in their Banquet Hall — flawless arrangements and wonderful food!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <strong>Ramesh Patel</strong>
                            <span>Local Resident & Regular Guest</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card tilt-card gsap-testimonial-item">
                    <div class="testimonial-header">
                        <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        <span class="verified-badge"><i class="fa-solid fa-circle-check text-success"></i> Food Critic</span>
                    </div>
                    <p class="testimonial-text">"Clean, bright, luxury dining ambiance. The Paneer Tikka was melt-in-mouth soft and spiced perfectly. Highly recommend reserving a table in advance!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fa-solid fa-pen-nib"></i></div>
                        <div>
                            <strong>Ananya Sharma</strong>
                            <span>Food Blogger & Reviewer</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card tilt-card gsap-testimonial-item">
                    <div class="testimonial-header">
                        <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        <span class="verified-badge"><i class="fa-solid fa-circle-check text-success"></i> Banquet Client</span>
                    </div>
                    <p class="testimonial-text">"The Banquet Hall is spacious with grand chandeliers. They accommodated our 200+ wedding reception guests smoothly with top-notch catering service."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fa-solid fa-glass-water-droplet"></i></div>
                        <div>
                            <strong>Vikram Joshi</strong>
                            <span>Banquet Event Client</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Reservation Callout Banner (UPGRADED GOLD-GLOW CARD WRAPPER) -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-card-wrapper glow-banner">
            <div class="cta-flex">
                <div class="cta-text">
                    <span class="cta-badge"><i class="fa-solid fa-crown text-gold"></i> INSTANT RESERVATION HOTLINE</span>
                    <h2 class="mt-2">Ready to Taste Culinary Excellence?</h2>
                    <p class="mt-2">Call us directly on <a href="tel:9898989898" class="text-gold font-weight-bold pulse-hover">9898989898</a> or reserve your table online in seconds.</p>
                </div>
                <div class="cta-btn-group">
                    <button class="btn btn-gold btn-lg magnetic-btn glow-pulse" id="ctaReserveBtn"><i class="fa-solid fa-calendar-check"></i> Reserve Table Now</button>
                    <a href="tel:9898989898" class="btn btn-white btn-lg magnetic-btn"><i class="fa-solid fa-phone text-gold"></i> Call 9898989898</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
