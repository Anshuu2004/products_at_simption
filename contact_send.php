<?php
// 1. Include the database connection
require 'connection/db.php';

// 2. Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 3. Get the form data and perform basic cleaning
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // 4. Basic validation
    if (empty($name) || !$email || empty($subject) || empty($message)) {
        // If validation fails, you could redirect back with an error
        // For simplicity, we'll just stop the script.
        die("Please fill out all required fields.");
    }

    // 5. Prepare the SQL INSERT statement to prevent SQL injection
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // 6. Execute the statement with the form data
    try {
        $stmt->execute([$name, $email, $subject, $message]);
        
        // 7. Redirect to a "thank you" page on success
        header("Location: thank-you.php");
        exit;
    } catch (PDOException $e) {
        // In a real application, you would log this error
        die("Error: Could not save the message. " . $e->getMessage());
    }

} else {
    // If someone accesses this page directly, redirect them to the homepage
    header("Location: index.php");
    exit;
}