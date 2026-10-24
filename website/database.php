<!-- Pabal Ahmed
2/13/2026
Phase-01 Login and Logout
IT202-004 Internet Applications
pa478@njit.edu -->

<?php
 function getDB($echo_mode = false) {
   $host = 'db';
   $port = 3306;
   $dbname = 'laptop';
   $username = 'laptopDBadmin';
   $password = 'thinkp4d!';
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   try {
       $db = new mysqli($host, $username, $password, $dbname, $port);
       error_log("Database connection successful to " . $host);
       if ($echo_mode) echo "Database connection successful to " . $host;
       return $db;
   } catch (mysqli_sql_exception $e) {
       error_log("Database connection failed: " . $e->getMessage());
       if ($echo_mode) echo "Database connection failed: " . $e->getMessage();
   }
 }
 //getDB(true);
?>