<?php
session_start();
require_once "../pages/mysql.php";
require_once "../includes/functions.inc.php";
include "./dictionary.inc.php";

if (!isset($_SESSION["userid"]))
{
	header("Location: ../index.php");
	exit();
}

$artikelId = $_GET["artikelId"];

if (isset($_POST["submit"])) {
	$titel = $_POST["titel"];
	$text = $_POST["text"];

	$categorie = array_search($_POST["keuzeveld"], $dictionary);

	$datum = date("Y-m-d H:i:s");

	$sql = 'SELECT imageLocation FROM artikelen WHERE artikelId = (SELECT max(artikelId) FROM artikelen)';
	$result = $conn->query($sql);
	if (!$_FILES["file"]["name"] == 0)
	{
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

		$stmt = $conn->prepare("UPDATE artikelen SET titel = ?, text = ?, categorie = ?, imageLocation = ? WHERE artikelId = ?");
		$stmt->bind_param("ssisi", $titel, $text, $categorie, $save_file, $artikelId);
	} else {
		$stmt = $conn->prepare("UPDATE artikelen SET titel = ?, text = ?, categorie = ? WHERE artikelId = ?");
		$stmt->bind_param("ssii", $titel, $text, $categorie, $artikelId);
	}

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