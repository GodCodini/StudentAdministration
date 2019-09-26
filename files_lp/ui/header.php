<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */

session_start();
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';
include_once "files_lp/includes/DoublyLinkedList.php";
include_once "files_lp/includes/Element.php";
include_once "files_lp/includes/Student.php";
include_once "files_lp/helper/listHelper.php";

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
//$pw = $_COOKIE['password'];
//var_dump($pw);
//$redirect_after_login = 'index.php';
//
//$sql = "SELECT (aktuellesPW) FROM passwort";
//$statement = $PDO->query($sql);
//$result = $statement->fetch(PDO::FETCH_ASSOC);
//$aktuellesPW = $result['aktuellesPW'];
////wenn das passwort geändert wurde, cookie aktualisieren
//if (isset($_GET['succsess']))
//{
//    if ($_GET['succsess'] == "pwupdated")
//    {
//        $remember_password = strtotime('+1 days');
//        $sql = "SELECT (aktuellesPW) FROM passwort";
//        $statement = $PDO->query($sql);
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        $aktuellePW = $result['aktuellesPW'];
//        setcookie("password", $aktuellePW, $remember_password);
//        header('Refresh:5;url=./admin.php?succsess=pwupdate');
//    }
//}
//elseif (empty($_COOKIE['password']))
//{
//    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
//    header('Location: ./login.php');
//    exit;
//}
//elseif ($pw != $aktuellesPW)
//{
//    header('Location: ./login.php');
//    exit;
//}
//else
//{
//    header("Location: index.php");
//}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script type="text/javascript">
        //auto expand textarea
        function adjust_textarea(h) {
            h.style.height = "20px";
            h.style.height = (h.scrollHeight)+"px";
        }
    </script>
    <link rel="stylesheet" href="files_lp/styles/styles.css">
    <title>Schülerverwaltung</title>
</head>
<body>
<div id="headerContainer">
    <div id="logoContainer">
        <div id="headline"><span>Schulen</span>VZ</div>
        <div id="subHeadline">Die Schulenverwaltungszentrale</div>
    </div>

    <div id="menuContainer">
        <ul>
            <li><a href="index.php">Übersicht</a></li>
            <li><a href="newClass.php">Klasse erstellen</a></li>
            <li><a href="newStudent.php">Schüler anlegen</a></li>
            <li><a href="newGradeKey.php">Notenschlüssel bearbeiten</a></li>
            <li><a href="debug.php">Debugseite</a></li>
        </ul>
    </div>
</div>

