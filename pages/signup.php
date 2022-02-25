<?php
include_once '../includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Sytem!</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/grid.css">

</head>
<body>
<nav>
        <div class="logo">
            <h1><a href="index.html"></a>ES.Excido</h1>
        </div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <?php
            if (isset($_SESSION["userid"])) {
                echo "<li><a href='./pages/logout.php'>Logout</a></li>";
            }
            if (isset($_SESSION["userRole"]) && $_SESSION["userRole"] == 1)
                 echo "<li><a href='dashboard.php'>Dashboard</a></li>";
            else {
                echo "<li><a href='./signup.php'>Sign up</a></li>";
                echo "<li><a href='#'>Log in</a></li>";
            }
         ?>
        </ul>
    </nav>
    <div class="contact-content" id="signup-contact">
            <div class="contact-form-container">
                <h1>Sign Up</h1>
                <form class="contact-form" action="../includes/signup.inc.php" method="post">
                    <h3>Voornaam</h3>
                    <input type="text" name="voornaam" placeholder="Je voornaam" required>
                    <h3>Tussenvoegsel</h3>
                    <input type="text" name="tussenvoegsel" placeholder="Je tussenvoegsel">
                    <h3>Achternaam</h3>
                    <input type="text" name="achternaam" placeholder="Je achternaam" required>
                    <h3>E-Mail</h3>
                    <input type="mail" name="email" placeholder="Je E-Mail" required>
                    <h3>Gebruikersnaam</h3>
                    <input type="text" name="uid" placeholder="Je gebruikersnaam" required>
                    <h3>Wachtwoord</h3>
                    <input type="password" name="pwd" placeholder="Wachtwoord" required>
                    <h3>Wachtwoord herhalen</h3>
                    <input type="password" name="pwdrepeat" placeholder="Wachtwoord Herhalen" required>
                    <button type="submit" name="submit">Submit</button>
                </form>


                <?php
                if (isset($_GET["newpwd"])) {
                  if ($_GET["newpwd"] == "passwordupdated") {
                    echo '<p class="signupsuccess">Your password has been reset!</p>';
                  }
                }
                ?>
                <a href="reset-password.php">Forgot your password</a>

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
            </div>
        </div>
</body>
