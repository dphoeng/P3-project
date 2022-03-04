<?php

require_once "../pages/mysql.php";

$sql = 'SELECT imageLocation FROM artikelen WHERE artikelId = (SELECT max(artikelId) FROM artikelen)';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
        $imageId = pathinfo($row['imageLocation'],PATHINFO_FILENAME);
        echo $imageId . '<br>';
        $imageId++;
        echo $imageId;
    }
}

?>

<form class="contact-form" action="./debug2.php" method="post" enctype="multipart/form-data">
	<h3>Image</h3>
    <input type="file" name="file" id="file" required>
    <button type="submit" name="submit">Publiceren</button>
</form>