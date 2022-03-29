<?php
session_start();
include_once '../includes/functions.inc.php';
include './mysql.php';

// check if authenticated to visit page
if (isset($_SESSION["userid"])) {
	if ($_SESSION["userRole"] < 2) {
		header("Location: ../index.php");
		exit();
	}
} else {
	header("Location: ../index.php");
	exit();
}

$sql = "SELECT * FROM users";

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

// get current page's users
$sql = "SELECT * FROM users ORDER BY usersId asc LIMIT $start, $per_page";
$result = mysqli_query($conn, $sql);

// saves logged in user's information for later use
$sql = "SELECT * FROM users WHERE usersId = {$_SESSION['userid']}";
$resultCurrentUser = mysqli_query($conn, $sql);
$recordCurrentUser = mysqli_fetch_assoc($resultCurrentUser);
$currentName = $recordCurrentUser['usersFirstName'] . " " . $recordCurrentUser['usersMiddleName'] . " " . $recordCurrentUser['usersLastName'];

$rows = "";

// loop through current page's sql result
while ($record = mysqli_fetch_assoc($result)) {
	// TODO: add table rows and columns for information
	$role = "";

	switch ($record['role']) {
		case 0:
			$role = "Visitor";
			break;
		
		case 1:
			$role = "Editor";
			break;
		
		case 2:
			$role = "Admin";
			break;
		
		default:
			$role = "";
			break;
	}

	$rows .= "<tr>
				<td width='5%'>{$record['usersId']}</td>
				<td width='40%'>{$record['usersFirstName']} {$record['usersMiddleName']} {$record['usersLastName']}</td>
				<td width='35%'>{$record['usersEmail']}</td>
				<td width='15%'><div class='role-select'>
								<div class='dropdown' id='dropdownId{$record['usersId']}'>
									<div class='default-select'>
										<a>{$role}</a>
									</div>
									<div class='options'>
										<div class='option' onclick=\"select('Visitor', 'dropdownId{$record['usersId']}')\">
											<a>Visitor</a>
										</div>
										<div class='option' onclick=\"select('Editor', 'dropdownId{$record['usersId']}')\">
											<a>Editor</a>
										</div>
										<div class='option' onclick=\"select('Admin', 'dropdownId{$record['usersId']}')\">
											<a>Admin</a>
										</div>
									</div>
								</div>
								<a onclick='submit({$record['usersId']})'>
									<i class='bx bxs-save'></i>
								</a>
								</div>
							</td>
				<td width='5%'><a onClick='confirmPopup(\"../includes/deleteuser.inc.php?id={$record['usersId']}\",\"Are you sure you want to delete this user?\")'><i class='bx bx-trash'></i></a></td>
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
						<label>Logged in as <?php echo $currentName; ?></label>
					</div>
				</div>
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Naam</th>
								<th>Email</th>
								<th>Rol</th>
								<th>Del.</th>
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
							<a href="dashboard.php?page=<?php if ($page > 1) {
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
									echo "<li class='current-page'><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
								}
							}
						} else if ($page < 5) {
							for ($i = $paginationStart; $i < $paginationStart + 5 && $i <= $pages; $i++) {
								if ($page == $i) {
									echo "<li class='current-page'><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
								} else {
									echo "<li><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
								}
							}
							echo "<li>...</li>";
							echo "<li><a href='dashboard.php?page=" . $pages . "'>" . $pages . "</a></li>";
						} else {
							echo "<li><a href='dashboard.php?page=1'>1</a></li>";
							echo "<li>...</li>";
							if ($page + 4 > $pages) {
								for ($i = $paginationStart; $i <= $pages; $i++) {
									if ($page == $i) {
										echo "<li class='current-page'><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
									} else {
										echo "<li><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
									}
								}
							} else {
								for ($i = $paginationStart; $i < $paginationStart + 3; $i++) {
									if ($page == $i) {
										echo "<li class='current-page'><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
									} else {
										echo "<li><a href='dashboard.php?page=" . $i . "'>" . $i . "</a></li>";
									}
								}
								echo "<li>...</li>";
								echo "<li><a href='dashboard.php?page=" . $pages . "'>" . $pages . "</a></li>";
							}
						} ?>
						<li>
							<a href="dashboard.php?page=<?php if ($page < $pages) {
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
<script src="../src/js/submit.js"></script>
<script src="../src/js/dropdown_submit.js"></script>

</html>