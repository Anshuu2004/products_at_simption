<?php
require '../connection/db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ header('Location: /login.php'); exit; }
include '../includes/header.php';
$rows = $pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();
?>
<h1>Products</h1>
<a class="btn btn-sm btn-success mb-2" href="product_edit.php">Add Product</a>
<table class="table">
<thead><tr><th>ID</th><th>Title</th><th>Price</th></tr></thead>
<tbody>
<?php foreach($rows as $r): ?>
<tr><td><?=htmlspecialchars($r['id'])?></td><td><?=htmlspecialchars($r['title'])?></td><td><?=number_format($r['price'],2)?></td></tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include '../includes/footer.php'; ?>
