<?php
require 'includes.php';

session_start();
Database::connect();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Registrierung</title>
    </head>
<body>
    <div class="loginContainer">
    <div class="loginBox">
        <div id="logoContainer" class="logoLoginContainer">
            <div id="headline"><span>sch<span id="logoDots">u</span>va</span> Auskunft</div>
            <div id="subHeadline">Online Noten & -Schülerverwaltung</div>
        </div>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($password) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($password != $password2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $password_hash));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
    ?>
        <form id="loginForm" class="formElement loginForm" autocomplete="off">
            <div id="usernameInputElement"><img src="images/userIcon.svg"></div><input id="username" class="loginInput usernameInput" type="text" placeholder="Benutzername" name="benutzerName" autocomplete="off" ><br>
            <div id="emailInputElement"><img src="images/userIcon.svg"></div><input id="email" class="loginInput emailInput" type="text" placeholder="E-Mail" name="email" autocomplete="off" ><br>

            <div id="passwordInputElement"><img src="images/passwordIcon.svg"></div><input id="password" class="loginInput passwordInput" type="password" placeholder="Passwort" name="password" autocomplete="new-password" ><br>
            <div id="passwordInputElement"><img src="images/passwordIcon.svg"></div><input id="password2" class="loginInput passwordInput" type="password" placeholder="Passwort wiederholen" name="password2" autocomplete="new-password" ><br>

            <input class="styledButton loginButton" type="submit" value="Register">
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>