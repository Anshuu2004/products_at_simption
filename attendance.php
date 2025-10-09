<?php 
include 'includes/header.php'; 
?> 

<div class="container py-5">
  <h1>Attendance Management</h1>
  <p class="text-muted">
    We provide multiple attendance capture methods. Click below to explore each option.
  </p>

  <div class="row g-3">
    <div class="col-md-4">
      <a href="attendance/rfid.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>RFID Attendance</h5>
          <p class="small text-muted">Smart card based tracking</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/face.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>Face Recognition</h5>
          <p class="small text-muted">AI‑powered biometric system</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/fingerprint.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>Fingerprint</h5>
          <p class="small text-muted">Secure biometric verification</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/qr.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>QR Code</h5>
          <p class="small text-muted">Scan‑based attendance</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/barcode.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>Barcode</h5>
          <p class="small text-muted">Simple code scanning</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/geo.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>Geo Location</h5>
          <p class="small text-muted">GPS‑based attendance</p>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="attendance/manual.php" class="text-decoration-none">
        <div class="card p-3 h-100 text-center">
          <h5>Manual Entry</h5>
          <p class="small text-muted">Traditional record keeping</p>
        </div>
      </a>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
