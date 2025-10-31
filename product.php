<?php 
require 'connection/db.php'; 

// Fetch categories for mapping URL parameters to category_ids
$categories = [];
$stmt = $pdo->query("SELECT id, slug FROM categories");
while ($row = $stmt->fetch()) {
    $categories[$row['slug']] = $row['id'];
}

$productId = null;
$productCategoryId = null;
$paramFound = false;
$debugParamName = '';
$debugParamValue = '';

// 1. Check for 'id' parameter (primary product ID)
if (isset($_GET['id'])) {
    $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($productId) {
        $paramFound = true;
        $debugParamName = 'id';
        $debugParamValue = $productId;
    }
} 
// 2. Check for category-specific parameters
else {
    $paramMap = [
        'attendance' => $categories['attendance'] ?? null,
        'lanyard'    => $categories['lanyard'] ?? null,
        'badge'      => $categories['badge'] ?? null,
        'erp'        => $categories['erp'] ?? null,
    ];

    foreach ($paramMap as $paramName => $categoryId) {
        if (isset($_GET[$paramName]) && $categoryId !== null) {
            $productId = filter_input(INPUT_GET, $paramName, FILTER_VALIDATE_INT);
            if ($productId) {
                $productCategoryId = $categoryId;
                $paramFound = true;
                $debugParamName = $paramName;
                $debugParamValue = $productId;
                break;
            }
        }
    }
}

// If no valid parameter was found, redirect to homepage
if (!$paramFound) {
    error_log("Redirecting from product.php: No valid parameter found. Detected Param Name: {$debugParamName}, Value: {$debugParamValue}");
    header("Location: index.php");
    exit;
}

// 3. Construct the database query dynamically
$sql = "SELECT * FROM products WHERE id = ?";
$params = [$productId];

if ($productCategoryId !== null) {
    $sql .= " AND category_id = ?";
    $params[] = $productCategoryId;
}

error_log("product.php Debug: SQL Query: {$sql}, Params: " . implode(', ', $params));

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$product = $stmt->fetch();

// 4. If no product is found with that ID (and category_id if applicable), redirect
if (!$product) {
    error_log("Redirecting from product.php: Product not found for ID: {$productId} and Category ID: {$productCategoryId}");
    header("Location: index.php");
    exit;
}

include 'includes/header.php'; 
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
                        loading="lazy"
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
                        <a href="quote.php?product_id=<?php echo $product['id']; ?>" class="btn btn-primary btn-lg">Get a Quote</a>
                        <a href="contact.php" class="btn btn-secondary btn-lg ms-2">Ask a Question</a>
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