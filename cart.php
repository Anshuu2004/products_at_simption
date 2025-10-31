<?php 
include 'includes/header.php';

// Handle remove single item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $id = intval($_POST['remove_id']);
    if (!empty($_SESSION['enquiry'][$id])) {
        unset($_SESSION['enquiry'][$id]);
    }
}

// Handle clear cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart'])) {
    $_SESSION['enquiry'] = [];
}

// Get current cart
$cart = $_SESSION['enquiry'] ?? [];
?> 

<div class="container py-5">
  <h1>Enquiry Cart</h1>

  <?php if (empty($cart)): ?>
    <div class="alert alert-info">Your enquiry cart is empty.</div>
  <?php else: ?>
    <form method="post">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Price (₹)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $item): ?>
            <tr>
              <td>
                <img src="assets/images/<?php echo htmlspecialchars($item['image']); ?>" 
                     alt="" style="width:60px;">
              </td>
              <td><?php echo htmlspecialchars($item['title']); ?></td>
              <td><?php echo number_format($item['price'], 2); ?></td>
              <td>
                <form method="post" class="d-inline">
                  <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
                  <button type="submit" class="btn btn-sm btn-danger"
                          onclick="return confirm('Remove this item from cart?');">
                    Remove
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>

    <div class="d-flex justify-content-between mt-3">
      <form method="post">
        <input type="hidden" name="clear_cart" value="1">
        <button type="submit" class="btn btn-warning"
                onclick="return confirm('Are you sure you want to clear the entire cart?');">
          Clear Cart
        </button>
      </form>

      <a href="contact.php?enquiry=1" class="btn btn-primary">Proceed to Enquiry</a>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
