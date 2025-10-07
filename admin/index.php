<?php
require '../connection/db.php';
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ header('Location: /login.php'); exit; }
include '../includes/header.php';
?>
<h1>Admin Dashboard</h1>
<ul>
  <li><a href="products.php">Products</a></li>
  <li><a href="clients.php">Clients</a></li>
  <li><a href="attendance_reports.php">Attendance Reports</a></li>
</ul>
<?php include '../includes/footer.php'; ?>
