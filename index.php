<?php

?>

<html>
    <head>
        <title>Schülerverwaltung</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="text/javascript" href="functions/functions.js">
    </head>
    <body>
        <ul>
            <li><a href="#tabs-1">Startseite</a></li>
            <li><a href="#tabs-2">Schüler verwalten</a></li>
            <li><a href="#tabs-3">Kurse/Klassen verwalten</a></li>
        </ul>
        <div class="container">
            <div class="row">
                <div id="tabs-1">
                    <p>Test</p>
                    <p>
                        <?php //TODO Startseite einrichten und nett machen ?>
                        Begrüßung<br>
                        Fehlermeldungen
                    </p>
                </div>
                <div id="tabs-2">
                    <?php //TODO Schülerverwaltung implementieren. Tabelle klickbar machen? ?>
                    <p>Comming soon</p>
                    <p>Schüler anlegen/bearbeiten <br>
                       Noten vergeben <br>
                       Schüler Kursen zuweisen<br>
                       Noten von Schülern berechnen 
                    </p>
                </div>
                <div id="tabs-3">
                    <?php //TODO Kurs implementieren. Klassen neu anlegen + mehrere Schüler anlegen ?>
                    <p>Test aber mit 3</p>
                    <p>
                        Kurse anlegen/bearbeiten<br>
                        Notenschlüssel festlegen<br>
                        Schüler Kursen zuweisen                    
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>