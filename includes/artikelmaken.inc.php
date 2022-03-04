<?php
session_start();

require_once "../pages/mysql.php";
require_once "../includes/functions.inc.php";

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

	$sql = 'SELECT imageLocation FROM artikelen WHERE artikelId = (SELECT max(artikelId) FROM artikelen)';
	$result = $conn->query($sql);
	
	$imageId = 0;

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$imageId = pathinfo($row['imageLocation'],PATHINFO_FILENAME);
			$imageId++;
		}
	}
	
	$target_dir = "../src/img/uploads/";
	$save_dir = "./src/img/uploads/";
	$imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
	
	$target_file = $target_dir . $imageId . '.' . $imageFileType;
	$save_file = $save_dir . $imageId . '.' . $imageFileType;
	
	$typeArray = array("jpg", "png", "jpeg", "gif");
	
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if ($check !== false) {
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

	$stmt = $conn->prepare("INSERT INTO artikelen (artikelId, usersId, titel, text, datum, categorie, imageLocation) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssis", $userid, $titel, $text, $datum, $categorie, $save_file);

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