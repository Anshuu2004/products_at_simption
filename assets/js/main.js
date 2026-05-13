// Main JavaScript file for the Simption Tech website

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Handle floating chat bubble click
    const floatingChat = document.querySelector('.floating-chat');
    if (floatingChat) {
        const contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
        floatingChat.addEventListener('click', function() {
            contactModal.show();
        });
    }

    // Handle search bar focus
    const searchBars = document.querySelectorAll('.search-bar');
    searchBars.forEach(function(searchBar) {
        searchBar.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        });
        
        searchBar.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Handle product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle category card hover effects
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle trust badge hover effects
    const trustBadges = document.querySelectorAll('.trust-badge');
    trustBadges.forEach(function(badge) {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle solution card hover effects
    const solutionCards = document.querySelectorAll('.solution-card');
    solutionCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px)';
            this.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle mobile menu toggle
    const mobileToggle = document.querySelector('.navbar-toggler');
    const mobileMenu = document.querySelector('.navbar-collapse');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('show');
        });
    }

    // DISABLE BOOTSTRAP DROPDOWN FUNCTIONALITY
    document.querySelectorAll('.dropdown').forEach(function(dropdown) {
        ['show.bs.dropdown', 'shown.bs.dropdown', 'hide.bs.dropdown', 'hidden.bs.dropdown'].forEach(function(event) {
            dropdown.addEventListener(event, function(e) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            });
        });
    });

    // Mobile (<992px): enable click-to-open logic
    if (window.innerWidth < 992) {
        const mobileDropdowns = document.querySelectorAll('.navbar .nav-item.dropdown');
        mobileDropdowns.forEach(function(item) {
            const toggleLink = item.querySelector('.nav-link');
            const menu = item.querySelector('.dropdown-menu');
            if (!toggleLink || !menu) return;
            let openedOnce = false;
            toggleLink.addEventListener('click', function(e) {
                const isOpen = menu.classList.contains('show');
                if (!isOpen) {
                    document.querySelectorAll('.navbar .dropdown-menu.show').forEach(function(openMenu) {
                        openMenu.classList.remove('show');
                    });
                    menu.classList.add('show');
                    openedOnce = true;
                    e.preventDefault();
                    return;
                }
                if (openedOnce) {
                    openedOnce = false;
                    return;
                }
            });
            document.addEventListener('click', function(event) {
                if (!item.contains(event.target)) {
                    menu.classList.remove('show');
                    openedOnce = false;
                }
            });
        });
    }

    // Handle image preview for dropdown menus (desktop only)
    if (window.innerWidth >= 992) {
        document.querySelectorAll('.dropdown').forEach(function(dropdown) {
            const previewImage = dropdown.querySelector('.mega-menu-preview-image');
            const linksContainers = dropdown.querySelectorAll('.mega-menu-links');
            if (!previewImage || linksContainers.length === 0) return;
            const defaultImage = previewImage.src;
            linksContainers.forEach(function(linksContainer) {
                linksContainer.querySelectorAll('a').forEach(function(link) {
                    link.addEventListener('mouseenter', function() {
                        const newImage = link.getAttribute('data-image');
                        if (newImage) {
                            previewImage.src = newImage;
                        }
                    });
                });
                linksContainer.addEventListener('mouseleave', function() {
                    previewImage.src = defaultImage;
                });
            });
        });
    }

    // Handle quantity input
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
        });
    });

    // Handle product image zoom
    const zoomLinks = document.querySelectorAll('.zoom-link');
    zoomLinks.forEach(function(zoomLink) {
        new Drift(zoomLink, {
            paneContainer: document.querySelector('.zoom-pane'),
            inlinePane: false,
        });
    });

    // Hero Carousel
    (function initHeroCarousel() {
        const carousel = document.getElementById('heroCarousel');
        if (!carousel) return;
        const track = carousel.querySelector('.carousel-track');
        const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
        const prevBtn = carousel.querySelector('.carousel-arrow.prev');
        const nextBtn = carousel.querySelector('.carousel-arrow.next');
        const dotsContainer = carousel.querySelector('.carousel-dots');
        let currentIndex = 0;
        let intervalId = null;
        const slideCount = slides.length;
        const intervalMs = 5000;
        slides.forEach((_, idx) => {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot' + (idx === 0 ? ' active' : '');
            dot.setAttribute('role', 'tab');
            dot.setAttribute('aria-label', 'Go to slide ' + (idx + 1));
            dot.addEventListener('click', () => goTo(idx));
            dotsContainer.appendChild(dot);
        });
        const dots = Array.from(dotsContainer.querySelectorAll('.carousel-dot'));
        function updateUI() {
            track.style.transition = 'transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1)';
            track.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
            dots.forEach((d, i) => d.classList.toggle('active', i === currentIndex));
        }
        function goTo(index) {
            currentIndex = (index + slideCount) % slideCount;
            updateUI();
        }
        function next() { goTo(currentIndex + 1); }
        function prev() { goTo(currentIndex - 1); }
        function startAuto() {
            stopAuto();
            intervalId = setInterval(next, intervalMs);
        }
        function stopAuto() {
            if (intervalId) { clearInterval(intervalId); intervalId = null; }
        }
        nextBtn.addEventListener('click', () => { next(); startAuto(); });
        prevBtn.addEventListener('click', () => { prev(); startAuto(); });
        carousel.addEventListener('mouseenter', stopAuto);
        carousel.addEventListener('mouseleave', startAuto);
        updateUI();
        startAuto();
    })();
    
    // Add animation to stat items
    const statItems = document.querySelectorAll('.stat-item h3');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const finalValue = parseInt(element.textContent);
                let currentValue = 0;
                const duration = 2000;
                const increment = finalValue / (duration / 16);
                const updateCount = () => {
                    currentValue += increment;
                    if (currentValue < finalValue) {
                        element.textContent = Math.ceil(currentValue) + (element.textContent.includes('+') ? '+' : '');
                        requestAnimationFrame(updateCount);
                    } else {
                        element.textContent = finalValue + (element.textContent.includes('+') ? '+' : '');
                    }
                };
                updateCount();
                observer.unobserve(element);
            }
        });
    }, { threshold: 0.5 });
    
    statItems.forEach(item => {
        observer.observe(item);
    });
});