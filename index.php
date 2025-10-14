<?php
require 'connection/db.php';
include 'includes/header.php';
?>

<div class="container py-5">
  <!-- Featured Products Section -->
  <div class="mb-4">
    <h3 class="mb-1">Featured Products</h3>
    <p class="text-muted small">Hover a product to preview it (desktop) or tap on mobile.</p>
  </div>

  <div class="row g-3">
    <?php
    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 12");
    while ($p = $stmt->fetch()):
      $img = 'assets/images/' . ($p['image'] ?? 'placeholder.png');
    ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card product-card"
             tabindex="0"
             data-large="<?php echo htmlspecialchars($img); ?>"
             onclick="location.href='product.php?id=<?php echo $p['id']; ?>'">
          <img src="<?php echo htmlspecialchars($img); ?>"
               class="card-img-top product-image"
               alt="">

          <div class="card-body">
            <h5 class="card-title small mb-1">
              <?php echo htmlspecialchars($p['title']); ?>
            </h5>
            <p class="mb-2 small text-muted">
              <?php echo htmlspecialchars(substr($p['description'], 0, 70)); ?>...
            </p>

            <div class="d-flex justify-content-between align-items-center">
              <div class="price">₹ <?php echo number_format($p['price'], 2); ?></div>
              <a href="product.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <hr class="my-5">

  <!-- Clients Section -->
  <h3>Our Clients</h3>
  <div class="row align-items-center g-3 mt-2">
    <?php
    $cstmt = $pdo->query("SELECT * FROM clients ORDER BY id DESC LIMIT 8");
    while ($c = $cstmt->fetch()):
      $logo = 'assets/images/' . ($c['logo'] ?? 'client_placeholder.png');
    ?>
      <div class="col-6 col-md-3 text-center">
        <img src="<?php echo htmlspecialchars($logo); ?>"
             class="client-logo img-fluid"
             alt="<?php echo htmlspecialchars($c['name']); ?>">
        <div class="small text-muted mt-2">
          <?php echo htmlspecialchars($c['name']); ?> — <?php echo htmlspecialchars($c['city']); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
