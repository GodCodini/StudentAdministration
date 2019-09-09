<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 09.08.2019
 * Time: 11:03
 */

require 'includes.php';

?>

<div id="headerContainer">
    <div id="logoContainer">
        <div id="headline"><span>sch<span id="logoDots">u</span>va</span> Auskunft</div>
        <div id="subHeadline">Online Noten & -Schülerverwaltung</div>
    </div>

    <div id="menuContainer">
        <ul>
            <li><a class="currentPage" href="index.php">Übersicht</a></li> <!-- TODO: create JS to change css class to link of current Page-->
            <li><a href="erstellungKlasse.php">Klassen</a></li>
            <li><a href="erstellungSchueler.php">Schüler</a></li>
            <li style="cursor: no-drop"><a onclick="return confirm('Bist Du sicher?')" style="cursor: no-drop" href="einstellungen.php"><strong style="color: red">Reset Database</strong></a></li>
        </ul>
    </div>
</div>