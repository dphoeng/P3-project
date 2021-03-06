<header>
    <nav>
        <div class="logo">
            <a href="./index.php"><img src="./src/img/dagblad_algemeen.png" alt=""></a>
        </div>
        <div class="menu">
            <ul class="categories">
				<?php foreach ($categoryList as $categoryId) {
					echo '<li><a onclick="scrollToCards(\'#'. strtolower($dictionary[$categoryId]) .'\')">'.$dictionary[$categoryId].'</a></li>';
				} ?>
            </ul>

            <ul>
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
        <div class="mobile-hamburger">
            <button class="hamburger hamburger--arrow" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </button>
        </div>
    </nav>
</header>