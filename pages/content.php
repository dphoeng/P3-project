<?php

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


<main>
    <h1 class="banner">Dagblad Algemeen</h1>
    <div class="container" id="sport">
        <div class="card">
            <h2>Sport</h2>
            <div class="row">
                <div class="col main-article <?php if (isset($_SESSION["userid"])) { echo "logged-in";} ?>">
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
                <div class="col main-article <?php if (isset($_SESSION["userid"])) { echo "logged-in";} ?>">
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
                <div class="col main-article <?php if (isset($_SESSION["userid"])) { echo "logged-in";} ?>">
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
                <div class="col main-article <?php if (isset($_SESSION["userid"])) { echo "logged-in";} ?>">
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
