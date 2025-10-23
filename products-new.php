<?php 
require 'connection/db.php'; 
include 'includes/header.php'; 
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container text-center">
            <h1 class="text-white">Our Products</h1>
            <p class="text-white">Discover our wide range of custom printing solutions</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Filter Products</h5>
                        </div>
                        <div class="card-body">
                            <h6>Categories</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat1">
                                <label class="form-check-label" for="cat1">ID Cards</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat2">
                                <label class="form-check-label" for="cat2">Lanyards</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat3">
                                <label class="form-check-label" for="cat3">Attendance Systems</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="cat4">
                                <label class="form-check-label" for="cat4">ERP Solutions</label>
                            </div>
                            
                            <h6 class="mt-4">Price Range</h6>
                            <div class="form-range-container">
                                <input type="range" class="form-range" min="0" max="10000" step="100">
                                <div class="d-flex justify-content-between">
                                    <span>₹0</span>
                                    <span>₹10,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>All Products</h2>
                        <div>
                            <select class="form-select">
                                <option>Sort by: Featured</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Latest</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php
                        // Fetch products from the database
                        $stmt = $pdo->query("SELECT * FROM products ORDER BY id ASC LIMIT 12");
                        while ($product = $stmt->fetch()):
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="product-card">
                                <a href="product.php?id=<?php echo $product['id']; ?>">
                                    <img src="assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'placeholder.png'); ?>" 
                                         class="product-card-img" 
                                         alt="<?php echo htmlspecialchars($product['title']); ?>">
                                </a>
                                <div class="product-card-body">
                                    <h5 class="product-title">
                                        <a href="product.php?id=<?php echo $product['id']; ?>">
                                            <?php echo htmlspecialchars(substr($product['title'], 0, 30)); ?>
                                            <?php if (strlen($product['title']) > 30) echo '...'; ?>
                                        </a>
                                    </h5>
                                    <p class="product-price">₹<?php echo number_format($product['price'], 2); ?></p>
                                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-order-now w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>