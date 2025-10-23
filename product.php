<?php 
require 'connection/db.php'; 
include 'includes/header.php'; 

// 1. Get the product ID from the URL and validate it
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    // If no valid ID, redirect to the homepage
    header("Location: index.php");
    exit;
}

// 2. Fetch the product from the database
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// 3. If no product is found with that ID, redirect
if (!$product) {
    header("Location: index.php");
    exit;
}
?>

<main>
    <section class="py-3" style="background-color: var(--light-gray);">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="id-cards.php">ID Cards</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['title']); ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
            <div class="product-image-gallery">
                <?php 
                    $image_path = 'assets/images/products/' . ($product['image'] ?? 'placeholder.png'); 
                    // For the zoom to work best, you should have a larger version of the image.
                    // For now, we'll use the same image for both.
                    $large_image_path = $image_path; 
                ?>
                <a href="assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'placeholder.png'); ?>" class="zoom-link">
                    <img src="<?php echo htmlspecialchars($image_path); ?>" 
                        class="main-product-image" 
                        data-zoom="assets/images/products/<?php echo htmlspecialchars($product['image'] ?? 'placeholder.png'); ?>"
                        alt="<?php echo htmlspecialchars($product['title']); ?>">
                </a>
            </div>
            <div class="zoom-pane"></div>
        </div>

                <div class="col-lg-6">
                    <h1 class="product-page-title"><?php echo htmlspecialchars($product['title']); ?></h1>
                    <p class="product-page-price">₹<?php echo number_format($product['price'], 2); ?></p>
                    <p class="lead"><?php echo htmlspecialchars($product['description']); ?></p>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1">
                    </div>

                    <div class="mt-4">
                        <a href="quote.php?product_id=<?php echo $product['id']; ?>" class="btn btn-accent btn-lg">Get a Quote</a>
                        <a href="contact.php" class="btn btn-outline-primary btn-lg ms-2">Ask a Question</a>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Full Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Specifications</button>
                        </li>
                    </ul>
                    <div class="tab-content p-4 border border-top-0">
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                        </div>
                        <div class="tab-pane fade" id="specs" role="tabpanel">
                            <p>Detailed specifications for <?php echo htmlspecialchars($product['title']); ?> will be listed here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>