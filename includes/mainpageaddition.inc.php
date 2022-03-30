<?php

// php for adding article to main page (or rather changing the database sendToMain field for a specific article)

session_start();
include("../pages/mysql.php");

// check if authenticated to visit page
if (isset($_SESSION["userid"])) {
	if ($_SESSION["userRole"] < 2) {
		header("Location: ../pages/archief.php");
		exit();
	}
} else {
	header("Location: ../pages/archief.php");
	exit();
}

if (!isset($_GET['id']) || !isset($_GET['checked']))
{
	header("Location: ../pages/archief.php");
}

$checked = $_GET['checked'] == "true" ? 1 : 0;

$showOnly = isset($_GET['showOnly']) ? $_GET['showOnly'] : 0;
$page = isset($_GET['page']) ? $_GET['page'] : 1;


$stmt = $conn->prepare("UPDATE artikelen SET sendToMain = ? WHERE artikelId = ?");
$stmt->bind_param("ii", $checked, $_GET['id']);

if ($stmt->execute()) {
	header("Location: ../pages/archief.php?showOnly={$showOnly}&page={$page}");
} else {
	header("Location: ../pages/archief.php?showOnly={$showOnly}&page={$page}");
}


?>