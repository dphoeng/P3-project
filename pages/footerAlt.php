<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

	<footer>
		<div class="container">
			<div class="row">
				<div class="footer-col alt">
					<h4>Dagblad Algemeen</h4>
					<ul>
						<li><a href='../index.php'>Home</a></li>
						<?php
						if (isset($_SESSION["userid"])) {
							if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] >= 1) {
								echo "<li><a href='./archief.php'>Archief</a></li>";
								if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 2) {
									echo "<li><a href='./dashboard.php'>Dashboard</a></li>";
								}
							}
							echo "<li><a href='./logout.php'>Logout</a></li>";
						} else {
							echo "<li><a href='./pages/signup.php'>Sign up</a></li>";
							echo "<li><a href='./login.php'>Log in</a></li>";
						}
						?>
					</ul>
				</div>
				<div class="footer-col alt">
					<h4>Contact</h4>
					<ul>
						<li><a href="#">Daltonlaan 300</a></li>
						<li><a href="#">035123456636</a></li>
						<li><a href="#">dagbladalgemeen@gmail.com</a></li>
						<li><a href="#">©️copyright-Andrej/Philip/Daniël</a></li>
					</ul>
				</div>
				<div class="footer-col alt">
					<h4>Follow Us</h4>
					<div class="social-links">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
				<div class="footer-col alt logo">
					<img src="../src/img/dagblad_algemeen2.png" alt="">
				</div>
			</div>
		</div>
	</footer>

</body>

</html>