<header>
    <nav>
        <div class="logo">
            <a href="./index.php"><img src="../src/img/dagblad_algemeen.png" alt=""></a>
        </div>
        <div class="menu">
            <ul>
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
                    echo "<li><a href='./signup.php'>Sign up</a></li>";
                    echo "<li><a href='./login.php'>Log in</a></li>";
                }

                ?>
                <li><a href='./debug.php'>Debug</a></li>
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