<?php
require 'db.php';
$redirect_after_login = './admin.php';
$remember_password = strtotime('+1 days');
//Wenn passwort korrekt, speichert cookie mit passwort für einen Tag

if (isset($_POST['password'])) {

    $pw = $_POST['password'];
    $sql = "SELECT (aktuellesPW) FROM passwort";
    $statement = $pdo->query($sql);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $aktuellesPW = $result['aktuellesPW'];
    $pw_check = password_verify($pw, $aktuellesPW);

    if ($pw_check == true) {
        setcookie("password", $aktuellesPW, $remember_password);
        header('Location: ' . $redirect_after_login);
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Passwort geschützte Seite</title>
</head>
<body>
<div style="text-align:center;margin-top:50px;">
    Bitte Passwort für die Seite angeben.
    <form method="POST">
        <input type="password" name="password" autofocus>
    </form>
</div>
</body>
</html>
