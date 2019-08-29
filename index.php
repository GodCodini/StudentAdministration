<?php
//$pw = $_COOKIE['password'];
//$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');$redirect_after_login = 'files_lp/liste.php';
//
//$sql = "SELECT (aktuellesPW) FROM passwort";
//$statement = $pdo->query($sql);
//$result = $statement->fetch(PDO::FETCH_ASSOC);
//$aktuellesPW = $result['aktuellesPW'];
//
//if (isset($_GET['succsess'])) {
//    if ($_GET['succsess'] == "pwupdated") {
//        $remember_password = strtotime('+1 days');
//        $sql = "SELECT (aktuellesPW) FROM passwort";
//        $statement = $pdo->query($sql);
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        $aktuellePW = $result['aktuellesPW'];
//        setcookie("password", $aktuellePW, $remember_password);
//        header('Refresh:5;url=./admin.php?succsess=pwupdate');
//    }
//} elseif (empty($_COOKIE['password'])) {
//    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
//    header('Location: files_lp/login.php');
//    exit;
//} elseif ($pw != $aktuellesPW) {
//    header('Location: files_lp/login.php');
//    exit;
//} else {
//    header("Location: files_lp/liste.php");
//}
error_reporting(E_ERROR | E_PARSE);
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';
include_once 'files_lp/ui/header.php';
include_once 'files_lp/includes/functions.php';

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);

if (isset($_GET['id']))
{
    $kurs = $_GET['id'];
    if (isset($_SESSION[$kurs]))
    {
        $liste = unserialize($_SESSION[$kurs]);
    }
    else
    {
        listHelper::buildList($kurs);
        $liste = unserialize($_SESSION[$kurs]);
    }
    $array = $liste->readList();

    echo "<table>";
    echo "<tr>";
    echo "<th>Vorname</th>";
    echo "<th>Nachname</th>";
    echo "<th>Geburtsdatum</th>";
    echo "<th>Note hinzufügen</th>";
    echo "</tr>";
    foreach ($array as $row)
    {
        echo "<tr>";
        echo "<td>";
        echo "<a href='grades.php?id=".$row[3]."'>".$row[0]."</a>";
        echo "</td>";
        echo "<td>";
        echo "<p>".$row[1]."</p>";
        echo "</td>";
        echo "<td>";
        echo "<p>".DB::convertDate($row[2])."</p>";
        echo "</td>";
        echo "<td>";
        echo "<a href='newGrade.php?id=".$row[3]."'>Noten für ".$row[0]." ".$row[1]." eintragen</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<pre>";
/*    highlight_string("<?php\n\$liste =\n" . var_export($liste, true) . ";\n?>");*/
    var_dump($liste);
    echo "</pre>";
}
else
    {
    $sql = "SELECT kursName FROM kurs";
    $result = $PDO->query($sql);
    echo "<table id='myTable'>";
        echo "<th>Klasse</th>";
        foreach ($result as $item)
        {
            echo "<tr>";
            echo "<td>";
            echo "<a href='index.php?id=" . $item['kursName'] . "'>" . $item['kursName'] . "</a>";
            echo "</td>";
            echo "</tr>";
        }
    echo "</table>";
}