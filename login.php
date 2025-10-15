<?php 
require 'connection/db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $pass  = $_POST['password'] ?? '';

    if (!$email || !$pass) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT id, name, email, password, is_verified FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password'])) {
            if ($user['is_verified']) {
                // Store only safe user data in session
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email']
                ];
                header("Location: index.php");
                exit;
            } else {
                $error = "Please verify your email before logging in.";
            }
        } else {
            $error = "Invalid email or password.";
        }
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
