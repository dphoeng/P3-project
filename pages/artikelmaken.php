<?php

session_start();
if (!isset($_SESSION["userid"]))
{
	header("Location: ../index.php");
	exit();
}


?>

<form class="contact-form" action="../includes/artikelmaken.inc.php" method="post" enctype="multipart/form-data">
    <h3>Titel</h3>
    <input type="text" name="titel" placeholder="Titel" required>
    <h3>Text</h3>
    <input type="text" name="text" placeholder="Text" required>
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