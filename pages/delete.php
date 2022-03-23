<?php
session_start();
include './mysql.php';

// check if authenticated to visit page
if (isset($_SESSION["userid"])) {
	if ($_SESSION["userRole"] < 1) {
		header("Location: ../index.php");
		exit();
	}
} else {
	header("Location: ../index.php");
	exit();
}


$artikelId = $_GET["artikelId"];

$sql = "SELECT * FROM artikelen WHERE artikelId = {$artikelId}";

$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_assoc($result);

if ($record['usersId'] != $_SESSION['userid'] && $_SESSION['userRole'] < 2) {
	header("Location: ../index.php");
	exit();
}

$stmt = $conn->prepare("DELETE FROM artikelen WHERE artikelId = ?;");
$stmt->bind_param("i", $artikelId);

if ($stmt->execute()) {
	echo "succes";
} else {
	echo "error";
}

header("Location: ./archief.php");

?>