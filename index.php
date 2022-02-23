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
            <h1><a href="index.html"></a>ES.Excido</h1>
        </div>
        <ul class="nav-links">
            <li><a href="">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#formulier">Score</a></li>
            <li><a href="#contact-content">Contact</a></li>
         <?php
            if (isset($_SESSION["userid"])) {
                echo "<li><a href='./src/php/logout.php'>Logout</a></li>";
            if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 1)
                 echo "<li><a href='./src/php/reservation.php'>Reservation</a></li>";
                 echo "<li><a href='src/php/dashboard.php'>Dashboard</a></li>";
           } else {
                echo "<li><a href='./src/php/signup.php'>Sign up</a></li>";
                echo "<li><a href='./src/php/login.php'>Log in</a></li>";
            }
         ?>
        </ul>
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

</body>
<script src="src/js/nav.js"></script>
</html>