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
            <li><a href="newGradeKey.php">Notenschlüssel bearbeiten</a></li>
            <li><a href="newStudent.php">Schüler anlegen</a></li>
            <li><a href="debug.php">Debugseite</a></li>
        </ul>
    </div>
</div>

