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
    <meta charset="UTF-8">
    <title>Login Sytem!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
<?php include("./navbarAlt.php");?>
<main> 
<section>
           
<div class="contact-content" id="signup-contact">
            <div class="contact-form-container">
                <h1>Log In</h1>
                <form class="contact-form" action="../includes/login.inc.php" method="post">
                    <h3>Email/Gebruikersnaam</h3>
                    <input type="text" name="uid" placeholder="Email/Gebruikersnaam" required="required">
                    <h3>Password</h3>
                    <input type="password" name="pwd" placeholder="Wachtwoord" >
                    <button type="submit" name="submit">Log in</button>
                </form>
                <?php
                    // Error messages
                    if (isset($_GET["error"])) {
                      if ($_GET["error"] == "emptyinput") {
                        echo "<p>Fill in all fields!</p>";
                      }
                      else if ($_GET["error"] == "wronglogin") {
                        echo "<p>Wrong login!</p>";
                      }
                    }
                  ?>
            </div>
        </div>

</section>
</main> 

<?php include("./footerAlt.php");?>