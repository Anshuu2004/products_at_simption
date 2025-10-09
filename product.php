<?php 
require 'connection/db.php'; 
include 'includes/header.php'; 

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$p = $stmt->fetch();
?> 

<div class="container py-5">
  <?php if (!$p): ?>
    <div class="alert alert-warning">Product not found.</div>
  <?php else: ?>
    <div class="row">
      
      <!-- Product Image -->
      <div class="col-md-5">
        <img src="assets/images/<?php echo htmlspecialchars($p['image']); ?>" 
             class="img-fluid rounded" 
             alt="<?php echo htmlspecialchars($p['title']); ?>">
      </div>
      
      <!-- Product Details -->
      <div class="col-md-7">
        <h2><?php echo htmlspecialchars($p['title']); ?></h2>
        <p class="lead">₹ <?php echo number_format($p['price'], 2); ?></p>
        
        <div>
          <?php echo nl2br(htmlspecialchars($p['description'])); ?>
        </div>
        
        <!-- Enquiry Form -->
        <form method="post" action="product_enquiry.php" class="mt-4">
          <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
          <button class="btn btn-primary">Add to Enquiry</button>
          <a href="contact.php?product=<?php echo $p['id']; ?>" 
             class="btn btn-outline-secondary ms-2">
            Enquire Now
          </a>
        </form>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
