<?php 
require 'connection/db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $error = "Please complete the required fields.";
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO contact_messages (name, email, subject, message) VALUES (?,?,?,?)"
        );
        $stmt->execute([$name, $email, $subject, $message]);

        // Later: send email notifications via SMTP
        $success = "Thanks! Your message has been received.";
    }
}

include 'includes/header.php'; 

$enquiry     = $_GET['enquiry'] ?? null;
$enquiryList = $_SESSION['enquiry'] ?? [];
?> 

<div class="container py-5">
  <div class="row">

    <!-- Contact Form -->
    <div class="col-md-7">
      <h2>Contact Us</h2>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success">
          <?php echo htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>

      <form method="post" class="mt-3">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Subject</label>
          <input name="subject" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button class="btn btn-primary">Send Message</button>
      </form>
    </div>

    <!-- Enquiry Sidebar -->
    <div class="col-md-5">
      <h5>Current Enquiry</h5>

      <?php if (empty($enquiryList)): ?>
        <div class="text-muted">
          No products added to enquiry. Add from a product page.
        </div>
      <?php else: ?>
        <ul class="list-group">
          <?php foreach ($enquiryList as $item): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <strong><?php echo htmlspecialchars($item['title']); ?></strong><br>
                <small>₹ <?php echo number_format($item['price'], 2); ?></small>
              </div>
              <div>
                <img src="assets/images/<?php echo htmlspecialchars($item['image']); ?>" 
                     style="height:50px; object-fit:cover;" 
                     alt="">
              </div>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="mt-3">
          <small class="text-muted">
            When you submit this form, your selected products will be included in the enquiry email (SMTP in Step 5).
          </small>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>

<?php include 'includes/footer.php'; ?>
