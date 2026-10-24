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
        session_start(); // Only start session right before assigning variables
        $_SESSION['login'] = $name;
        header("Location: index.php");
        exit;
    } else {
        // Invalid credentials
        header("Location: index.php?error=invalid");
        exit;
    }
} else {
    // Invalid email format
    header("Location: index.php?error=invalid");
    exit;
}
?>