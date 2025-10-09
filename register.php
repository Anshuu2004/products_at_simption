<?php 
require 'connection/db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || strlen($password) < 6) {
        $error = "Please provide a name, valid email and a password (min 6 chars).";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = "Email is already registered.";
        } else {
            // Hash password and generate verification code
            $hash        = password_hash($password, PASSWORD_DEFAULT);
            $verify_code = bin2hex(random_bytes(16));

            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password, verify_code) VALUES (?,?,?,?)"
            );
            $stmt->execute([$name, $email, $hash, $verify_code]);

            // Later: add PHPMailer to send verification link
            $success = "Account created. Check DB for verify_code or wait for email (SMTP configured in Step 5).";
        }
    }
}

include 'includes/header.php'; 
?> 

<div class="container py-5">
  <h2>Register</h2>

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
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Register</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
