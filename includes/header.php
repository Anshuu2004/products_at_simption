<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products at Simption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="/index.php">Simption</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navMenu" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/clients.php">Clients</a></li>
        <li class="nav-item"><a class="nav-link" href="/attendance.php">Attendance</a></li>
        <li class="nav-item"><a class="nav-link" href="/products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
        <?php if(!isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/register.php">Register</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/profile.php">Hello <?=htmlspecialchars($_SESSION['user']['name'])?></a></li>
          <li class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
