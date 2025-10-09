<?php 
require 'connection/db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $pass  = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);

    if ($u = $stmt->fetch()) {
        if (!password_verify($pass, $u['password'])) {
            $error = "Invalid credentials.";
        } elseif (!$u['is_verified']) {
            $error = "Please verify your email before logging in.";
        } else {
            // Remove sensitive fields before storing in session
            unset($u['password'], $u['verify_code']);
            $_SESSION['user'] = $u;

            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Invalid credentials.";
    }
}

include 'includes/header.php'; 
?> 

<div class="container py-5">
  <h2>Login</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>

  <form method="post" class="mt-3">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Login</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
