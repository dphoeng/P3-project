<?php
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
          <h2>Log in</h2>
        </div>

        <div class="form">
          <form action="../includes/login.inc.php" method="post" enctype="multipart/form-data" id="form">
            <input type="text" name="uid" placeholder="Email/Gebruikersnaam" required>
            <input type="password" name="pwd" placeholder="Wachtwoord" required>
            <button type="submit" name="submit">Log in</button>
            <a href="./signup.php">Hebt u nog geen account? Klik dan hier om te registreren.</a>
            <?php
              // Error messages
              if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                  echo "<p>Fill in all fields!</p>";
                  } else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Wrong login!</p>";
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
