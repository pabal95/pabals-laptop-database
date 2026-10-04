<?php
// Pabal Ahmed
// 2/13/2026
// Phase-01 Login and Logout
// IT202-004 Internet Applications
// pa478@njit.edu

// 1. MUST start the session before you can destroy it
session_start();

if(isset($_SESSION['login'])) {
    session_unset();
    session_destroy();
}

// 2. Redirect back to the index (which will now show the login screen)
header("Location: index.php");
exit; // Always exit after a header redirect
?>