<?php

include_once '../includes/functions.inc.php';
session_start();

if (isset($_SESSION["userid"])) {
	header("Location: ../index.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Dagblad Algemeen</title>
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/css/hamburger.css">
    <link rel="stylesheet" href="../src/css/hamburger.min.css">
	  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>


<body>
  <?php include("./navbarAlt.php"); ?>

  <main>
    <div class="container">
      <div class="text-editor login">
        <div class="logo">
          <img src="../src/img/dagblad_algemeen3.png" alt="">
          <h2>Registreer</h2>
        </div>

        <div class="form">
        <form action="../includes/signup.inc.php" method="post" id="form">
          <div class="name">
            <input type="text" name="voornaam" placeholder="Voornaam" required>
            <input type="text" name="tussenvoegsel" placeholder="Tussenvoegsel">
            <input type="text" name="achternaam" placeholder="Achternaam" required>
            </div>
            <input type="mail" name="email" placeholder="E-Mail" required>
            <input type="text" name="uid" placeholder="Gebruikersnaam" required>
            <input type="password" name="pwd" placeholder="Wachtwoord" required>
            <input type="password" name="pwdrepeat" placeholder="Wachtwoord Herhalen" required>
            <button type="submit" name="submit">Registreer</button>
            <a href="./login.php">Hebt u al een account? Klik dan hier in te loggen.</a>
            <?php
              // Error messages
              if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                  echo "<p>Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "invaliduid") {
                  echo "<p>Choose a proper username!</p>";
                }
                else if ($_GET["error"] == "invalidemail") {
                  echo "<p>Choose a proper email!</p>";
                }
                else if ($_GET["error"] == "passwordsdontmatch") {
                  echo "<p>Passwords doesn't match!</p>";
                }
                else if ($_GET["error"] == "stmtfailed") {
                  echo "<p>Something went wrong!</p>";
                }
                else if ($_GET["error"] == "usernametaken") {
                  echo "<p>Username already taken!</p>";
                }
                else if ($_GET["error"] == "none") {
                  echo "<p>You have signed up!</p>";
                }
              }
            ?>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php include("./footerAlt.php"); ?>

</body>

<script src="../src/js/nav.js"></script>

</html>
