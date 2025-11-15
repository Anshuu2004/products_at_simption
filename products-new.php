<?php
require 'connection/db.php';

// --- Filter & Sort Logic ---
$category_ids = isset($_GET['categories']) && is_array($_GET['categories']) ? $_GET['categories'] : [];
$min_price = isset($_GET['min_price']) && is_numeric($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) && is_numeric($_GET['max_price']) ? (int)$_GET['max_price'] : 10000;
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'latest';

// --- Pagination Logic ---
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

// --- Fetch Categories for Filter ---
$category_stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $category_stmt->fetchAll();

// --- Build WHERE clause for filtering ---
$where_clauses = " WHERE price BETWEEN :min_price AND :max_price";
$params = [':min_price' => $min_price, ':max_price' => $max_price];
$count_params = $params; // Separate params for count query

if (!empty($category_ids)) {
    $safe_category_ids = array_map('intval', $category_ids);
    $in_placeholders = implode(',', array_fill(0, count($safe_category_ids), '?'));
    $where_clauses .= " AND category_id IN ($in_placeholders)";
}

// --- Count Total Products for Pagination ---
$count_sql = "SELECT COUNT(*) FROM products" . $where_clauses;
$count_stmt = $pdo->prepare($count_sql);

// Bind parameters for count
$count_stmt->bindParam(':min_price', $count_params[':min_price'], PDO::PARAM_INT);
$count_stmt->bindParam(':max_price', $count_params[':max_price'], PDO::PARAM_INT);
if (!empty($category_ids)) {
    $i = 1;
    foreach ($safe_category_ids as $cat_id) {
        $count_stmt->bindValue($i++, $cat_id, PDO::PARAM_INT);
    }
}
$count_stmt->execute();
$total_products = $count_stmt->fetchColumn();
$total_pages = ceil($total_products / $limit);

// --- Build ORDER BY clause for sorting ---
$sort_columns = [
    'price_asc' => 'price ASC',
    'price_desc' => 'price DESC',
    'latest' => 'created_at DESC'
];
$order_by = isset($sort_columns[$sort_option]) ? $sort_columns[$sort_option] : 'created_at DESC';

// --- Build Full Product Query ---
$sql = "SELECT * FROM products" . $where_clauses . " ORDER BY " . $order_by . " LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

// Bind parameters for main query
$stmt->bindParam(':min_price', $params[':min_price'], PDO::PARAM_INT);
$stmt->bindParam(':max_price', $params[':max_price'], PDO::PARAM_INT);
$param_offset = empty($category_ids) ? 1 : count($safe_category_ids) + 1;

if (!empty($category_ids)) {
    $i = 1;
    foreach ($safe_category_ids as $cat_id) {
        $stmt->bindValue($i++, $cat_id, PDO::PARAM_INT);
    }
}
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

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
                    <form action="products-new.php" method="GET" id="filter-form">
                        <div class="card">
                            <div class="card-header">
                                <h5>Filter Products</h5>
                            </div>
                            <div class="card-body">
                                <h6>Categories</h6>
                                <?php foreach ($categories as $category): ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="categories[]" 
                                           value="<?php echo $category['id']; ?>" 
                                           id="cat_<?php echo $category['id']; ?>"
                                           <?php if (in_array($category['id'], $category_ids)) echo 'checked'; ?>>
                                    <label class="form-check-label" for="cat_<?php echo $category['id']; ?>">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                                
                                <h6 class="mt-4">Price Range</h6>
                                <div class="form-range-container">
                                    <input type="range" class="form-range" name="max_price" min="0" max="10000" step="100" value="<?php echo htmlspecialchars($max_price); ?>" oninput="this.nextElementSibling.querySelector('.price-value').textContent = this.value">
                                    <div class="d-flex justify-content-between">
                                        <span>₹0</span>
                                        <span>₹<span class="price-value"><?php echo htmlspecialchars($max_price); ?></span></span>
                                    </div>
                                </div>
                                <input type="hidden" name="min_price" value="0">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>All Products (<?php echo $total_products; ?>)</h2>
                        <div>
                            <select class="form-select" name="sort" onchange="document.getElementById('filter-form').submit();" form="filter-form">
                                <option value="latest" <?php if ($sort_option == 'latest') echo 'selected'; ?>>Sort by: Latest</option>
                                <option value="price_asc" <?php if ($sort_option == 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
                                <option value="price_desc" <?php if ($sort_option == 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php while ($product = $stmt->fetch()): ?>
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
                                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <?php
                            // Build query string for pagination links
                            $query_params = $_GET;
                            unset($query_params['page']);
                            $query_string = http_build_query($query_params);
                            ?>

                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&<?php echo $query_string; ?>">Previous</a>
                            </li>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&<?php echo $query_string; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endfor; ?>

                            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&<?php echo $query_string; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>