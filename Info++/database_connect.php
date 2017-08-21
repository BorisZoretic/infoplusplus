<?php
$servername = "montambeault.duckdns.org/localhost";
$username = "root";
$password = "";
$dbname = "infoplusplus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//remember to $conn->close() after finishing with query
?>
