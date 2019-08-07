<?php
$pw = $_COOKIE['password'];
$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');$redirect_after_login = 'files_lp/liste.php';

$sql = "SELECT (aktuellesPW) FROM passwort";
$statement = $pdo->query($sql);
$result = $statement->fetch(PDO::FETCH_ASSOC);
$aktuellesPW = $result['aktuellesPW'];

if (isset($_GET['succsess'])) {
    if ($_GET['succsess'] == "pwupdated") {
        $remember_password = strtotime('+1 days');
        $sql = "SELECT (aktuellesPW) FROM passwort";
        $statement = $pdo->query($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $aktuellePW = $result['aktuellesPW'];
        setcookie("password", $aktuellePW, $remember_password);
        header('Refresh:5;url=./admin.php?succsess=pwupdate');
    }
} elseif (empty($_COOKIE['password'])) {
    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
    header('Location: files_lp/login.php');
    exit;
} elseif ($pw != $aktuellesPW) {
    header('Location: files_lp/login.php');
    exit;
} else {
    header("Location: files_lp/liste.php");
}



