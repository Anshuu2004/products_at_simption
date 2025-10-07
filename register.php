<?php
require 'connection/db.php';
session_start();
$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  if(!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6){
    $errors[] = 'Please provide valid name, email and password (min 6 chars).';
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $code = bin2hex(random_bytes(16));
    $stmt = $pdo->prepare('INSERT INTO users (name,email,password,verification_code) VALUES (?,?,?,?)');
    try {
      $stmt->execute([$name,$email,$hash,$code]);
      // Send verification email (placeholder)
      $verifyLink = (isset($_SERVER['HTTPS'])? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/verify.php?code=' . $code;
      // mail($email, 'Verify your account', "Click: $verifyLink"); // configure your mail system or SMTP
      $_SESSION['notice'] = 'Registered. Please check email to verify (mail sending is a placeholder).';
      header('Location: /login.php'); exit;
    } catch(PDOException $e){
      $errors[] = 'Email already registered or DB error.';
    }
  }
}
include 'includes/header.php';
?>
<h1>Register</h1>
<?php if($errors) foreach($errors as $e) echo '<div class="alert alert-danger">'.htmlspecialchars($e).'</div>'; ?>
<form method="post">
  <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
  <div class="mb-3"><label>Email</label><input name="email" class="form-control"></div>
  <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control"></div>
  <button class="btn btn-primary">Register</button>
</form>
<?php include 'includes/footer.php'; ?>
