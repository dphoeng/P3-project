<?php

$servername = "localhost";
$dbUsername = "root";
$password = "";
$dbname = "projectp3";
// Create connection
$conn = new mysqli($servername, $dbUsername, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}