<?php 
require 'connection/db.php'; 
include 'includes/header.php'; 

$stmt = $pdo->query("SELECT * FROM erp_modules ORDER BY id");
$modules = $stmt->fetchAll();
?> 

<div class="container py-5">
  <h2>ERP Solutions</h2>
  <p class="text-muted">Choose the ERP modules that fit your institution.</p>

  <div class="row g-3">
    <?php foreach ($modules as $m): ?>
      <div class="col-md-6">
        <div class="card p-3">
          <h5><?php echo htmlspecialchars($m['title']); ?></h5>
          <p class="small text-muted">
            <?php echo htmlspecialchars($m['description']); ?>
          </p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
