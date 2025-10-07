<?php include 'connection/db.php'; include 'includes/header.php'; 
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$id]);
$p = $stmt->fetch();
if(!$p){
  echo '<div class="alert alert-warning">Product not found</div>';
  include 'includes/footer.php'; exit;
}
?>
<div class="row">
  <div class="col-md-6">
    <img src="<?=htmlspecialchars($p['image_path']?:'/images/products/sample_card.jpg')?>" class="img-fluid" alt="">
  </div>
  <div class="col-md-6">
    <h2><?=htmlspecialchars($p['title'])?></h2>
    <p><?=nl2br(htmlspecialchars($p['description']))?></p>
    <p class="h4">₹<?=number_format($p['price'],2)?></p>
    <form method="post" action="/cart.php">
      <input type="hidden" name="product_id" value="<?=htmlspecialchars($p['id'])?>">
      <div class="mb-2"><label>Quantity</label><input type="number" name="qty" value="1" min="1" class="form-control" style="width:120px"></div>
      <button class="btn btn-primary">Add to cart</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
