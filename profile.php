<?php include 'includes/header.php'; 
if(!isset($_SESSION['user'])){ header('Location:/login.php'); exit; }
?>
<h1>Profile</h1>
<p>Name: <?=htmlspecialchars($_SESSION['user']['name'])?></p>
<p>Email: <?=htmlspecialchars($_SESSION['user']['email'])?></p>
<?php include 'includes/footer.php'; ?>
