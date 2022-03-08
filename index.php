<?php
session_start();
include_once './includes/functions.inc.php';
include './pages/mysql.php';

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

    <?php include("./pages/navbar.php");?>

    <?php include("./pages/content.php");?>

    <?php include("./pages/footer.php");?>

</body>
<script src="./src/js/nav.js"></script>
<script src="./src/js/scroll.js"></script>

</html>