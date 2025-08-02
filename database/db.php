<?php
$servername = "db2";
$username = "learning_user";
$password = "learning_pass";
$dbname = "dblearning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>