<?php
session_start();
include './mysql.php';

if (!isset($_SESSION["userid"]))
{
	header("Location: ../index.php");
	exit();
}

$artikelId = $_GET["artikelId"];

$stmt = $conn->prepare("DELETE FROM artikelen WHERE artikelId = ?;");
$stmt->bind_param("i", $artikelId);

if ($stmt->execute()) {
	echo "succes";
} else {
	echo "error";
}

header("Location: ./archief.php");

?>