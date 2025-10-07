<?php include 'connection/db.php'; include 'includes/header.php'; ?>
<h1>Our Clients</h1>
<div class="row">
<?php
$stmt = $pdo->query('SELECT * FROM clients ORDER BY id DESC LIMIT 12');
while($c = $stmt->fetch()):
?>
  <div class="col-6 col-md-3 text-center mb-3">
    <img src="<?=htmlspecialchars($c['logo_path'])?>" class="img-fluid" alt="<?=htmlspecialchars($c['name'])?>">
    <div><?=htmlspecialchars($c['name'])?></div>
    <div class="small text-muted"><?=htmlspecialchars($c['city'])?></div>
  </div>
<?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>
