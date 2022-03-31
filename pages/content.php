<?php

// class for each catagory, which has an array for all the articles with that catagory
class CardInfo
{
    public $category;
    public $articleArray;

    function __construct($category)
    {
        $this->category = $category;
        $this->articleArray = array();
    }

    public function addToArray($article)
    {
        array_push($this->articleArray, $article);
    }
}

// article class
class Article
{
    public $title;
    public $imageLocation;

    function __construct($title, $imageLocation)
    {
        $this->title = $title;
        $this->imageLocation = $imageLocation;
    }
}

// initialize array where all the different cards go into
$cards = array();

// add catagory cards to cards array -- $categoryList is initialized in index.php because it's needed by other files too
for ($y = 0; $y < $categoriesCount; $y++)
{
    array_push($cards, new CardInfo($dictionary[$categoryList[$y]]));
}

// loop through each catagory that has an article and find up to 5 articles and put them into an array in the right card
for ($x = 0; $x < $categoriesCount; $x++)
{
    $sql = 'SELECT * FROM artikelen WHERE sendToMain = 1 AND categorie = ' . $categoryList[$x] . ' ORDER BY datum DESC LIMIT 5';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cards[$x]->addToArray(new Article($row['titel'],$row['imageLocation']));
        }
    }
}
?>

<main>
    <h1 class="banner">Dagblad Algemeen</h1>

    <!-- loops through all the catagory cards and creates cards out of them -->
    <?php foreach ($cards as $card) {
        echo '<div class="container" id="' . strtolower($card->category). '">' . 
                '<div class="card">' .
                    '<h2>' . $card->category . '</h2>' .
                    '<div class="row">' .
                        '<div class="col main-article '; if (isset($_SESSION["userid"]) && count($card->articleArray) > 1) { echo "logged-in";} echo '">' .
                            '<img src="'; echo $card->articleArray[0]->imageLocation; echo '">' .
                            '<span>' . $card->articleArray[0]->title . '</span>' .
                        '</div>';
                if (isset($_SESSION["userid"]) && count($card->articleArray) > 1) {
                    echo '<div class="col side-articles">';
                    for ($i = 1; $i < count($card->articleArray); $i++) {
                        echo '<div class="row">
                                <div class="col article">
                                    <img src="'.$card->articleArray[$i]->imageLocation.'">
                                </div>
                                <div class="col article-text">
                                    <p>' . $card->articleArray[$i]->title . '</p>
                                </div>
                            </div>';
                    }
                    echo '</div>';
                }
                echo '</div>' .
                '</div>' .
            '</div>';
    }
    ?>

</main>