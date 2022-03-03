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

	
	$target_dir = "../src/img/uploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$typeArray = array("jpg", "png", "jpeg", "gif");

	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if ($check !== false) {
    	echo "File is an image - " . $check["mime"] . ".";
		if ($_FILES["file"]["size"] < 5000000) {
			if (in_array($imageFileType, $typeArray)) {
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
				} else {
					echo "image not uploaded";
				}
			} else {
				echo "Wrong filetype";
			}
		} else {
			echo "File is too large";
		}
	} else {
		echo "File is not an image.";
	}

	require_once "../pages/mysql.php";
	require_once "../includes/functions.inc.php";

	$stmt = $conn->prepare("INSERT INTO artikelen (artikelId, usersId, titel, text, datum, categorie, imageLocation) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssi", $userid, $titel, $text, $datum, $categorie, $target_file);

	if ($stmt->execute()) {
		header("Refresh: 5; Location: ../index.php");
	} else {
		header("Location: ../index.php");
	}
	

} else {
	header("Location: ../pages/login.php");
	exit();
}
?>