<?php
session_start();
include_once '../includes/functions.inc.php';
include './mysql.php';

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
// if showOnly is checked, sql statements will have the user id as added condition, else empty
$idCheck = "";

if (!isset($_GET["showOnly"])) {
	$showOnly = 0;
} else if ($_GET["showOnly"]) {
	$showOnly = 1;
	$idCheck = "WHERE usersId = {$_SESSION['userid']}";
} else {
	$showOnly = 0;
}

$sql = "SELECT * FROM artikelen " . $idCheck;

$result = mysqli_query($conn, $sql);

// pagination code
$per_page = 5;
$count = mysqli_num_rows($result);
$pages = ceil($count / $per_page);

if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
}

$start = ($page - 1) * $per_page;

/* at what number the middle part of the pagination should start
	ex. 1 ... 5 6 7 ... 12
	5 will be $pagionationStart
*/
if ($page < 5 || $pages <= 7) {
	$paginationStart = 1;
} else if ($page + 4 > $pages) {
	$paginationStart = $pages - 4;
} else {
	$paginationStart = $page - 1;
}

// get current page's articles
$sql = "SELECT * FROM artikelen " . $idCheck . " ORDER BY datum desc LIMIT $start, $per_page";
$result = mysqli_query($conn, $sql);

// saves logged in user's information for later use
$sql = "SELECT * FROM users WHERE usersId = {$_SESSION['userid']}";
$resultCurrentUser = mysqli_query($conn, $sql);
$recordCurrentUser = mysqli_fetch_assoc($resultCurrentUser);
$currentName = $recordCurrentUser['usersFirstName'] . " " . $recordCurrentUser['usersMiddleName'] . " " . $recordCurrentUser['usersLastName'];

$rows = "";

// loop through current page's sql result
while ($record = mysqli_fetch_assoc($result)) {
	// retrieve information of the current article's editor, if user is deleted, $name becomes be "[deleted]"
	// hasRights determines whether the currently logged in user has rights to edit or delete articles
	if (!$record['usersId']) {
		$name = "[deleted]";
		$hasRights = $_SESSION["userRole"] > 1;
	} else {
		$sqlUser = "SELECT * FROM users WHERE usersId = {$record['usersId']}";
		$resultUser = mysqli_query($conn, $sqlUser);
		$recordUser = mysqli_fetch_assoc($resultUser);
		$name = $recordUser['usersFirstName'] . " " . $recordUser['usersMiddleName'] . " " . $recordUser['usersLastName'];
		$hasRights = $_SESSION["userRole"] > 1 || $_SESSION["userid"] == $recordUser["usersId"];
	}
	$hasRightsMain = $_SESSION["userRole"] > 1;

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

	// check permission for deletion/edit rights
	$rights = $hasRights ? "<td width='3%'><a href='./update.php?artikelId={$record['artikelId']}'><i class='bx bx-edit-alt'></i></a></td>
							<td width='3%'><a onClick='confirmPopup(\"./delete.php?artikelId={$record['artikelId']}\",\"Are you sure you want to delete this article?\")'><i class='bx bx-trash'></i></a></td>" : "<td width='3%'></td><td width='3%'></td>";
	$rightsMain = $hasRightsMain ? "<td width='3%'><a><i class='bx bxs-add-to-queue'></i></a></td>" : "<td width='3%'></td><td width='3%'></td>";

	$rows .= "<tr>
					<td width='12%'><img src='.{$record['imageLocation']}' alt=''></td>
					<td width='10%'>{$record['titel']}</td>
					<td width='28%'>{$record['text']}</td>
					<td width='17%'>{$record['datum']}</td>
					<td width='17%'>{$name}</td>
					<td width='7%'>{$categorieText}</td>
					" . $rights . $rightsMain . "
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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
	<?php include("./navbarAlt.php"); ?>
	<main>
		<div class="container">
			<div class="archief">
				<div class="table-top">
					<div>
						<label>Alleen mijn artikelen laten zien</label>
						<input type="checkbox" id="showOnly" <?php if ($showOnly) {
																	echo "checked";
																} ?>>
					</div>
					<div>
						<label>Logged in as <?php echo $currentName; ?></label>
					</div>
					<div>
						<label>Artikel maken</label>
						<a href="./artikelmaken.php"><i class='bx bx-plus'></i></a>
					</div>
				</div>
				<div class="table">
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
				</div>
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
									echo "<li class='current-page'><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
								}
							}
						} else if ($page < 5) {
							for ($i = $paginationStart; $i < $paginationStart + 5 && $i <= $pages; $i++) {
								if ($page == $i) {
									echo "<li class='current-page'><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
								}
							}
							echo "<li>...</li>";
							echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $pages . "'>" . $pages . "</a></li>";
						} else {
							echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=1'>1</a></li>";
							echo "<li>...</li>";
							if ($page + 4 > $pages) {
								for ($i = $paginationStart; $i <= $pages; $i++) {
									if ($page == $i) {
										echo "<li class='current-page'><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
									} else {
										echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
									}
								}
							} else {
								for ($i = $paginationStart; $i < $paginationStart + 3; $i++) {
									if ($page == $i) {
										echo "<li class='current-page'><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
									} else {
										echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $i . "'>" . $i . "</a></li>";
									}
								}
								echo "<li>...</li>";
								echo "<li><a href='archief.php?showOnly=" . $showOnly . "&page=" . $pages . "'>" . $pages . "</a></li>";
							}
						} ?>
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
			</div>
		</div>
	</main>
	<?php include("./footerAlt.php"); ?>

</body>
<script src="../src/js/archief.js"></script>
<script src="../src/js/nav.js"></script>
<script src="../src/js/include.js"></script>

</html>