<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


if (isset($_POST["submit"])) {
	$titel = $_POST["titel"];
	$text = $_POST["text"];
	switch ($_POST["keuzeveld"]) {
		case "Sport":
			$categorie = 0;
			break;

		case "Politiek":
			$categorie = 1;
			break;

		case "Economie":
			$categorie = 2;
			break;

		case "Tech":
			$categorie = 3;
			break;
	}

	$userid = $_SESSION["userid"];
	$datum = date("Y-m-d H:i:s");

	require_once "../pages/mysql.php";
	require_once "../includes/functions.inc.php";

	$stmt = $conn->prepare("INSERT INTO artikelen (artikelId, usersId, titel, text, datum, categorie) VALUES (NULL, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssi", $userid, $titel, $text, $datum, $categorie);

	if ($stmt->execute()) {
		header("Location: ../index.php");
	} else {
		header("Location: ../index.php");
	}
	

} else {
	header("Location: ../pages/login.php");
	exit();
}
?>