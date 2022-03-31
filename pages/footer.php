<footer>
	<div class="container">
		<div class="row">
			<div class="footer-col">
				<h4>Dagblad Algemeen</h4>
				<ul>
					<li><a href='./index.php'>Home</a></li>
					<?php
					if (isset($_SESSION["userid"])) {
						if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] >= 1) {
							echo "<li><a href='./pages/archief.php'>Archief</a></li>";
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
			<div class="footer-col">
				<h4>News</h4>
				<ul>
					<?php foreach ($categoryList as $categoryId) {
						echo '<li><a onclick="scrollToCards(\'#'. strtolower($dictionary[$categoryId]) .'\')">'.$dictionary[$categoryId].'</a></li>';
					} ?>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Contact</h4>
				<ul>
					<li><a href="https://www.google.com/maps/place/Daltonlaan+300,+3584+BK+Utrecht/@52.0871365,5.1584627,17z/data=!3m1!4b1!4m5!3m4!1s0x47c668a2918b16e9:0x95fac93d2c242c97!8m2!3d52.0871365!4d5.1606514">Daltonlaan 300</a></li>
					<li><a href="#">035123456636</a></li>
					<li><a href="#">dagbladalgemeen@gmail.com</a></li>
					<li><a href="#">©️copyright-Andrej/Philip/Daniël</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Follow Us</h4>
				<div class="social-links">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
				</div>
			</div>
			<div class="footer-col logo">
				<img src="./src/img/dagblad_algemeen2.png" alt="">
			</div>
		</div>
	</div>
</footer>