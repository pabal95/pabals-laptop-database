<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function getDB($echo_mode = false) {

   $host = 'db'; 
   $port = 3306;
   $dbname = 'laptop';
   $username = 'laptopDBadmin';
   $password = 'thinkp4d!';
   mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   
   try {
       $db = new mysqli($host, $username, $password, $dbname, $port);
       return $db;
   } catch (mysqli_sql_exception $e) {
       // This will print the EXACT reason it is failing directly to your screen!
       die("Database connection failed: " . $e->getMessage()); 
   }
 }
?>