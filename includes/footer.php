    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-col brand-col">
                <div class="footer-logo">
                    <i class="fa-solid fa-utensils text-gold"></i>
                    <span class="brand-name">Hotel Nataraj</span>
                </div>
                <p class="footer-desc">
                    Experience authentic Indian culinary legacy, slow-cooked royal gravies, clay-oven tandoor delights, and grand banquet celebrations crafted with warmth and elegance.
                </p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" aria-label="TripAdvisor"><i class="fa-brands fa-tripadvisor"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-menu">
                    <li><a href="index.php"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
                    <li><a href="menu.php"><i class="fa-solid fa-chevron-right"></i> Royal Menu</a></li>
                    <li><a href="index.php#banquetSection"><i class="fa-solid fa-chevron-right"></i> Banquet Hall</a></li>
                    <li><a href="about.php"><i class="fa-solid fa-chevron-right"></i> Our Story & Legacy</a></li>
                    <li><a href="contact.php"><i class="fa-solid fa-chevron-right"></i> Contact & Location</a></li>
                    <li><a href="admin.php"><i class="fa-solid fa-database text-gold"></i> Database Manager</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-title">Opening Hours</h4>
                <div class="hours-box">
                    <p><strong>Lunch Service:</strong><br>11:00 AM – 3:30 PM</p>
                    <p class="mt-2"><strong>Dinner Service:</strong><br>7:00 PM – 11:30 PM</p>
                    <p class="mt-2 text-gold"><strong>Open All 7 Days a Week</strong></p>
                </div>
            </div>

            <div class="footer-col contact-col">
                <h4 class="footer-title">Reach Us</h4>
                <ul class="contact-info">
                    <li>
                        <i class="fa-solid fa-location-dot text-gold"></i>
                        <span>124 Heritage Royal Road, Near City Center, Main Avenue</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone text-gold"></i>
                        <a href="tel:9898989898"><strong>9898989898</strong></a>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope text-gold"></i>
                        <a href="mailto:info@hotelnataraj.com">info@hotelnataraj.com</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-building-columns text-gold"></i>
                        <span>Banquet Hall Bookings: <strong>9898989898</strong></span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-flex">
                <p>&copy; <?php echo date('Y'); ?> Hotel Nataraj. All Rights Reserved. Crafted with Culinary Excellence.</p>
                <div class="footer-tags">
                    <span>Authentic Flavor</span> • <span>Pure Ghee</span> • <span>Grand Celebrations</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Table & Banquet Reservation Modal -->
    <div class="modal-backdrop" id="reserveModal">
        <div class="modal-card">
            <button class="modal-close" id="closeReserveModal">&times;</button>
            <div class="modal-header">
                <span class="modal-badge"><i class="fa-solid fa-crown text-gold"></i> Hotel Nataraj</span>
                <h3 class="modal-title">Reserve a Table / Book Banquet</h3>
                <p class="modal-sub">Confirm your dining experience or grand event instantly</p>
            </div>
            <form id="reservationForm" class="modal-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="modalBookingType">Booking Type</label>
                        <select id="modalBookingType" name="booking_type" class="form-control" required>
                            <option value="Dining Table">Dining Table Reservation</option>
                            <option value="Banquet Hall">Grand Banquet Hall Booking</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="modalGuests">Number of Guests</label>
                        <select id="modalGuests" name="guests_count" class="form-control" required>
                            <option value="2">2 Guests (Couple Table)</option>
                            <option value="4" selected>4 Guests (Family Table)</option>
                            <option value="6">6 Guests (Group)</option>
                            <option value="10">8-12 Guests (Large Family)</option>
                            <option value="50">50+ Guests (Small Banquet)</option>
                            <option value="200">100-300 Guests (Grand Banquet)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="modalName">Your Full Name *</label>
                        <input type="text" id="modalName" name="guest_name" class="form-control" placeholder="e.g. Rajesh Kumar" required>
                    </div>
                    <div class="form-group">
                        <label for="modalPhone">Phone Number *</label>
                        <input type="tel" id="modalPhone" name="phone" class="form-control" placeholder="e.g. 9898989898" value="9898989898" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="modalDate">Preferred Date *</label>
                        <input type="date" id="modalDate" name="reservation_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="modalTime">Preferred Time *</label>
                        <select id="modalTime" name="reservation_time" class="form-control" required>
                            <option value="12:30:00">12:30 PM (Lunch)</option>
                            <option value="13:30:00">01:30 PM (Lunch)</option>
                            <option value="19:30:00" selected>07:30 PM (Dinner)</option>
                            <option value="20:30:00">08:30 PM (Dinner)</option>
                            <option value="21:30:00">09:30 PM (Dinner)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="modalRequest">Special Requests / Event Details</label>
                    <textarea id="modalRequest" name="special_request" class="form-control" rows="2" placeholder="Anniversary celebration, window table, preferred food items, etc."></textarea>
                </div>

                <button type="submit" class="btn btn-gold w-100" id="submitReserveBtn">
                    <i class="fa-solid fa-paper-plane"></i> Confirm Reservation
                </button>
                <div id="reserveFeedback" class="form-feedback mt-3"></div>
            </form>
        </div>
    </div>

    <!-- Dish Detail Quick View Modal -->
    <div class="modal-backdrop" id="dishModal">
        <div class="modal-card dish-modal-card">
            <button class="modal-close" id="closeDishModal">&times;</button>
            <div class="dish-modal-grid">
                <div class="dish-modal-img">
                    <img id="dishModalImg" src="" alt="Dish Image">
                    <span id="dishModalBadge" class="dish-badge">Pure Veg</span>
                </div>
                <div class="dish-modal-details">
                    <span id="dishModalCategory" class="text-gold text-uppercase fw-600">Starters</span>
                    <h3 id="dishModalTitle" class="dish-modal-title">Royal Paneer Tikka</h3>
                    <div class="dish-modal-meta">
                        <span id="dishModalPrice" class="dish-price">₹340</span>
                        <span id="dishModalSpice" class="spice-pill"><i class="fa-solid fa-pepper-hot"></i> Medium Spice</span>
                    </div>
                    <p id="dishModalDesc" class="dish-modal-desc mt-3">Delicious gourmet preparation cooked fresh to order.</p>
                    
                    <div class="dish-features mt-3">
                        <div><i class="fa-solid fa-shield-halved text-gold"></i> 100% Hygienic</div>
                        <div><i class="fa-solid fa-fire text-gold"></i> Clay Tandoor Cooked</div>
                        <div><i class="fa-solid fa-leaf text-gold"></i> Pure Ingredients</div>
                    </div>

                    <div class="dish-actions mt-4">
                        <a href="tel:9898989898" class="btn btn-gold"><i class="fa-solid fa-phone"></i> Order via Phone (9898989898)</a>
                        <button class="btn btn-outline-gold" id="dishModalReserveBtn"><i class="fa-solid fa-calendar"></i> Book Table to Taste</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Image Lightbox Modal -->
    <div class="lightbox-backdrop" id="lightboxModal">
        <button class="lightbox-close" id="closeLightbox">&times;</button>
        <div class="lightbox-content">
            <img id="lightboxImg" src="" alt="Gallery Preview">
            <p id="lightboxCaption" class="lightbox-caption"></p>
        </div>
    </div>

    <!-- Mobile Bottom Floating Navigation Bar (Thumb Zone UX) -->
    <nav class="mobile-bottom-bar" id="mobileBottomBar" aria-label="Mobile Navigation">
        <a href="index.php" class="mobile-bar-item <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="menu.php" class="mobile-bar-item <?php echo basename($_SERVER['PHP_SELF']) === 'menu.php' ? 'active' : ''; ?>">
            <i class="fa-solid fa-utensils"></i>
            <span>Menu</span>
        </a>
        <button class="mobile-bar-item mobile-bar-cta" id="mobileBarReserveBtn">
            <div class="cta-inner">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <span>Book Table</span>
        </button>
        <a href="tel:9898989898" class="mobile-bar-item">
            <i class="fa-solid fa-phone"></i>
            <span>Call</span>
        </a>
        <a href="contact.php" class="mobile-bar-item <?php echo basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : ''; ?>">
            <i class="fa-solid fa-location-dot"></i>
            <span>Location</span>
        </a>
    </nav>

    <!-- Custom JS -->
    <script src="js/app.js"></script>
</body>
</html>
