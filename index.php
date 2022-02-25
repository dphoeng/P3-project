<?php
	session_start();
	include_once './includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Document</title>
	<link rel="stylesheet" href="src/css/style.css">
	<!-- <link rel="stylesheet" href="src/css/grid.css"> -->
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
            </ul>

            <ul>
             <?php
                if (isset($_SESSION["userid"])) {
                    if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] >= 1)
                    {
                        echo "<li><a href='./pages/artikelmaken.php'>Archief</a></li>";
                        if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 2) {
                            echo "<li><a href='./pages/dashboard.php'>Dashboard</a></li>";
                        }
                    }
                    echo "<li><a href='./pages/logout.php'>Logout</a></li>";
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

<main>
    <div class="banner">

    </div>
    <div class="container" id="sport">
        <div class="row">
            <div class="category"><h2>Sport</h2></div>
            <div class="artikels">
                <div class="cover">
                    <img src="./src/img/thing.jpg" alt="">
                </div>
                <div class="side">a</div>
            </div>
        </div>
    </div>
    <div class="container" id="politiek">
        <div class="row">
            <div class="category"><h2>Politiek</h2></div>
            <div class="artikels">
                <div class="cover">
                    <img src="./src/img/theng.jpg" alt="">
                </div>
                <div class="side">a</div>
            </div>
        </div>
    </div>
    <div class="container" id="economie">
        <h2>Economie</h2>
    </div>
    <div class="container" id="tech">
        <h2>Tech</h2>
    </div>
</main>
</body>
<script src="./src/js/nav.js"></script>
</html>