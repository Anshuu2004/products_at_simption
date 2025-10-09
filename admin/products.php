<?php 
require '../connection/db.php';
session_start();

// Restrict access to admins only
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}

include '../includes/header.php'; 

$rows = $pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();
?> 

<div class="container py-5">
  <h1>Products</h1>

  <?php if (!empty($_GET['deleted'])): ?>
    <div class="alert alert-success">Product deleted successfully.</div>
  <?php elseif (!empty($_GET['updated'])): ?>
    <div class="alert alert-success">Product updated successfully.</div>
  <?php elseif (!empty($_GET['added'])): ?>
    <div class="alert alert-success">Product added successfully.</div>
  <?php endif; ?>

  <a class="btn btn-sm btn-success mb-3" href="product_edit.php">+ Add Product</a>

  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price (₹)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?php echo htmlspecialchars($r['id']); ?></td>
          <td><?php echo htmlspecialchars($r['title']); ?></td>
          <td><?php echo '₹' . htmlspecialchars(number_format($r['price'], 2)); ?></td>
          <td>
            <a href="product_edit.php?id=<?php echo $r['id']; ?>" 
               class="btn btn-sm btn-warning">Edit</a>

            <div class="d-inline">
              <form method="post" action="product_edit.php?id=<?php echo $r['id']; ?>" class="d-inline">
                <button type="submit" name="delete" value="1"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this product?');">
                  Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
