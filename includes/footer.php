    <!-- Footer Section (Luxury Redesign - UI-UX Pro Max) -->
    <footer class="site-footer">
        <div class="container">
            
            <!-- Footer Brand & Header -->
            <div class="footer-brand-hero">
                <div class="footer-brand-badge">
                    <i class="fa-solid fa-crown text-gold"></i> HOTEL NATARAJ &bull; EST. 1998
                </div>
                <h3 class="footer-brand-heading">Royal Fine Dining &amp; Grand Banquet</h3>
                <p class="footer-brand-tagline">Authentic charcoal tandoor, slow-cooked royal gravies, and grand celebratory banquets.</p>
                
                <div class="footer-social-row">
                    <a href="#" class="social-chip" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://wa.me/9898989898" class="social-chip" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="social-chip" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-chip" aria-label="TripAdvisor"><i class="fa-brands fa-tripadvisor"></i></a>
                </div>
            </div>

            <!-- Footer Modular Cards Grid -->
            <div class="footer-cards-grid">
                
                <!-- Card 1: Navigation Chips -->
                <div class="footer-card">
                    <h4 class="footer-card-title"><i class="fa-solid fa-compass text-gold"></i> Explore</h4>
                    <div class="footer-nav-chips">
                        <a href="index.php" class="nav-chip"><i class="fa-solid fa-house"></i> Home</a>
                        <a href="menu.php" class="nav-chip"><i class="fa-solid fa-utensils"></i> Royal Menu</a>
                        <a href="index.php#banquetSection" class="nav-chip"><i class="fa-solid fa-building-columns"></i> Banquet Hall</a>
                        <a href="about.php" class="nav-chip"><i class="fa-solid fa-circle-info"></i> Our Legacy</a>
                        <a href="contact.php" class="nav-chip"><i class="fa-solid fa-envelope"></i> Contact</a>
                        <a href="admin.php" class="nav-chip nav-chip-gold"><i class="fa-solid fa-database"></i> DB Manager</a>
                    </div>
                </div>

                <!-- Card 2: Operating Hours -->
                <div class="footer-card">
                    <h4 class="footer-card-title"><i class="fa-solid fa-clock text-gold"></i> Service Hours</h4>
                    <div class="hours-compact-list">
                        <div class="hours-row">
                            <span class="hours-title">Lunch Service:</span>
                            <span class="hours-time">11:00 AM &ndash; 3:30 PM</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-title">Dinner Service:</span>
                            <span class="hours-time">7:00 PM &ndash; 11:30 PM</span>
                        </div>
                        <div class="hours-badge">
                            <i class="fa-solid fa-circle-check text-gold"></i> Open All 7 Days &bull; Valet Parking
                        </div>
                    </div>
                </div>

                <!-- Card 3: Reach & Reservations -->
                <div class="footer-card">
                    <h4 class="footer-card-title"><i class="fa-solid fa-phone-volume text-gold"></i> Direct Contact</h4>
                    <div class="footer-contact-compact">
                        <a href="tel:9898989898" class="contact-cta-chip">
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <small>Call Hotline / Booking</small>
                                <strong>9898989898</strong>
                            </div>
                        </a>
                        <div class="contact-address-text">
                            <i class="fa-solid fa-location-dot text-gold"></i>
                            <span>124 Heritage Royal Road, Near City Center</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom-bar">
                <p class="copyright-text">&copy; <?php echo date('Y'); ?> Hotel Nataraj. All Rights Reserved.</p>
                <div class="footer-quality-tags">
                    <span>100% Pure Ghee</span> &bull; <span>Clay Tandoor</span> &bull; <span>Opulent Banquets</span>
                </div>
                <button class="back-to-top-btn" id="backToTopBtn" aria-label="Back to Top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
                    <i class="fa-solid fa-arrow-up"></i> Top
                </button>
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
