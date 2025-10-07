<?php include 'connection/db.php'; include 'includes/header.php'; ?>
<h1>Products</h1>
<div class="row">
<?php
$stmt = $pdo->query('SELECT * FROM products WHERE is_active=1 LIMIT 12');
while($p = $stmt->fetch()):
?>
  <div class="col-md-4 mb-3">
    <div class="card">
      <img src="<?=htmlspecialchars($p['image_path']?:'/images/products/sample_card.jpg')?>" class="card-img-top" alt="<?=htmlspecialchars($p['title'])?>">
      <div class="card-body">
        <h5 class="card-title"><?=htmlspecialchars($p['title'])?></h5>
        <p class="card-text"><?=htmlspecialchars(substr($p['description'],0,120))?></p>
        <p class="fw-bold">₹<?=number_format($p['price'],2)?></p>
        <a href="/product.php?id=<?=urlencode($p['id'])?>" class="btn btn-sm btn-primary">View</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>
