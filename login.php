<?php
require 'connection/db.php';
session_start();
$err = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
  $stmt->execute([$email]);
  $u = $stmt->fetch();
  if($u && password_verify($password, $u['password'])){
    if(!$u['is_verified']){
      $err = 'Please verify your email before login.';
    } else {
      $_SESSION['user'] = ['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']];
      header('Location: /index.php'); exit;
    }
  } else $err = 'Invalid credentials.';
}
include 'includes/header.php';
if(isset($_SESSION['notice'])){ echo '<div class="alert alert-info">'.htmlspecialchars($_SESSION['notice']).'</div>'; unset($_SESSION['notice']); }
?>
<h1>Login</h1>
<?php if($err) echo '<div class="alert alert-danger">'.htmlspecialchars($err).'</div>'; ?>
<form method="post">
  <div class="mb-3"><label>Email</label><input name="email" class="form-control"></div>
  <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control"></div>
  <button class="btn btn-primary">Login</button>
</form>
<?php include 'includes/footer.php'; ?>
