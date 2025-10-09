<?php 
require 'connection/db.php';

if (!empty($_GET['code']) && !empty($_GET['email'])) {
    $code  = $_GET['code'];
    $email = $_GET['email'];

    // Check if user exists with this email + code and not yet verified
    $stmt = $pdo->prepare(
        "SELECT id FROM users WHERE email = ? AND verify_code = ? AND is_verified = 0"
    );
    $stmt->execute([$email, $code]);

    if ($user = $stmt->fetch()) {
        // Mark user as verified
        $pdo->prepare(
            "UPDATE users SET is_verified = 1, verify_code = NULL WHERE id = ?"
        )->execute([$user['id']]);

        $message = "Email verified! You may now login.";
    } else {
        $message = "Invalid or already used verification link.";
    }
} else {
    $message = "Missing parameters.";
}

include 'includes/header.php'; 
?> 

<div class="container py-5">
  <div class="alert alert-info">
    <?php echo htmlspecialchars($message); ?>
  </div>
  <a href="login.php" class="btn btn-primary">Go to Login</a>
</div>

<?php include 'includes/footer.php'; ?>
