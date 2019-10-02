<?php
//$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');
//$redirect_after_login = 'index.php';
//$remember_password = strtotime('+1 days');
////Wenn passwort korrekt, speichert cookie mit passwort für einen Tag
//
//if (isset($_POST['password'])) {
//
//    $pw = $_POST['password'];
//    $sql = "SELECT (aktuellesPW) FROM passwort";
//    $statement = $pdo->query($sql);
//    $result = $statement->fetch(PDO::FETCH_ASSOC);
//    $aktuellesPW = $result['aktuellesPW'];
//    $pw_check = password_verify($pw, $aktuellesPW);
//
//    if ($pw_check == true) {
//        setcookie("password", $aktuellesPW, $remember_password);
//        header('Location: ' . $redirect_after_login);
//        exit;
//    }
//}

include_once 'project_files/Database.php';
include_once 'project_files/_config.php';

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT password, privileg, privName from teacher
        LEFT JOIN privileg ON teacher.privileg = privileg.id_privileg
        WHERE login = ?";

    $result = $PDO->prepare($sql);
    $result->execute(array($username));
    $fetch = $result->fetchAll(PDO::FETCH_ASSOC);

    $dbpass = $fetch[0]['password'];

    if (password_verify($password, $dbpass))
    {
        session_start();
        $_SESSION['UserLogin'] = $username;
        $_SESSION['UserRight'] = $fetch[0]['privName'];
        header('Location: index.php?login=sucsess');
    }
    else
    {
        header('Location: login.php?login=error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Passwort geschützte Seite</title>
    <link rel="stylesheet" href="files_lp/styles/login.css">
</head>
<body>
<div class="login">
    <h1>Anmeldung Schülerverwaltung</h1>
    <h4>Friedrich-List-Berufskolleg</h4>
    <form method="post">
        <input type="text" name="username" placeholder="Benutzername" required="required" />
        <input type="password" name="password" placeholder="Passwort" required="required" />
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
</div>
</body>
</html>

