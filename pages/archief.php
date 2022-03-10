<?php
session_start();
include_once '../includes/functions.inc.php';
include './mysql.php';

if (!isset($_SESSION["userid"])) {
	header("Location: ../index.php");
	exit();
}

$idCheck = "";

if (!isset($_GET["showOnly"])) {
	$showOnly = 0;
} else if ($_GET["showOnly"]) {
	$showOnly = 1;
	$idCheck = "WHERE usersId = {$_SESSION['userid']}";
} else {
	$showOnly = 0;
}

$sql = "SELECT * FROM artikelen ".$idCheck;

$result = mysqli_query($conn, $sql);

$per_page = 4;
$count = mysqli_num_rows($result);
$pages = ceil($count / $per_page);

if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
}

$start = ($page - 1) * $per_page;

if ($page < 5 || $pages <= 7)
{
	$paginationStart = 1;
} else if ($page + 4 > $pages)
{
	$paginationStart = $pages-4;
} else {
	$paginationStart = $page-1;
}

$sql = "SELECT * FROM artikelen ".$idCheck." ORDER BY datum desc LIMIT $start, $per_page";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM users WHERE usersId = {$_SESSION['userid']}";
$resultCurrentUser = mysqli_query($conn, $sql);
$recordCurrentUser = mysqli_fetch_assoc($resultCurrentUser);
$currentName = $recordCurrentUser['usersFirstName'] . " " . $recordCurrentUser['usersMiddleName'] . " " . $recordCurrentUser['usersLastName'];

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

	$hasRights = $_SESSION["userRole"] > 1 || $_SESSION["userid"] == $recordUser["usersId"];
	$rights = $hasRights ? "<td><a href='./update.php?artikelId={$record['artikelId']}'><i class='bx bx-edit-alt'></i></i></a></td>
							<td><a href='./delete.php?artikelId={$record['artikelId']}'><i class='bx bx-trash'></i></i></a></td>" : "<td></td><td></td>";

	$rows .= "<tr>
					<td><img src='{$record['imageLocation']}' alt=''></td>
					<td>{$record['titel']}</td>
					<td>{$record['text']}</td>
					<td>{$record['datum']}</td>
					<td>{$name}</td>
					<td>{$categorieText}</td>
					" . $rights . "
					<td>TBA</td>
				</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Document</title>
	<link rel="stylesheet" href="../src/css/style.css">
	<!-- <link rel="stylesheet" href="src/css/grid.css"> -->
	<link rel="stylesheet" href="../src/css/hamburger.css">
	<link rel="stylesheet" href="../src/css/hamburger.min.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>






<body>
	<?php include("./navbar.php"); ?>
	<main>
		<div>
			<label>Alleen mijn artikelen laten zien</label>
			<input type="checkbox" id="showOnly" <?php if ($showOnly) { echo "checked"; } ?>>
			<p>Logged in as <?php echo $currentName; ?></p>
			<a href="./artikelmaken.php">Artikel maken</a>
		</div>

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
		<div class="pagination">
			<ul>
				<li>
					<a href="archief.php?showOnly=<?php echo $showOnly; ?>&page=<?php if ($page > 1) {
													echo $page - 1;
												} else {
													echo $page;
												} ?>" aria-label="Previous">
						<span aria-hidden="true">&lsaquo;</span>
					</a>
				</li>
				<?php if ($pages <= 7) {
						for ($i = $paginationStart; $i <= $pages; $i++) {
							if ($page == $i) {
								echo "<li class='current-page'><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
							} else {
								echo "<li><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
							}
						}
					} else if ($page < 5) {
						for ($i = $paginationStart; $i < $paginationStart + 5 && $i <= $pages; $i++) {
							if ($page == $i) {
								echo "<li class='current-page'><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
							} else {
								echo "<li><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
							}
						}
						echo "<li>...</li>";
						echo "<li><a href='archief.php?showOnly=".$showOnly."&page=" . $pages . "'>" . $pages . "</a></li>";
					} else {
						echo "<li><a href='archief.php?showOnly=".$showOnly."&page=1'>1</a></li>";
						echo "<li>...</li>";
						if ($page + 4 > $pages) {
							for ($i = $paginationStart; $i <= $pages; $i++) {
								if ($page == $i) {
									echo "<li class='current-page'><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
								}
							}
						} else {
							for ($i = $paginationStart; $i < $paginationStart + 3; $i++) {
								if ($page == $i) {
									echo "<li class='current-page'><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='archief.php?showOnly=".$showOnly."&page=" . $i . "'>" . $i . "</a></li>";
								}
							}
							echo "<li>...</li>";
							echo "<li><a href='archief.php?showOnly=".$showOnly."&page=".$pages."'>".$pages."</a></li>";
						}
					}?>
				<li>
					<a href="archief.php?showOnly=<?php echo $showOnly; ?>&page=<?php if ($page < $pages) {
													echo $page + 1;
												} else {
													echo $page;
												} ?>" aria-label="Next">
						<span aria-hidden="true">&rsaquo;</span>
					</a>
				</li>
			</ul>
		</div>
	</main>
	<?php include("./footer.php"); ?>

</body>
<script src="../src/js/archief.js"></script>


</html>