<?php
require_once('database.php');

$emailAddress = $_POST['email_address'] ?? '';
$password = $_POST['password'] ?? '';

// 1. Establish connection immediately
$db = getDB();

// 2. Hard check if connection failed before proceeding
if (!$db) {
    die("Fatal Error: Could not connect to the database container.");
}

// 3. Process Login
if(filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
    $query = "SELECT first_name, last_name FROM laptop_users WHERE email_address = ? AND password = SHA2(?,256)";
    
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $emailAddress, $password);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $fetched = $stmt->fetch();
    $db->close();
    
    $name = "$firstName $lastName";
    
    if ($fetched && isset($name)) {
        // DO NOT run session_start() here. index.php already ran it.
        $_SESSION['login'] = $name;
        
        // Instead of a PHP redirect, use JavaScript to force the browser to reload the dashboard cleanly
        echo "<script>window.location.href='index.php';</script>";
        exit;
    } else {
        // Invalid credentials
        echo "<script>window.location.href='index.php?error=invalid';</script>";
        exit;
    }
} else {
    // Invalid email format
    header("Location: index.php?error=invalid");
    exit;
}
?>