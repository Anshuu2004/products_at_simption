<?php
require 'connection/db.php';
include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="promo-badge">Get up to 30% off</div>
                    <h1 class="hero-title">Stay Cool, Stay Stylish</h1>
                    <p class="hero-subtitle lead my-4">
                        Get Ready with Summer Sports T-shirt
                    </p>
                    <a href="quote-new.php" class="btn btn-accent btn-lg me-2">Shop Now</a>
                    <a href="products-new.php" class="btn btn-outline-primary btn-lg">View Collection</a>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 text-center">
                    <img src="assets/images/general/hero-image.png" class="img-fluid" alt="Summer Sports T-shirt">
                </div>
            </div>
        </div>
    </section>

    <!-- Category Navigation -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-5">Shop by Category</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3>ID Cards</h3>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-mug-hot"></i>
                        </div>
                        <h3>Drinkware</h3>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h3>T-Shirts</h3>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>Notebooks</h3>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3>Stickers</h3>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="products-new.php" class="solution-card text-center">
                        <div class="icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3>Gifts</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Most Popular Products -->
    <section class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-title">Most Popular Products</h2>
                    <p class="lead">Discover our best selling custom printing solutions</p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                // Fetch popular products from the database
                $stmt = $pdo->query("SELECT * FROM products ORDER BY id ASC LIMIT 8");
                while ($product = $stmt->fetch()):
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <a href="product-new.php?id=<?php echo $product['id']; ?>">
                            <img src="assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'placeholder.png'); ?>" 
                                 class="product-card-img" 
                                 alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </a>
                        <div class="product-card-body">
                            <h5 class="product-title">
                                <a href="product-new.php?id=<?php echo $product['id']; ?>">
                                    <?php echo htmlspecialchars(substr($product['title'], 0, 30)); ?>
                                    <?php if (strlen($product['title']) > 30) echo '...'; ?>
                                </a>
                            </h5>
                            <p class="product-price">₹<?php echo number_format($product['price'], 2); ?></p>
                            <a href="product-new.php?id=<?php echo $product['id']; ?>" class="btn btn-order-now">Order Now</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="products-new.php" class="btn btn-outline-primary btn-lg">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Category Cards / Quick Shop -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-title">Quick Shop by Category</h2>
                    <p class="lead">Find exactly what you're looking for</p>
                </div>
            </div>

            <div class="category-scroll-container">
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <h5>Drinkware</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h5>T-Shirts</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5>Notebooks</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h5>ID Cards</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h5>Stickers</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h5>Gifts</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <h5>Printing</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h5>Laptops</h5>
                </div>
                <div class="category-card">
                    <div class="icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5>Mobile Covers</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p class="lead">Trusted by thousands of customers across India</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="trust-badge">
                        <div class="icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Quick Delivery</h4>
                        <p>Fast turnaround times without compromising on quality</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="trust-badge">
                        <div class="icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h4>Custom Design</h4>
                        <p>Professional designers to bring your vision to life</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="trust-badge">
                        <div class="icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4>Premium Quality</h4>
                        <p>Only the best materials and printing techniques</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="trust-badge">
                        <div class="icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>24/7 Support</h4>
                        <p>Dedicated customer service team always ready to help</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-title">Trusted by Thousands Across India</h2>
                </div>
            </div>

            <div class="row text-center mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <h3>6,200+</h3>
                        <p>Schools Empowered</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <h3>2,800+</h3>
                        <p>Websites Delivered</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <h3>3,200+</h3>
                        <p>RFID Systems Installed</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Team Members</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center g-4">
                <?php
                // Fetch clients from the database
                $stmt = $pdo->query("SELECT * FROM clients ORDER BY name ASC LIMIT 12");
                while ($client = $stmt->fetch()):
                    // Make sure the path to your client logos is correct
                    $logo_path = 'assets/images/clients/' . ($client['logo'] ?? 'placeholder.png');
                ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="client-logo">
                        <img src="<?php echo htmlspecialchars($logo_path); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($client['name']); ?>">
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section-padding final-cta">
        <div class="container text-center">
            <h2 class="text-white">Ready to Start Your Project?</h2>
            <p class="lead text-white-50">Let's create a solution that fits your needs and budget.</p>
            <a href="quote-new.php" class="btn btn-accent btn-lg mt-4">Get a Quote</a>
        </div>
    </section>
</main>

<!-- Floating Chat Bubble -->
<div class="floating-chat">
    <i class="fas fa-comments"></i>
</div>

<?php include 'includes/footer.php'; ?>