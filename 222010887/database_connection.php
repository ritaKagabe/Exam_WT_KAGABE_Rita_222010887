<?php
// Connection details
$host = "localhost";
$user = "rita";
$pass = "222010887";
$database = "odmtp";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>