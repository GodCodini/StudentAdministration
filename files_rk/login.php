<?php
require 'includes.php';
?>

<div class="loginContainer">
    <div class="loginBox">
        <div id="logoContainer" class="logoLoginContainer">
            <div id="headline"><span>sch<span id="logoDots">u</span>va</span> Auskunft</div>
            <div id="subHeadline">Online Noten & -Schülerverwaltung</div>
        </div>

        <form action="erstellungSchueler.php" id="loginForm" class="formElement loginForm" autocomplete="off">
            <div id="usernameInputElement"><img src="images/userIcon.svg"></div><input id="username" class="loginInput usernameInput" type="text" placeholder="Benutzername" name="benutzerName" autocomplete="off" ><br>

            <div id="passwordInputElement"><img src="images/passwordIcon.svg"></div><input id="password" class="loginInput passwordInput" type="password" placeholder="Passwort" name="klassenName" autocomplete="new-password" ><br>

            <input class="styledButton loginButton" type="submit" value="Einloggen">
            <span id="registerAccount"><a class="loginSublink" href="register.php">Noch kein Konto?</a></span><span id="resetPassword"><a class="loginSublink" href="resetPassword.php">Passwort vergessen?</a></span>
        </form>
    </div>

    <span id="copyrightArea">© <?php echo date("Y"); ?> | Print Media Group GmbH & Co. KG</span>

<?php
include 'footer.php';
?>