<?php
if($_SERVER['REQUEST_METHOD']!=='POST') exit('Invalid');
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$msg = $_POST['message'] ?? '';
// TODO: save to DB or send mail. Placeholder:
mail('sales@simption.example', 'Contact from website', "From: $name <$email>\n\n$msg");
header('Location: /contact.php');
