<?php

if (!isset($_POST['submit'])) {
    header("Location: ../../?message=Iets_ging_mis_bij_ons.");
    exit();
}

$name = $_POST['naam'];
$email = $_POST['mail'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Checkt of alles is ingevuld. (Ookall is er op de html required maar die kunnen worden weg gehaald in inspector)
if (!isset($message) || !isset($subject) || !isset($email) || !isset($name)) {
    header("Location: ../../?message=Je moet al de fields invullen.");
    exit();
}

$headers  = 'MIME-Version: 1.0' . "\r\n".
    'Content-type: text/html; charset=UTF-8' . "\r\n".
    'From: Contact | Escape room Excido    '."\r\n".
    'Reply-To: Excido@gmail.nl'."\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($email, "Contact Form", getSuccessfullySendTemplate($subject, $message), $headers) &&
    mail("333925@student.mboutrecht.nl", 'Contact Form | '.$subject, getHTMLTemplate($name, $email, $subject, $message), $headers)) {
    header("Location: ../../index.php?message=Bericht_Verzonden");
    exit();
} else {
    header("Location: ../../index.php?message=Iets ging mis bij ons.");
    exit();
}

function getSuccessfullySendTemplate($subject, $message)
{
    return '
            <!DOCTYPE html>
            <html>
                <style>
                    body {
                        width: 100%;
                        height: 100%;
                        text-align: center;
                    }
                    hr {
                        color: #89CFF0;
                    }
                </style>
                <body>
                    <h1>Escape room Excido</h1>
                    <hr>
                    <h3>Jou bericht is verzonden.</h3>
                    <br>
                    <br>
                    <h2>Onderwerp:</h2>
                    <p>'.$subject.'</p>
                    <br>
                    <h2>Bericht:</h2>
                    <p>'.$message.'</p>
                </body>
            </html>
            ';
}

function getHTMLTemplate($name, $email, $subject, $message) {
    return '
            <!DOCTYPE html>
            <html>
                <style>
                    body {
                        width: 100%;
                        height: 100%;
                        text-align: center;
                    }
                    hr {
                        color: #89CFF0;
                    }
                </style>
                <body>
                    <h1>Escape room Excido</h1>
                    <hr>
                    <h2>Naam:</h2>
                    <p>'.$name.'</p>
                    <br>
                    <h2>Email:</h2>
                    <p>'.$email.'</p>
                    <br>
                    <h2>Onderwerp:</h2>
                    <p>'.$subject.'</p>
                    <br>
                    <h2>Bericht:</h2>
                    <p>'.$message.'</p>
                </body>
            </html>
            ';
}