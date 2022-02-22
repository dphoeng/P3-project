<?php
	session_start();
	include_once './includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Document</title>
</head>
<body>
	<?php if (isset($_SESSION["userid"])) {
		echo "<button><a href=\"./pages/logout.php\">Uitloggen</a></button>";
		echo "<button><a href=\"./pages/artikelmaken.php\">Artikel maken</a></button>";
	} else {
		echo "<button><a href=\"./pages/login.php\">Login</a></button>";
		echo "<button><a href=\"./pages/signup.php\">Registreren</a></button>";
	}
	?>

</body>
</html>