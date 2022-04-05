<?php
include './mysql.php';
include '../includes/dictionary.inc.php';
session_start();
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
					<h2>Artikel aanmaken</h2>
				</div>

				<div class="form">
					<form action="../includes/artikelmaken.inc.php" method="post" enctype="multipart/form-data" id="form">
						<input type="text" name="titel" placeholder="Titel" maxlength=50 required>
						<textarea name="text" form="form" placeholder="Text" maxlength=500 required></textarea>
						<div class="form-row">
							<select name="keuzeveld">
								<?php foreach ($dictionary as $category) {
									echo '<option value="' . $category . '">' . $category . '</option>';
								} ?>
							</select>
							<input type="file" name="file" id="file" required>
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