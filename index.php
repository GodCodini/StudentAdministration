<?php
include 'db.php';
include 'project_files/class_lib.php';

if (isset($_POST['submit'])) {
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geburtstdatum = $_POST['bday'];
    $klasse = $_POST['kurs'];

    $succsess = Schueler::create($vorname, $nachname, $geburtstdatum, $klasse);
    
}
?>

<html>
    <head>
        <title>Schülerverwaltung</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="text/javascript" href="functions/functions.js">
        <link href="jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
        <script src="jquery-ui-1.12.1/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script>
            $( function() {
                $( "#tabs" ).tabs();
            } );
        </script>
    </head>
    <body>
        <div id="tabs">
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
                    <form action="index.php" method="post">
                        <label for="vorname">Vorname</label>
                        <input type="text" name="vorname">
                        <label for="nachname">Nachname</label>
                        <input type="text" name="nachname">
                        <label for="bday">Geburtstdatum</label>
                        <input type="date" name="bday">
                        <label for="kurs">Kurs auswählen</label>
                        <select name="kurs" id="kurs">
                            <option value="1">FI7S</option>
                            <option value="2">FI8A</option>
                        </select>
                        <input type="submit" name="submit" value="Senden">
                    </form>
                    <?php 
                        if ($succsess) {
                            echo 'Schüler wurde angelegt.';
                        }
                        else {
                            echo 'Schüler konnte nicht angelegt werden';
                        }
                    ?>
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
        </div>
    </body>
</html>