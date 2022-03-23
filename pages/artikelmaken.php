<?php

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
<link rel="stylesheet" href="../src/css/style.css">
<?php include("./navbarAlt.php");?>

<main>
<form class="contact-form" action="../includes/artikelmaken.inc.php" method="post" enctype="multipart/form-data">
    <h3>Titel</h3>
    <input type="text" name="titel" placeholder="Titel" maxlength=50 required>
    <h3>Text</h3>
    <input type="text" name="text" placeholder="Text" maxlength=100 required>
	<select name="keuzeveld">
		<option value="Sport">Sport</option>
		<option value="Politiek">Politiek</option>
		<option value="Economie">Economie</option>
		<option value="Tech">Tech</option>
	</select>
	<h3>Image</h3>
    <input type="file" name="file" id="file" required>
    <button type="submit" name="submit">Publiceren</button>
</form>
</main>