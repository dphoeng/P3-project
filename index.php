<?php
session_start();
include_once './includes/functions.inc.php';
include './pages/mysql.php';
include './includes/dictionary.inc.php';

// sql for finding how many catagories there are
$sql = 'SELECT DISTINCT categorieId FROM artikelen WHERE sendToMain = 1 ORDER BY categorieId ASC';
$result = $conn->query($sql);
$categoriesCount = $result->num_rows;

$categoryList = [];

// find all category (numbers) and place them in a list
if ($result->num_rows > 0)
{
    while ($category = $result->fetch_assoc()) {
        array_push($categoryList, $category['categorieId']);
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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

    <?php include("./pages/navbar.php");?>

    <?php include("./pages/content.php");?>

    <?php include("./pages/footer.php");?>

</body>
<script src="./src/js/nav.js"></script>
<script src="./src/js/scroll.js"></script>

</html>