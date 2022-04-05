<?php

session_start();
include './mysql.php';
include '../includes/dictionary.inc.php';

if (!isset($_SESSION["userid"]))
{
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Document</title>
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/hamburger.css">
	<link rel="stylesheet" href="../src/css/hamburger.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

	<?php include("./navbarAlt.php"); ?>

	<main>
		<div class="container">
			<div class="text-editor">
				<div class="logo">
					<img src="../src/img/dagblad_algemeen3.png" alt="">
					<h2>Artikel aanpassen</h2>
				</div>

				<div class="form">
					<form action="../includes/artikelupdaten.inc.php?artikelId=<?php echo $artikelId; ?>" method="post" enctype="multipart/form-data">
						<input type="text" name="titel" value="<?php echo $record['titel']; ?>" placeholder="Titel" maxlength=50 required>
						<textarea name="text" form="form" value="<?php echo $record['text']; ?>" placeholder="Text" maxlength=500 required></textarea>
						<div class="form-row">
							<select name="keuzeveld">
								<?php foreach ($dictionary as $category) {
									echo '<option value="' . $category . '" '; if ($record['categorieId'] == array_search($category, $dictionary)) { echo "selected";} echo '>' . $category . '</option>';
								} ?>
							</select>
							<input type="file" name="file" id="file" required>
							<img src=".<?php echo $record['imageLocation']; ?>" alt="">
							<button type="submit" name="submit">Publiceren</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>

	<?php include("./footerAlt.php"); ?>

</body>

</html>