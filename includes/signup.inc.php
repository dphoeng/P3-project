<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $voornaam = $_POST["voornaam"];
  $tussenvoegsel = $_POST["tussenvoegsel"];
  $achternaam = $_POST["achternaam"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "../pages/mysql.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputSignup($voornaam, $achternaam, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../pages/signup.php?error=emptyinput");
    exit();
  }
  // Proper username chosen
  if (invalidUid($username) !== false) {
    header("location: ../pages/signup.php?error=invaliduid");
    exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../pages/signup.php?error=invalidemail");
    exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../pages/signup.php?error=passwordsdontmatch");
    exit();
  }
  // Is the username taken already
  if (checkIfExists($conn, "usersUid", $username) !== false) {
    header("location: ../pages/signup.php?error=usernametaken");
    exit();
  }
  // Is the email taken already
  if (checkIfExists($conn, "usersEmail", $email) !== false) {
    header("location: ../pages/signup.php?error=emailtaken");
    exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $voornaam, $tussenvoegsel, $achternaam, $email, $username, $pwd);
} else {
  header("location: ../pages/signup.php");
  exit();
}
