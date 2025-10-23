<?php 
require 'connection/db.php'; 
include 'includes/header.php'; 
?> 

<main>
    <section class="page-header">
        <div class="container text-center">
            <h1 class="text-white">ID-Card Designing</h1>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-8 mx-auto">
                    <h2 class="section-title">Our ID-Card Products</h2>
                    <p class="lead">High-quality, customizable ID cards for every need. From durable PVC to advanced RFID smart cards, we provide professional solutions for schools, colleges, and businesses.</p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                // Fetch all products that belong to the 'ID Card' category.
                // NOTE: We assume the category_id for 'ID Card' is 1. 
                // You can verify this in your `categories` table in phpMyAdmin.
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY title ASC");
                $stmt->execute([1]);
                $products = $stmt->fetchAll();

                if (empty($products)) {
                    echo "<div class='col-12'><p class='text-center'>No ID card products found.</p></div>";
                } else {
                    foreach ($products as $product):
                        $image_path = 'assets/images/products/' . ($product['image'] ?? 'placeholder.png');
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <img src="<?php echo htmlspecialchars($image_path); ?>" class="product-card-img" alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </a>
                        <div class="product-card-body">
                            <h5 class="product-title">
                                <a href="product.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['title']); ?></a>
                            </h5>
                            <p class="product-price">₹<?php echo number_format($product['price'], 2); ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach;
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
