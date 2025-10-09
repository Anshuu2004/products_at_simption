<?php 
// admin/placeholder.php - simple protected admin route

session_start();

// Redirect to login if not admin
if (empty($_SESSION['user']) || empty($_SESSION['user']['is_admin'])) {
    header('Location: ../login.php');
    exit;
}

include __DIR__ . '/../includes/header.php'; 
?> 

<div class="container py-5">
  <h2>Admin Panel (Placeholder)</h2>
  <p class="text-muted">
    This is a protected admin route. In later steps we'll add full CRUD 
    (products, clients, attendance types, messages).
  </p>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
