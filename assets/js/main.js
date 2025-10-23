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
        floatingChat.addEventListener('click', function() {
            alert('Chat support will be implemented here!');
        });
    }

    // Handle search bar focus
    const searchBars = document.querySelectorAll('.search-bar');
    searchBars.forEach(function(searchBar) {
        searchBar.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        searchBar.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Handle product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle category card hover effects
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Handle trust badge hover effects
    const trustBadges = document.querySelectorAll('.trust-badge');
    trustBadges.forEach(function(badge) {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        badge.addEventListener('mouseleave', function() {
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

    // Handle dropdown menus on desktop
    if (window.innerWidth >= 992) {
        // Enable hover to open menu
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
            everydropdown.addEventListener('mouseenter', function() {
                let el_link = this.querySelector('a[data-bs-toggle]');
                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                }
            });
            everydropdown.addEventListener('mouseleave', function() {
                let el_link = this.querySelector('a[data-bs-toggle]');
                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                }
            });
        });

        // Enable hover image preview
        document.querySelectorAll('.dropdown').forEach(function(menuElement) {
            const previewImage = menuElement.querySelector('.mega-menu-preview-image');
            const linksContainer = menuElement.querySelector('.mega-menu-links');
            
            if (!previewImage || !linksContainer) return;

            const defaultImage = previewImage.src;
            
            linksContainer.querySelectorAll('a[data-image]').forEach(function(link) {
                link.addEventListener('mouseenter', function() {
                    previewImage.src = this.getAttribute('data-image');
                });
            });

            linksContainer.addEventListener('mouseleave', function() {
                previewImage.src = defaultImage;
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
});