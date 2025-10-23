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
    <!-- System font stack in CSS; removing Google Fonts for performance -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/drift-zoom/dist/drift-basic.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- Top Bar -->
<div class="container-fluid bg-light py-2">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="small me-4">
                <i class="fas fa-headset me-1"></i> Happy to help: +91  9074822542
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
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Simption Logo.png" alt="Simption Tech Logo" style="height: 40px;">
            </a>

            <!-- Search Bar -->
            <div class="mx-auto d-none d-lg-block" style="width: 20%;">
                <div class="input-group">
                    <input type="text" class="form-control search-bar" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <!-- Right Side Buttons -->
            <div class="d-flex align-items-center">
                <a href="quote.php" class="btn btn-primary me-2 d-none d-lg-block">Order in Bulk</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto justify-content-center mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    
                    <!-- All Products Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="allProductsDropdown" role="button">All Products</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="allProductsDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <!-- ID Cards -->
                                        <a href="product.php?id=2" data-image="assets/images/menu-featured/pvc-card.jpg">PVC Card</a>
                                        <a href="product.php?id=3" data-image="assets/images/menu-featured/pouch-card.jpg">Pouch Card</a>
                                        <a href="product.php?id=4" data-image="assets/images/menu-featured/uv-card.jpg">UV-Card</a>
                                        <a href="product.php?id=1" data-image="assets/images/menu-featured/rfid-card.jpg">RFID-Card</a>

                                        <!-- Attendance Devices -->
                                        <a href="product.php?attendance=1" data-image="assets/images/attendance/att_rfid.png">RFID Machine</a>
                                        <a href="product.php?attendance=2" data-image="assets/images/attendance/att_fingerprint.png">Fingerprint Machine</a>
                                        <a href="product.php?attendance=3" data-image="assets/images/attendance/att_face.png">Face Scanner</a>
                                        <a href="product.php?attendance=4" data-image="assets/images/attendance/att_face.png">Face ID Attendance Machine</a>
                                        <a href="product.php?attendance=5" data-image="assets/images/attendance/att_qr.png">QR Scanner</a>
                                        <a href="product.php?attendance=6" data-image="assets/images/attendance/att_barcode.png">Barcode Scanner</a>

                                        <!-- Lanyards -->
                                        <a href="product.php?lanyard=1">Polyester Lanyards</a>
                                        <a href="product.php?lanyard=2">Nylon Lanyards</a>
                                        <a href="product.php?lanyard=3">Lanyard Prints</a>
                                        <a href="product.php?lanyard=4">Customized Lanyards</a>

                                        <!-- Badges -->
                                        <a href="product.php?badge=1">Metal Badges</a>
                                        <a href="product.php?badge=2">Plastic Badges</a>
                                        <a href="product.php?badge=3">Clip Badges</a>
                                        <a href="product.php?badge=4">Magnetic Badges</a>

                                        <!-- ERP & Software -->
                                        <a href="product.php?erp=1">School Management Software</a>
                                        <a href="product.php?erp=2">Attendance Management Systems</a>
                                        <a href="product.php?erp=3">Website Development Services</a>
                                        <a href="product.php?erp=4">Android App Development</a>
                                        <a href="product.php?erp=5">Communication Services</a>
                                        <a href="product.php?erp=6">Bus Tracking System</a>
                                        <a href="product.php?erp=7">Online Learning Solutions</a>
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
                    
                    <!-- ID Cards Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="id-cards.php" id="idCardsDropdown" role="button">ID Cards</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="idCardsDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="product.php?id=2" data-image="assets/images/menu-featured/pvc-card.jpg">PVC Card</a>
                                        <a href="product.php?id=3" data-image="assets/images/menu-featured/pouch-card.jpg">Pouch Card</a>
                                        <a href="product.php?id=4" data-image="assets/images/menu-featured/uv-card.jpg">UV-Card</a>
                                        <a href="product.php?id=1" data-image="assets/images/menu-featured/rfid-card.jpg">RFID-Card</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/id-cards-promo.jpg" class="mega-menu-preview-image" alt="ID Card Products">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Attendance Device Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="attendance.php" id="attendanceDropdown" role="button">Attendance Device</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="attendanceDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="product.php?attendance=1" data-image="assets/images/attendance/att_rfid.png">RFID Machine</a>
                                        <a href="product.php?attendance=2" data-image="assets/images/attendance/att_fingerprint.png">Fingerprint Machine</a>
                                        <a href="product.php?attendance=3" data-image="assets/images/attendance/att_face.png">Face Scanner</a>
                                        <a href="product.php?attendance=4" data-image="assets/images/attendance/att_face.png">Face ID Attendance Machine</a>
                                        <a href="product.php?attendance=5" data-image="assets/images/attendance/att_qr.png">QR Scanner</a>
                                        <a href="product.php?attendance=6" data-image="assets/images/attendance/att_barcode.png">Barcode Scanner</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/attendance-promo.jpg" class="mega-menu-preview-image" alt="Attendance Devices">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Lanyards Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="lanyard.php" id="lanyardsDropdown" role="button">Lanyards</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="lanyardsDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="product.php?lanyard=1">Polyester Lanyards</a>
                                        <a href="product.php?lanyard=2">Nylon Lanyards</a>
                                        <a href="product.php?lanyard=3">Lanyard Prints</a>
                                        <a href="product.php?lanyard=4">Customized Lanyards</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/lanyards-promo.jpg" class="mega-menu-preview-image" alt="Lanyards">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- Badges Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="badge.php" id="badgesDropdown" role="button">Badges</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="badgesDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="product.php?badge=1">Metal Badges</a>
                                        <a href="product.php?badge=2">Plastic Badges</a>
                                        <a href="product.php?badge=3">Clip Badges</a>
                                        <a href="product.php?badge=4">Magnetic Badges</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/badges-promo.jpg" class="mega-menu-preview-image" alt="Badges">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <!-- ERP Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="erp.php" id="erpDropdown" role="button">ERP</a>
                        <div class="dropdown-menu mega-menu" aria-labelledby="erpDropdown">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mega-menu-links">
                                        <a href="product.php?erp=1">School Management Software</a>
                                        <a href="product.php?erp=2">Attendance Management Systems</a>
                                        <a href="product.php?erp=3">Website Development Services</a>
                                        <a href="product.php?erp=4">Android App Development</a>
                                        <a href="product.php?erp=5">Communication Services</a>
                                        <a href="product.php?erp=6">Bus Tracking System</a>
                                        <a href="product.php?erp=7">Online Learning Solutions</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mega-menu-image">
                                        <img src="assets/images/menu-featured/erp-promo.jpg" class="mega-menu-preview-image" alt="ERP Solutions">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link" href="clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>