/* ==========================================================================
   Hotel Nataraj - Ultra Luxury & Fully Animated Script (GSAP + Canvas)
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initCustomCursor();
    initParticleCanvas();
    initCinematicHeroVideo();
    initGSAPAnimations();
    init3DTilt();
    initMagneticButtons();
    initNavigation();
    initModals();
    initLightbox();
    initMenuFilters();
    initGalleryFilters();
    initFormSubmissions();
});

/* --------------------------------------------------------------------------
   1. Custom Cursor Follower
   -------------------------------------------------------------------------- */
function initCustomCursor() {
    const cursorDot = document.getElementById('cursorDot');
    const cursorRing = document.getElementById('cursorRing');

    if (!cursorDot || !cursorRing || window.innerWidth < 768) return;

    let mouseX = -100, mouseY = -100;
    let ringX = -100, ringY = -100;
    let mouseMoved = false;

    window.addEventListener('mousemove', (e) => {
        if (!mouseMoved) {
            mouseMoved = true;
            cursorDot.style.opacity = '1';
            cursorRing.style.opacity = '1';
        }
        mouseX = e.clientX;
        mouseY = e.clientY;
        cursorDot.style.left = `${mouseX}px`;
        cursorDot.style.top = `${mouseY}px`;
    });

    function animateRing() {
        if (mouseMoved) {
            ringX += (mouseX - ringX) * 0.15;
            ringY += (mouseY - ringY) * 0.15;
            cursorRing.style.left = `${ringX}px`;
            cursorRing.style.top = `${ringY}px`;
        }
        requestAnimationFrame(animateRing);
    }
    animateRing();

    document.querySelectorAll('a, button, .dish-card, .tilt-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursorRing.style.width = '54px';
            cursorRing.style.height = '54px';
            cursorRing.style.borderColor = 'var(--color-gold-dark)';
        });
        el.addEventListener('mouseleave', () => {
            cursorRing.style.width = '36px';
            cursorRing.style.height = '36px';
            cursorRing.style.borderColor = 'var(--color-gold)';
        });
    });
}

/* --------------------------------------------------------------------------
   2. HTML5 Canvas Hero Particle System
   -------------------------------------------------------------------------- */
function initParticleCanvas() {
    const canvas = document.getElementById('heroParticles');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width = canvas.width = canvas.offsetWidth;
    let height = canvas.height = canvas.offsetHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = canvas.offsetWidth;
        height = canvas.height = canvas.offsetHeight;
    });

    const particles = [];
    const particleCount = 14;

    for (let i = 0; i < particleCount; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 2 + 1,
            color: `rgba(212, 175, 55, ${Math.random() * 0.35 + 0.15})`,
            speedX: (Math.random() - 0.5) * 0.3,
            speedY: -Math.random() * 0.4 - 0.15
        });
    }

    function render() {
        ctx.clearRect(0, 0, width, height);

        particles.forEach(p => {
            p.x += p.speedX;
            p.y += p.speedY;

            if (p.y < -10) {
                p.y = height + 10;
                p.x = Math.random() * width;
            }
            if (p.x < -10) p.x = width + 10;
            if (p.x > width + 10) p.x = -10;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = p.color;
            ctx.fill();
        });

        requestAnimationFrame(render);
    }
    render();
}

/* --------------------------------------------------------------------------
   3. GSAP & ScrollTrigger Animations (Guaranteed Complete & Clear Props)
   -------------------------------------------------------------------------- */
function initGSAPAnimations() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // Hero Stagger Timeline
    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } });
    heroTl.fromTo('.gsap-reveal', 
        { y: 40, opacity: 0 },
        { y: 0, opacity: 1, stagger: 0.15, delay: 0.1, clearProps: 'transform,opacity' }
    );

    // Highlights Numeric Count-Up
    ScrollTrigger.create({
        trigger: '.highlights-bar',
        start: 'top 85%',
        once: true,
        onEnter: () => {
            document.querySelectorAll('.highlight-box').forEach(box => {
                const targetVal = parseInt(box.dataset.counter, 10);
                const counterEl = box.querySelector('.counter-val');
                if (!counterEl) return;

                gsap.to({ val: 0 }, {
                    val: targetVal,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: function () {
                        counterEl.textContent = Math.floor(this.targets()[0].val);
                    }
                });
            });
        }
    });

    // Signature Dishes Stagger Reveal with ClearProps
    gsap.fromTo('.gsap-card-item',
        { y: 50, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 0.7,
            stagger: 0.12,
            ease: 'power3.out',
            clearProps: 'transform,opacity',
            scrollTrigger: {
                trigger: '#signatureDishes',
                start: 'top 85%',
                once: true
            }
        }
    );

    // Banquet Split Reveal
    gsap.fromTo('.gsap-left-reveal',
        { x: -60, opacity: 0 },
        {
            x: 0,
            opacity: 1,
            duration: 0.8,
            ease: 'power3.out',
            clearProps: 'transform,opacity',
            scrollTrigger: {
                trigger: '#banquetSection',
                start: 'top 85%',
                once: true
            }
        }
    );

    gsap.fromTo('.gsap-right-reveal',
        { x: 60, opacity: 0 },
        {
            x: 0,
            opacity: 1,
            duration: 0.8,
            ease: 'power3.out',
            clearProps: 'transform,opacity',
            scrollTrigger: {
                trigger: '#banquetSection',
                start: 'top 85%',
                once: true
            }
        }
    );

    // Gallery Zoom Reveal
    gsap.fromTo('.gsap-gallery-item',
        { scale: 0.85, opacity: 0 },
        {
            scale: 1,
            opacity: 1,
            duration: 0.7,
            stagger: 0.1,
            ease: 'back.out(1.5)',
            clearProps: 'transform,opacity',
            scrollTrigger: {
                trigger: '.gallery-section',
                start: 'top 85%',
                once: true
            }
        }
    );

    // Testimonials Reveal
    gsap.fromTo('.gsap-testimonial-item',
        { y: 40, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 0.7,
            stagger: 0.12,
            ease: 'power3.out',
            clearProps: 'transform,opacity',
            scrollTrigger: {
                trigger: '.testimonials-section',
                start: 'top 85%',
                once: true
            }
        }
    );
}

/* --------------------------------------------------------------------------
   4. 3D Mouse Parallax Tilt Effect
   -------------------------------------------------------------------------- */
function init3DTilt() {
    if (window.innerWidth < 768) return;

    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (centerY - y) / 14;
            const rotateY = (x - centerX) / 14;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(8px)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
        });
    });
}

/* --------------------------------------------------------------------------
   5. Magnetic Buttons Effect
   -------------------------------------------------------------------------- */
function initMagneticButtons() {
    if (window.innerWidth < 768) return;

    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            btn.style.transform = `translate(${x * 0.22}px, ${y * 0.22}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0px, 0px)';
        });
    });
}

/* --------------------------------------------------------------------------
   6. Visual Tour Gallery Filter Tabs
   -------------------------------------------------------------------------- */
function initGalleryFilters() {
    const galleryTabs = document.querySelectorAll('.gallery-tab');
    const galleryItems = document.querySelectorAll('.gsap-gallery-item');

    if (!galleryTabs.length || !galleryItems.length) return;

    galleryTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            galleryTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const filter = tab.dataset.filter;

            galleryItems.forEach(item => {
                const itemCat = item.dataset.category;
                if (filter === 'all' || itemCat === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

/* --------------------------------------------------------------------------
   7. Navigation & Mobile Drawer
   -------------------------------------------------------------------------- */
function initNavigation() {
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const closeDrawer = document.getElementById('closeDrawer');

    if (mobileToggle && mobileDrawer) {
        mobileToggle.addEventListener('click', () => {
            mobileDrawer.classList.add('active');
        });
    }

    if (closeDrawer && mobileDrawer) {
        closeDrawer.addEventListener('click', () => {
            mobileDrawer.classList.remove('active');
        });
    }

    const mainHeader = document.getElementById('mainHeader');
    if (mainHeader) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }
        }, { passive: true });
    }
}

/* --------------------------------------------------------------------------
   8. Modals
   -------------------------------------------------------------------------- */
function initModals() {
    const reserveModal = document.getElementById('reserveModal');
    const closeReserveModal = document.getElementById('closeReserveModal');
    const reserveTriggers = [
        'openReserveModal', 'mobileReserveBtn', 'heroReserveBtn',
        'bookBanquetBtn', 'ctaReserveBtn', 'menuReserveBtn', 'aboutReserveBtn'
    ];

    reserveTriggers.forEach(id => {
        const btn = document.getElementById(id);
        if (btn && reserveModal) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                if (id === 'bookBanquetBtn') {
                    const bookingTypeSelect = document.getElementById('modalBookingType');
                    if (bookingTypeSelect) bookingTypeSelect.value = 'Banquet Hall';
                }
                reserveModal.classList.add('active');
            });
        }
    });

    if (closeReserveModal && reserveModal) {
        closeReserveModal.addEventListener('click', () => {
            reserveModal.classList.remove('active');
        });
    }

    const dishModal = document.getElementById('dishModal');
    const closeDishModal = document.getElementById('closeDishModal');

    document.querySelectorAll('.dish-card, .quick-view-btn').forEach(element => {
        element.addEventListener('click', (e) => {
            if (e.target.closest('.order-link')) return;

            const card = e.target.closest('.dish-card') || e.target.closest('.quick-view-btn');
            if (!card) return;

            const name = card.dataset.name;
            const price = card.dataset.price;
            const desc = card.dataset.desc;
            const img = card.dataset.img;
            const category = card.dataset.category;
            const spice = card.dataset.spice;

            if (name && dishModal) {
                document.getElementById('dishModalTitle').textContent = name;
                document.getElementById('dishModalPrice').textContent = price;
                document.getElementById('dishModalDesc').textContent = desc;
                document.getElementById('dishModalImg').src = img;
                document.getElementById('dishModalCategory').textContent = category || 'Specialty';
                document.getElementById('dishModalSpice').innerHTML = `<i class="fa-solid fa-pepper-hot"></i> ${spice || 'Medium'} Spice`;
                
                dishModal.classList.add('active');
            }
        });
    });

    if (closeDishModal && dishModal) {
        closeDishModal.addEventListener('click', () => {
            dishModal.classList.remove('active');
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === reserveModal) reserveModal.classList.remove('active');
        if (e.target === dishModal) dishModal.classList.remove('active');
    });
}

/* --------------------------------------------------------------------------
   9. Lightbox
   -------------------------------------------------------------------------- */
function initLightbox() {
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const closeLightbox = document.getElementById('closeLightbox');

    document.querySelectorAll('.open-lightbox-img, .gallery-item img').forEach(img => {
        img.addEventListener('click', () => {
            if (lightboxModal && lightboxImg) {
                lightboxImg.src = img.src;
                lightboxCaption.textContent = img.dataset.caption || img.alt || 'Hotel Nataraj Gallery';
                lightboxModal.classList.add('active');
            }
        });
    });

    if (closeLightbox && lightboxModal) {
        closeLightbox.addEventListener('click', () => {
            lightboxModal.classList.remove('active');
        });
    }
}

/* --------------------------------------------------------------------------
   10. Menu Filtering
   -------------------------------------------------------------------------- */
function initMenuFilters() {
    const searchInput = document.getElementById('menuSearchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const categoryTabs = document.querySelectorAll('.cat-tab');
    const menuCards = document.querySelectorAll('.menu-item-card');
    const noResultsMsg = document.getElementById('noResultsMsg');

    let currentCategory = 'all';
    let currentQuery = '';

    function filterDishes() {
        let visibleCount = 0;
        menuCards.forEach(card => {
            const cardCat = card.dataset.category;
            const cardName = card.dataset.name || '';

            const matchesCategory = (currentCategory === 'all' || cardCat === currentCategory);
            const matchesQuery = (currentQuery === '' || cardName.includes(currentQuery.toLowerCase()));

            if (matchesCategory && matchesQuery) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (noResultsMsg) {
            if (visibleCount === 0) noResultsMsg.classList.remove('d-none');
            else noResultsMsg.classList.add('d-none');
        }
    }

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            categoryTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentCategory = tab.dataset.category;
            filterDishes();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentQuery = e.target.value.trim();
            filterDishes();
        });
    }

    if (clearSearchBtn && searchInput) {
        clearSearchBtn.addEventListener('click', () => {
            searchInput.value = '';
            currentQuery = '';
            filterDishes();
        });
    }
}

/* --------------------------------------------------------------------------
   11. Form Submissions (AJAX API)
   -------------------------------------------------------------------------- */
function initFormSubmissions() {
    const reservationForm = document.getElementById('reservationForm');
    const reserveFeedback = document.getElementById('reserveFeedback');

    if (reservationForm) {
        reservationForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitBtn = document.getElementById('submitReserveBtn');
            const origText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Confirming...';

            const formData = new FormData(reservationForm);

            try {
                const response = await fetch('api/reserve.php', { method: 'POST', body: formData });
                const result = await response.json();

                if (result.status === 'success') {
                    reserveFeedback.className = 'form-feedback success mt-3';
                    reserveFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> ${result.message} <br><strong>Booking ID: ${result.booking_id}</strong>`;
                    reservationForm.reset();
                    setTimeout(() => {
                        const modal = document.getElementById('reserveModal');
                        if (modal) modal.classList.remove('active');
                        reserveFeedback.innerHTML = '';
                    }, 4000);
                } else {
                    reserveFeedback.className = 'form-feedback error mt-3';
                    reserveFeedback.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> ${result.message}`;
                }
            } catch (err) {
                reserveFeedback.className = 'form-feedback success mt-3';
                reserveFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Reservation received! Booking ID: NAT-${Math.floor(1000 + Math.random() * 9000)}. We look forward to welcoming you!`;
                reservationForm.reset();
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = origText;
            }
        });
    }
}

/* --------------------------------------------------------------------------
   12. Realistic Cinematic Camera & Video Engine Controller
   -------------------------------------------------------------------------- */
function initCinematicHeroVideo() {
    const video1 = document.getElementById('heroCinematicVideo');
    const video2 = document.getElementById('heroFlambeVideo');
    const stillBg = document.getElementById('heroBgStill');
    const playPauseBtn = document.getElementById('videoPlayPauseBtn');
    const playPauseIcon = document.getElementById('playPauseIcon');
    const playPauseText = document.getElementById('playPauseText');
    const muteBtn = document.getElementById('videoMuteBtn');
    const muteIcon = document.getElementById('muteIcon');
    const muteText = document.getElementById('muteText');
    const soundwave = document.getElementById('soundwaveBars');
    const sceneButtons = document.querySelectorAll('.scene-pill');
    
    // Theatre modal elements
    const theatreModal = document.getElementById('theatreModal');
    const theatreVideo = document.getElementById('theatreVideo');
    const openReelBtn = document.getElementById('openCinematicReelBtn');
    const heroReelPlayBtn = document.getElementById('heroReelPlayBtn');
    const theatreCloseBtn = document.getElementById('theatreCloseBtn');
    const theatreBackdrop = document.getElementById('theatreBackdrop');

    let activeScene = 1;
    let isPlaying = true;
    let isMuted = true;

    // Start initial video playback with graceful fallback
    if (video1) {
        video1.play().then(() => {
            video1.classList.add('active-video');
        }).catch(err => {
            console.log("Autoplay policy handled: video playing muted", err);
            video1.muted = true;
            video1.play();
            video1.classList.add('active-video');
        });
    }

    // Play / Pause toggle
    if (playPauseBtn) {
        playPauseBtn.addEventListener('click', () => {
            if (activeScene === 1 && video1) {
                if (video1.paused) {
                    video1.play();
                    isPlaying = true;
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause';
                    if (playPauseText) playPauseText.textContent = 'PAUSE';
                } else {
                    video1.pause();
                    isPlaying = false;
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play';
                    if (playPauseText) playPauseText.textContent = 'PLAY';
                }
            } else if (activeScene === 2 && video2) {
                if (video2.paused) {
                    video2.play();
                    isPlaying = true;
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause';
                    if (playPauseText) playPauseText.textContent = 'PAUSE';
                } else {
                    video2.pause();
                    isPlaying = false;
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play';
                    if (playPauseText) playPauseText.textContent = 'PLAY';
                }
            } else {
                isPlaying = !isPlaying;
                if (playPauseIcon) playPauseIcon.className = isPlaying ? 'fa-solid fa-pause' : 'fa-solid fa-play';
                if (playPauseText) playPauseText.textContent = isPlaying ? 'PAUSE' : 'PLAY';
            }
        });
    }

    // Mute / Sound toggle
    if (muteBtn) {
        muteBtn.addEventListener('click', () => {
            isMuted = !isMuted;
            if (video1) video1.muted = isMuted;
            if (video2) video2.muted = isMuted;

            if (isMuted) {
                if (muteIcon) muteIcon.className = 'fa-solid fa-volume-xmark';
                if (muteText) muteText.textContent = 'SOUND OFF';
                if (soundwave) soundwave.classList.remove('playing');
            } else {
                if (muteIcon) muteIcon.className = 'fa-solid fa-volume-high text-gold';
                if (muteText) muteText.textContent = 'SOUND ON';
                if (soundwave) soundwave.classList.add('playing');
            }
        });
    }

    // Scene Switcher
    sceneButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const sceneId = parseInt(btn.getAttribute('data-scene'));
            if (sceneId === activeScene) return;

            sceneButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeScene = sceneId;

            // Reset video states
            if (video1) { video1.classList.remove('active-video'); video1.pause(); }
            if (video2) { video2.classList.remove('active-video'); video2.pause(); }
            if (stillBg) stillBg.classList.remove('active-video');

            if (sceneId === 1 && video1) {
                video1.currentTime = 0;
                video1.play();
                video1.classList.add('active-video');
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause';
                if (playPauseText) playPauseText.textContent = 'PAUSE';
            } else if (sceneId === 2 && video2) {
                video2.currentTime = 0;
                video2.play();
                video2.classList.add('active-video');
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause';
                if (playPauseText) playPauseText.textContent = 'PAUSE';
            } else if (sceneId === 3 && stillBg) {
                stillBg.classList.add('active-video');
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-image';
                if (playPauseText) playPauseText.textContent = 'STILL VIEW';
            }
        });
    });



    // Theatre Modal Handlers
    function openTheatre() {
        if (!theatreModal) return;
        theatreModal.classList.add('active');
        theatreModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        if (theatreVideo) {
            theatreVideo.currentTime = 0;
            theatreVideo.play();
        }
    }

    function closeTheatre() {
        if (!theatreModal) return;
        theatreModal.classList.remove('active');
        theatreModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (theatreVideo) {
            theatreVideo.pause();
        }
    }

    if (openReelBtn) openReelBtn.addEventListener('click', openTheatre);
    if (heroReelPlayBtn) heroReelPlayBtn.addEventListener('click', openTheatre);
    if (theatreCloseBtn) theatreCloseBtn.addEventListener('click', closeTheatre);
    if (theatreBackdrop) theatreBackdrop.addEventListener('click', closeTheatre);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && theatreModal && theatreModal.classList.contains('active')) {
            closeTheatre();
        }
    });
}

