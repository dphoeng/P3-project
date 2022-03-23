<?php

session_start();
include './mysql.php';
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

<form class="contact-form" action="../includes/artikelupdaten.inc.php?artikelId=<?php echo $artikelId; ?>" method="post" enctype="multipart/form-data">
    <h3>Titel</h3>
    <input type="text" name="titel" value="<?php echo $record['titel']; ?>" maxlength=50 required>
    <h3>Text</h3>
    <input type="text" name="text" value="<?php echo $record['text']; ?>" maxlength=100 required>
	<select name="keuzeveld">
		<option value="Sport" <?php if ($record['categorie'] == 0) { echo "selected";} ?> >Sport</option>
		<option value="Politiek" <?php if ($record['categorie'] == 1) { echo "selected";} ?> >Politiek</option>
		<option value="Economie" <?php if ($record['categorie'] == 2) { echo "selected";} ?> >Economie</option>
		<option value="Tech" <?php if ($record['categorie'] == 3) { echo "selected";} ?> >Tech</option>
	</select>
	<h3>Image</h3>
	<img src=".<?php echo $record['imageLocation']; ?>" alt="">
    <input type="file" name="file" id="file">
    <button type="submit" name="submit">Publiceren</button>
</form>