<?php
require_once __DIR__ . '/../connection/db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simption Tech - Creative ID & Attendance Solutions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/drift-zoom/dist/drift-basic.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<body>

<!-- Top Bar -->
<div class="container-fluid bg-light py-2">
    <div class="container">
        <div class="d-flex justify-content-end">
            <div class="small me-4">
                <i class="fas fa-headset me-1"></i> Happy to help: +91 12345 67890
            </div>
            <div>
                <a href="login.php" class="text-decoration-none text-dark me-3"><i class="fas fa-user me-1"></i> Login / Register</a>
                <a href="cart.php" class="text-decoration-none text-dark"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="bg-white shadow-sm sticky-top">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Simption Logo.png" alt="Simption Tech Logo" style="height: 40px;">
            </a>

            <!-- Search Bar -->
            <div class="mx-auto d-none d-lg-block" style="width: 400px;">
                <div class="input-group">
                    <input type="text" class="form-control search-bar" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <!-- Right Side Buttons -->
            <div class="d-flex align-items-center">
                <a href="quote.php" class="btn btn-bulk-order me-3 d-none d-lg-block">Order in Bulk</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    
                    <!-- All Custom Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="allProductsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">All Custom Products</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="allProductsDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="#">Subcategory 1</a>
                                        <a href="#">Subcategory 2</a>
                                        <a href="#">Subcategory 3</a>
                                        <a href="#">Subcategory 4</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/id-cards-promo.jpg" class="mega-menu-preview-image" alt="Featured Products">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Office Stationeries & Notebooks -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="officeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Office Stationeries & Notebooks</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="officeDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="#">Notebooks</a>
                                        <a href="#">Diaries</a>
                                        <a href="#">Calendars</a>
                                        <a href="#">Desk Accessories</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/attendance-promo.jpg" class="mega-menu-preview-image" alt="Office Stationeries">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Drinkware -->
                    <li class="nav-item"><a class="nav-link" href="#">Drinkware</a></li>
                    
                    <!-- T-Shirts, Caps & Bags -->
                    <li class="nav-item"><a class="nav-link" href="#">T-Shirts, Caps & Bags</a></li>
                    
                    <!-- Customised Gifts -->
                    <li class="nav-item"><a class="nav-link" href="#">Customised Gifts</a></li>
                    
                    <!-- Visiting Cards -->
                    <li class="nav-item"><a class="nav-link" href="#">Visiting Cards</a></li>
                    
                    <!-- Stickers, Packaging & Labels -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="stickersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Stickers, Packaging & Labels</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="stickersDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="#">Vinyl Stickers</a>
                                        <a href="#">Paper Stickers</a>
                                        <a href="#">Packaging Solutions</a>
                                        <a href="#">Labels</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/id-cards-promo.jpg" class="mega-menu-preview-image" alt="Stickers & Packaging">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Wall Graphics & Large Format Printing -->
                    <li class="nav-item"><a class="nav-link" href="#">Wall Graphics & Large Format Printing</a></li>
                    
                    <!-- ID Card Holders & Accessories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="id-cards.php" id="idcardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">ID Card Holders & Accessories</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="idcardDropdown">
                            <div class="row">
                                <div class="col-md-7"><div class="mega-menu-links">
                                    <a href="product.php?id=1" data-image="assets/images/menu-previews/rfid-card.jpg">RFID Cards</a>
                                    <a href="product.php?id=2" data-image="assets/images/menu-previews/pvc-card.jpg">PVC Cards</a>
                                    <a href="product.php?id=3" data-image="assets/images/menu-previews/pouch-card.jpg">Pouch Cards</a>
                                    <a href="product.php?id=4" data-image="assets/images/menu-previews/uv-card.jpg">UV Printed Cards</a>
                                </div></div>
                                <div class="col-md-5"><div class="mega-menu-image">
                                    <img src="assets/images/menu-featured/id-cards-promo.jpg" class="mega-menu-preview-image" alt="ID Card Products">
                                </div></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>