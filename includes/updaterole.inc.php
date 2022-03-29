<?php
session_start();
require_once "../pages/mysql.php";

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

// check if fields were filled in in case user came here without post
if (!isset($_GET['id']) || !isset($_GET['role']))
{
	header("Location: ../index.php");
	exit();
}

switch ($_GET['role']) {
	case 'visitor':
		$role = 0;
		break;

	case 'editor':
		$role = 1;
		break;

	case 'admin':
		$role = 2;
		break;

	default:
		echo "bruh what";
		header("Location: ../index.php");
		break;
}

$stmt = $conn->prepare("UPDATE users SET role = ? WHERE usersId = ?");
$stmt->bind_param("ii", $role, $_GET['id']);

if ($stmt->execute()) {
	header("Location: ../pages/dashboard.php");
} else {
	header("Location: ../pages/dashboard.php");
}

?>