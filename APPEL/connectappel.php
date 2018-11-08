<?php
$servername = "localhost";
$username = "root";
$password = "waxyman2002";
$dbname = "appel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$servername = null;
$username = null;
$password = null;
$dbname = null;

?> 
