<?php
require 'connection/db.php';
$code = $_GET['code'] ?? '';
if($code){
  $stmt = $pdo->prepare('SELECT id FROM users WHERE verification_code = ? LIMIT 1');
  $stmt->execute([$code]);
  $u = $stmt->fetch();
  if($u){
    $pdo->prepare('UPDATE users SET is_verified=1, verification_code=NULL WHERE id=?')->execute([$u['id']]);
    echo 'Email verified. You can <a href="/login.php">login</a>.';
    exit;
  }
}
echo 'Invalid code.';
