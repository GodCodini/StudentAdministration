<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 07:45
 */
session_start();
require_once 'project_files/Database.php';
include_once "files_lp/includes/DoublyLinkedList.php";
include_once "files_lp/includes/Element.php";
include_once "files_lp/includes/Student.php";
include_once "files_lp/helper/listHelper.php";
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            <li><a href="debug.php">Debugseite</a></li>
        </ul>
    </div>
</div>