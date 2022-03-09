<?php
session_start();
include_once '../includes/functions.inc.php';
include './mysql.php';

if (!isset($_SESSION["userid"]))
{
	header("Location: ../index.php");
	exit();
}

$sql = "SELECT * FROM artikelen ORDER BY datum desc";

$result = mysqli_query($conn, $sql);

$rows = "";

while ($record = mysqli_fetch_assoc($result)) {
	$sqlUser = "SELECT * FROM users WHERE usersId = {$record['usersId']}";
	$resultUser = mysqli_query($conn, $sqlUser);
	$recordUser = mysqli_fetch_assoc($resultUser);
	$name = $recordUser['usersFirstName'] . " " . $recordUser['usersMiddleName'] . " " . $recordUser['usersLastName'];

	switch ($record['categorie']) {
		case 0:
			$categorieText = "Sport";
			break;

		case 1:
			$categorieText = "Politiek";
			break;

		case 2:
			$categorieText = "Economie";
			break;

		case 3:
			$categorieText = "Tech";
			break;
	}


	$rows .= "<tr>
					<td><img src='{$record['imageLocation']}' alt=''></td>
					<td>{$record['titel']}</td>
					<td>{$record['text']}</td>
					<td>{$record['datum']}</td>
					<td>{$name}</td>
					<td>{$categorieText}</td>
					<td><a href='./update.php?artikelId={$record['artikelId']}'><i class='bx bx-edit-alt'></i></i></a></td>
					<td><a href='./delete.php?artikelId={$record['artikelId']}'><i class='bx bx-trash'></i></i></a></td>
					<td>TBA</td>
				</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Document</title>
	<link rel="stylesheet" href="src/css/style.css">
	<!-- <link rel="stylesheet" href="src/css/grid.css"> -->
	<link rel="stylesheet" href="src/css/hamburger.css">
	<link rel="stylesheet" href="src/css/hamburger.min.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
	<a href="./artikelmaken.php">Artikel maken</a>
	<table>
		<thead>
			<tr>
				<th></th>
				<th>Artikel</th>
				<th>Text</th>
				<th>Datum</th>
				<th>Editor</th>
				<th>Cat.</th>
				<th>Ed.</th>
				<th>Del.</th>
				<th>Add</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $rows; ?>
		</tbody>
	</table>
</body>

</html>