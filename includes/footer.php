    <!-- Clean Minimal Luxury Footer -->
    <footer class="site-footer">
        <div class="container footer-clean-wrap">
            
            <!-- Brand Logo & Tagline -->
            <div class="footer-clean-brand">
                <a href="index.php" class="brand-logo footer-logo-clean">
                    <div class="logo-icon spin-glow">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div class="logo-text">
                        <span class="brand-name">Hotel Nataraj</span>
                        <span class="brand-sub">FINE DINING &bull; BANQUET</span>
                    </div>
                </a>
                <p class="footer-clean-tagline">Royal Indian gastronomy, charcoal clay tandoor delicacies, and grand celebrations.</p>
            </div>

            <!-- Clean Navigation Links -->
            <nav class="footer-clean-nav">
                <a href="index.php">Home</a>
                <a href="menu.php">Menu</a>
                <a href="index.php#banquetSection">Banquet</a>
                <a href="about.php">Our Story</a>
                <a href="contact.php">Contact</a>
                <a href="admin.php" class="text-gold">DB Manager</a>
            </nav>

            <!-- Key Info Bar (Contact & Hours) -->
            <div class="footer-clean-info">
                <a href="tel:9898989898" class="info-pill"><i class="fa-solid fa-phone text-gold"></i> 9898989898</a>
                <span class="info-pill"><i class="fa-solid fa-location-dot text-gold"></i> City Center, Main Avenue</span>
                <span class="info-pill"><i class="fa-solid fa-clock text-gold"></i> 11:00 AM &ndash; 11:30 PM Daily</span>
            </div>

            <!-- Social Links -->
            <div class="footer-clean-socials">
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/9898989898" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            </div>

            <!-- Bottom Copyright -->
            <div class="footer-clean-bottom">
                <p>&copy; <?php echo date('Y'); ?> Hotel Nataraj. All rights reserved.</p>
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



    <!-- Custom JS -->
    <script src="js/app.js"></script>
</body>
</html>
