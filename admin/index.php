<?php 
require '../connection/db.php';
include '../includes/header.php'; 
?> 

<div class="container py-5">
  <h1>Admin Dashboard</h1>
  <ul class="list-unstyled">
    <li><a href="products.php">Manage Products</a></li>
    <li><a href="clients.php">Manage Clients</a></li>
    <li><a href="attendance_reports.php">Attendance Reports</a></li>
  </ul>
</div>

<?php include '../includes/footer.php'; ?>
