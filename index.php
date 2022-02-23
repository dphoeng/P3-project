<?php
	session_start();
	include_once './includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Document</title>
	<link rel="stylesheet" href="src/css/style.css">
	<link rel="stylesheet" href="src/css/hamburger.css">
	<link rel="stylesheet" href="src/css/hamburger.min.css">
</head>
<body>
<header>
<nav>
        <div class="logo">
            <a href="./index.php"><img src="./src/img/dagblad_algemeen.png" alt=""></a>
        </div>
		<div class="menu">
        <ul>
            <li><a href="#sport">Sport</a></li>
            <li><a href="#politiek">Politiek</a></li>
            <li><a href="#economie">Economie</a></li>
            <li><a href="#tech">Tech</a></li>
         <?php
            if (isset($_SESSION["userid"])) {
                echo "<li><a href='./pages/logout.php'>Logout</a></li>";
            if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 1)
                 echo "<li><a href='./pages/reservation.php'>Reservation</a></li>";
                 echo "<li><a href='./pages/dashboard.php'>Dashboard</a></li>";
           } else {
                echo "<li><a href='./pages/signup.php'>Sign up</a></li>";
                echo "<li><a href='./pages/login.php'>Log in</a></li>";
            }
         ?>
        </ul>
		</div>
        <div class="mobile-hamburger">
            <button class="hamburger hamburger--arrow" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </button>
        </div>
    </nav>
</header>
	<?php if (isset($_SESSION["userid"])) {
		echo "<button><a href=\"./pages/logout.php\">Uitloggen</a></button>";
		echo "<button><a href=\"./pages/artikelmaken.php\">Artikel maken</a></button>";
	} else {
		echo "<button><a href=\"./pages/login.php\">Login</a></button>";
		echo "<button><a href=\"./pages/signup.php\">Registreren</a></button>";
	}
	?>
<main>

</main>
</body>
<script src="src/js/nav.js"></script>
</html>