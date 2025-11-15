<?php
require 'connection/db.php';
include 'includes/header.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

echo '<main class="container section-padding">';

if (!empty($query)) {
    $search_term = '%' . strtolower($query) . '%';
    $stmt = $pdo->prepare(
        'SELECT * FROM products WHERE LOWER(title) LIKE ? OR LOWER(description) LIKE ?'
    );
    $stmt->execute([$search_term, $search_term]);
    $results = $stmt->fetchAll();

    echo '<h1 class="mb-4">Search Results for "' . htmlspecialchars($query) . '"</h1>';

    if (count($results) > 0) {
        echo '<div class="row">';
        foreach ($results as $product) {
            echo '<div class="col-md-4 col-lg-3 mb-4">';
            echo '    <div class="card product-card h-100">';
            echo '        <a href="product.php?id=' . $product['id'] . '">';
            echo '            <img src="assets/images/products/' . htmlspecialchars($product['image']) . '" class="card-img-top" alt="' . htmlspecialchars($product['title']) . '">';
            echo '        </a>';
            echo '        <div class="card-body d-flex flex-column">';
            echo '            <h5 class="card-title"><a href="product.php?id=' . $product['id'] . '" class="text-decoration-none text-dark">' . htmlspecialchars($product['title']) . '</a></h5>';
            echo '            <p class="card-text text-muted small flex-grow-1">' . htmlspecialchars(substr($product['description'], 0, 100)) . '...</p>';
            echo '            <p class="card-text fw-bold fs-5 text-primary mb-0">₹' . htmlspecialchars($product['price']) . '</p>';
            echo '        </div>';
            echo '        <div class="card-footer bg-white border-top-0">';
            echo '            <a href="product.php?id=' . $product['id'] . '" class="btn btn-primary w-100">View Details</a>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">';
        echo '    No products found matching your search term. Please try again.';
        echo '</div>';
    }
} else {
    echo '<div class="alert alert-info" role="alert">';
    echo '    Please enter a search term in the search bar above.';
    echo '</div>';
}

echo '</main>';

include 'includes/footer.php';
