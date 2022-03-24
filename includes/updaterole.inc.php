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
if (!isset($_POST['keuzeveld']) || !isset($_GET['id']))
{
	header("Location: ../index.php");
	exit();
}

$id = $_GET['id'];

switch ($_POST['keuzeveld']) {
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
$stmt->bind_param("ii", $role, $id);

if ($stmt->execute()) {
	header("Location: ../pages/dashboard.php");
} else {
	header("Location: ../pages/dashboard.php");
}

?>