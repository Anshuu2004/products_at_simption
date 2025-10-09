<?php 
// attendance/template.php

require __DIR__ . '/../connection/db.php'; 
include __DIR__ . '/../includes/header.php'; 

// $slug must be provided by the including file
if (empty($slug)) {
    echo "<div class='container py-5'>
            <div class='alert alert-warning'>Attendance page not configured.</div>
          </div>";
    include __DIR__ . '/../includes/footer.php'; 
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM attendance_types WHERE slug = ? LIMIT 1");
$stmt->execute([$slug]);
$a = $stmt->fetch();
?> 

<div class="container py-5">
  <?php if (!$a): ?>
    <h2>Attendance</h2>
    <p class="text-muted">Content coming soon.</p>
  <?php else: ?>
    <h2><?php echo htmlspecialchars($a['title']); ?></h2>

    <?php if ($a['image']): ?>
      <img src="../assets/images/<?php echo htmlspecialchars($a['image']); ?>" 
           class="img-fluid mb-3" 
           alt="<?php echo htmlspecialchars($a['title']); ?>">
    <?php endif; ?>

    <p class="small text-muted">
      <?php echo htmlspecialchars($a['short_desc']); ?>
    </p>

    <div>
      <?php echo $a['content']; ?>
    </div>

    <a class="btn btn-primary mt-3" href="../contact.php?enquiry=1">Enquire</a>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
