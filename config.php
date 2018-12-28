<?php
$servername = "localhost";
$username = "eftekhar_us";
$password = "qazQAZ12_";
$dbname = "eftekhar_pt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 