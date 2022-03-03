<?php
session_start();
include_once './includes/functions.inc.php';
include './pages/mysql.php';

for ($x = 0; $x < 4; $x++) {
    $titleArray = array();
    $imageArray = array();
    $sql = 'SELECT * FROM artikelen WHERE categorie = ' . $x . ' ORDER BY datum DESC LIMIT 5';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($titleArray, $row["titel"]);
            array_push($imageArray, $row["imageLocation"]);
        }
    }
    switch ($x) {
        case 0:
            $titleArraySport = $titleArray;
            $imageArraySport = $imageArray;
            break;
        case 1:
            $titleArrayPolitiek = $titleArray;
            $imageArrayPolitiek = $imageArray;
            break;
        case 2:
            $titleArrayEconomie = $titleArray;
            $imageArrayEconomie = $imageArray;
            break;
        case 3:
            $titleArrayTech = $titleArray;
            $imageArrayTech = $imageArray;
            break;
    }
}

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
                        if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] >= 1) {
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
        <h1>Dagblad Algemeen</h1>
        <div class="container" id="sport">
            <div class="card">
                <h2>Sport</h2>
                <div class="row">
                    <div class="col main-article">
                        <img src="<?php echo $imageArraySport[0]; ?>">
                        <span><?php echo $titleArraySport[0]; ?></span>
                    </div>
                    <?php if (isset($_SESSION["userid"])) {
                        echo '<div class="col side-articles">';
                        for ($i = 1; $i < count($titleArraySport); $i++) {
                            echo
                            '<div class="row">
                                <div class="col article">
                                    <img src="'.$imageArraySport[$i].'">
                                </div>
                                <div class="col article-text">
                                    <p>' . $titleArraySport[$i] . '</p>
                                </div>
                            </div>';
                        }
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="container" id="politiek">
            <div class="card">
                <h2>Politiek</h2>
                <div class="row">
                    <div class="col main-article">
                        <img src="<?php echo $imageArrayPolitiek[0]; ?>">
                        <span><?php echo $titleArrayPolitiek[0]; ?></span>
                    </div>
                    <?php if (isset($_SESSION["userid"])) {
                        echo '<div class="col side-articles">';
                        for ($i = 1; $i < count($titleArrayPolitiek); $i++) {
                            echo
                            '<div class="row">
                                <div class="col article">
                                    <img src="'.$imageArrayPolitiek[$i].'">
                                </div>
                                <div class="col article-text">
                                    <p>' . $titleArrayPolitiek[$i] . '</p>
                                </div>
                            </div>';
                        }
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="container" id="economie">
            <div class="card">
                <h2>Economie</h2>
                <div class="row">
                    <div class="col main-article">
                        <img src="<?php echo $imageArrayEconomie[0]; ?>">
                        <span><?php echo $titleArrayEconomie[0]; ?></span>
                    </div>
                    <?php if (isset($_SESSION["userid"])) {
                        echo '<div class="col side-articles">';
                        for ($i = 1; $i < count($titleArrayEconomie); $i++) {
                            echo
                            '<div class="row">
                                <div class="col article">
                                    <img src="'.$imageArrayEconomie[$i].'">
                                </div>
                                <div class="col article-text">
                                    <p>' . $titleArrayEconomie[$i] . '</p>
                                </div>
                            </div>';
                        }
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="container" id="tech">
            <div class="card">
                <h2>Tech</h2>
                <div class="row">
                    <div class="col main-article">
                        <img src="<?php echo $imageArrayTech[0]; ?>">
                        <span><?php echo $titleArrayTech[0]; ?></span>
                    </div>
                    <?php if (isset($_SESSION["userid"])) {
                        echo '<div class="col side-articles">';
                        for ($i = 1; $i < count($titleArrayTech); $i++) {
                            echo
                            '<div class="row">
                                <div class="col article">
                                    <img src="'.$imageArrayTech[$i].'">
                                </div>
                                <div class="col article-text">
                                    <p>' . $titleArrayTech[$i] . '</p>
                                </div>
                            </div>';
                        }
                        echo '</div>';
                    } ?>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="./src/js/nav.js"></script>

</html>