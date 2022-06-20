<?php 
// Database configuration 
$dbHost     = "127.0.0.1:3307"; 
$dbUsername = "root"; 
$dbPassword = "root"; 
$dbName     = "hbc_db"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}else{
    //echo"Connection Success";

}