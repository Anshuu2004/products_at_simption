<?php
require '../connection/db.php';
session_start();

// Restrict access to admins only
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: /login.php');
    exit;
}

$id = $_GET['id'] ?? null;
$product = null;

// If editing, load existing product
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If delete button pressed
    if (isset($_POST['delete']) && $id) {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: products.php?deleted=1');
        exit;
    }

    // Otherwise handle add/update
    $title       = trim($_POST['title'] ?? '');
    $price       = floatval($_POST['price'] ?? 0);
    $category    = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image       = $_POST['image'] ?? '';

    if ($id) {
        $stmt = $pdo->prepare(
            "UPDATE products SET title=?, price=?, category=?, description=?, image=? WHERE id=?"
        );
        $stmt->execute([$title, $price, $category, $description, $image, $id]);
        $success = "Product updated successfully.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO products (title, price, category, description, image) VALUES (?,?,?,?,?)"
        );
        $stmt->execute([$title, $price, $category, $description, $image]);
        $success = "Product added successfully.";
    }
}

include '../includes/header.php';
?>

<div class="container py-5">
  <h1><?php echo $id ? "Edit Product" : "Add Product"; ?></h1>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" 
             value="<?php echo htmlspecialchars($product['title'] ?? ''); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Price (₹)</label>
      <input type="number" step="0.01" name="price" class="form-control" 
             value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category" class="form-select" required>
        <option value="">-- Select --</option>
        <option value="idcard"   <?php if(($product['category'] ?? '')==='idcard') echo 'selected'; ?>>ID Card</option>
        <option value="lanyard"  <?php if(($product['category'] ?? '')==='lanyard') echo 'selected'; ?>>Lanyard</option>
        <option value="bedge"    <?php if(($product['category'] ?? '')==='bedge') echo 'selected'; ?>>Badge</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"><?php 
        echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image filename</label>
      <input type="text" name="image" class="form-control" 
             value="<?php echo htmlspecialchars($product['image'] ?? ''); ?>">
      <small class="text-muted">Later we’ll add file upload. For now, type image name (e.g. `card1.jpg`).</small>
    </div>

    <button class="btn btn-primary"><?php echo $id ? "Update" : "Add"; ?> Product</button>
    <a href="products.php" class="btn btn-secondary">Back</a>

    <?php if ($id): ?>
      <button type="submit" name="delete" value="1" 
              class="btn btn-danger float-end"
              onclick="return confirm('Are you sure you want to delete this product?');">
        Delete
      </button>
    <?php endif; ?>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
