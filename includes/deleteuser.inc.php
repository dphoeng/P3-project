<?php
session_start();
include '../pages/mysql.php';

// check if authenticated to visit page
if (isset($_SESSION["userid"])) {
	if ($_SESSION["userRole"] < 2) {
		header("Location: ../index.php");
		exit();
	}
} else {
	header("Location: ../index.php");
	exit();
}


$id = $_GET["id"];

$stmt = $conn->prepare("DELETE FROM users WHERE usersId = ?;");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
	echo "succes";
} else {
	echo "error";
}

header("Location: ../pages/dashboard.php");

?>