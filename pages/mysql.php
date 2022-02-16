<?php

$servername = "198.244.216.169";
$dbUsername = "philip";
$password = "vc^yN9Nn$#eva9Fx_c3gC4Q*h0mWjH#6";
$dbname = "projectp3philip";
// Create connection
$conn = new mysqli($servername, $dbUsername, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}