<?php
require_once __DIR__ . '/config/db.php';
include __DIR__ . '/includes/header.php';
?>

<!-- Banner -->
<section class="page-banner">
    <div class="container text-center">
        <span class="sub-heading"><i class="fa-solid fa-crown text-gold"></i> Get In Touch</span>
        <h1 class="page-title">Contact & Reservations</h1>
        <p class="page-subtitle">We are delighted to welcome you to Hotel Nataraj. Reach out for table reservations or banquet bookings.</p>
    </div>
</section>

<!-- Contact Grid Section -->
<section class="section contact-section">
    <div class="container">
        <div class="contact-card-wrapper">
            <div class="contact-grid">

                <!-- Contact Information Cards -->
                <div class="contact-info-wrapper gsap-left-reveal">
                    <span class="sub-heading"><i class="fa-solid fa-phone text-gold"></i> Direct Concierge</span>
                    <h2 class="section-title">Reach Hotel Nataraj</h2>
                    <p class="mb-4 text-muted">Have questions about our menu, delivery, or booking our Grand Banquet Hall? Call or visit us today!</p>

                    <div class="info-card tilt-card">
                        <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h4>Call Hotline</h4>
                            <p><a href="tel:9898989898" class="text-gold font-weight-bold" style="font-size: 1.25rem;">9898989898</a></p>
                            <small>Table Reservations, Home Delivery, & Banquet Inquiries</small>
                        </div>
                    </div>

                    <div class="info-card tilt-card mt-3">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h4>Restaurant Location</h4>
                            <p>124 Heritage Royal Road, Near City Center, Main Avenue</p>
                            <small>Valet Parking Available for Dining & Banquet Guests</small>
                        </div>
                    </div>

                    <div class="info-card tilt-card mt-3">
                        <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <h4>Opening Hours</h4>
                            <p>Open 7 Days a Week: <strong>11:00 AM – 11:30 PM</strong></p>
                            <small>Lunch: 11:00 AM - 3:30 PM | Dinner: 7:00 PM - 11:30 PM</small>
                        </div>
                    </div>

                    <div class="info-card tilt-card mt-3">
                        <div class="info-icon"><i class="fa-solid fa-building-columns"></i></div>
                        <div>
                            <h4>Grand Banquet Hall</h4>
                            <p>Direct Booking Hotline: <strong>9898989898</strong></p>
                            <small>Air-conditioned hall with 300+ guests capacity & catering</small>
                        </div>
                    </div>
                </div>

                <!-- Contact & Reservation Forms Box -->
                <div class="contact-form-card gsap-right-reveal">
                    <div class="form-tabs-bar">
                        <button class="form-tab active" id="tabReservation">Table / Banquet Booking</button>
                        <button class="form-tab" id="tabInquiry">General Message</button>
                    </div>

                    <!-- Reservation Form -->
                    <form id="contactReservationForm" class="contact-form-body active">
                        <h3 class="form-box-title"><i class="fa-solid fa-calendar-check text-gold"></i> Instant Table or Banquet Reservation</h3>
                        <p class="form-box-sub mb-3">Fill out your preferred date and guests. We will confirm your reservation promptly.</p>

                        <div class="form-group">
                            <label for="cBookingType">Booking Type *</label>
                            <select id="cBookingType" name="booking_type" class="form-control" required>
                                <option value="Dining Table">Dining Table Reservation</option>
                                <option value="Banquet Hall">Grand Banquet Hall Booking</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cGuestName">Full Name *</label>
                                <input type="text" id="cGuestName" name="guest_name" class="form-control" placeholder="e.g. Ramesh Patel" required>
                            </div>
                            <div class="form-group">
                                <label for="cPhone">Phone Number *</label>
                                <input type="tel" id="cPhone" name="phone" class="form-control" value="9898989898" placeholder="e.g. 9898989898" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cGuests">Guests Count *</label>
                                <select id="cGuests" name="guests_count" class="form-control" required>
                                    <option value="2">2 Guests</option>
                                    <option value="4" selected>4 Guests</option>
                                    <option value="6">6 Guests</option>
                                    <option value="12">8-12 Guests</option>
                                    <option value="50">50+ Guests (Small Banquet)</option>
                                    <option value="200">100-300 Guests (Grand Banquet)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cDate">Date *</label>
                                <input type="date" id="cDate" name="reservation_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cTime">Preferred Time *</label>
                            <select id="cTime" name="reservation_time" class="form-control" required>
                                <option value="12:30:00">12:30 PM (Lunch)</option>
                                <option value="13:30:00">01:30 PM (Lunch)</option>
                                <option value="19:30:00" selected>07:30 PM (Dinner)</option>
                                <option value="20:30:00">08:30 PM (Dinner)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cRequest">Special Request</label>
                            <textarea id="cRequest" name="special_request" class="form-control" rows="2" placeholder="Any special seating preferences, birthday cake, or banquet requirements..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 magnetic-btn glow-pulse"><i class="fa-solid fa-paper-plane"></i> Submit Reservation</button>
                        <div id="contactReserveFeedback" class="form-feedback mt-3"></div>
                    </form>

                    <!-- General Message Form -->
                    <form id="contactInquiryForm" class="contact-form-body d-none">
                        <h3 class="form-box-title"><i class="fa-solid fa-envelope text-gold"></i> Send Us a Message</h3>
                        <p class="form-box-sub mb-3">Have feedback, catering inquiries, or general questions?</p>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="inqName">Name *</label>
                                <input type="text" id="inqName" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="inqPhone">Phone *</label>
                                <input type="tel" id="inqPhone" name="phone" class="form-control" value="9898989898" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inqSubject">Subject *</label>
                            <input type="text" id="inqSubject" name="subject" class="form-control" placeholder="e.g. Catering Enquiry / Feedback" required>
                        </div>

                        <div class="form-group">
                            <label for="inqMessage">Your Message *</label>
                            <textarea id="inqMessage" name="message" class="form-control" rows="4" placeholder="Write your message here..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 magnetic-btn glow-pulse"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
                        <div id="contactInquiryFeedback" class="form-feedback mt-3"></div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- Location Map Visual -->
<section class="section map-section">
    <div class="container">
        <div class="map-card-wrapper text-center">
            <span class="sub-heading"><i class="fa-solid fa-map-location-dot text-gold"></i> Find Us Easily</span>
            <h2 class="section-title">Hotel Nataraj Location Map</h2>
            <p class="section-subtitle">Conveniently situated at 124 Heritage Royal Road, Near City Center with dedicated valet parking.</p>

            <div class="map-card-container mt-4">
                <div class="map-placeholder-card tilt-card">
                    <div class="map-info-box">
                        <i class="fa-solid fa-location-dot text-gold fa-2x mb-2"></i>
                        <h3>Hotel Nataraj</h3>
                        <p>124 Heritage Royal Road, Near City Center</p>
                        <p class="text-gold font-weight-bold mt-1">Direct Call: 9898989898</p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-outline-dark btn-sm mt-3 magnetic-btn"><i class="fa-solid fa-route"></i> Open Directions in Google Maps</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
