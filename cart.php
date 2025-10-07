<?php
include 'includes/header.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  // simple session cart
  $pid = (int)($_POST['product_id'] ?? 0);
  $qty = max(1,(int)($_POST['qty'] ?? 1));
  if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
  if(isset($_SESSION['cart'][$pid])) $_SESSION['cart'][$pid] += $qty;
  else $_SESSION['cart'][$pid] = $qty;
  echo '<div class="alert alert-success">Added to cart. <a href="/cart.php">View Cart</a></div>';
}
$cart = $_SESSION['cart'] ?? [];
if(!$cart){ echo '<p>Your cart is empty.</p>'; include 'includes/footer.php'; exit; }
?>
<h1>Your Cart</h1>
<table class="table">
<thead><tr><th>Product</th><th>Qty</th><th>Action</th></tr></thead>
<tbody>
<?php foreach($cart as $pid=>$qty): ?>
<tr><td>Product #<?=htmlspecialchars($pid)?></td><td><?=htmlspecialchars($qty)?></td><td>-</td></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include 'includes/footer.php'; ?>
