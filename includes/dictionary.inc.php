<?php

$dictionary = [];

// dictionary for determining category
$sql = "SELECT * FROM categorie";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$dictionary[$row['categorieId']] = $row['name'];
	}
}
?>