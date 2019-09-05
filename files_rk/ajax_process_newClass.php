<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 22.07.2019
 * Time: 17:13
 */

require 'class_lib.php';
try {
    $klassenName = $_POST["klassenbezeichnung_data"];
    $notenSchluessel = $_POST["notenschluesselFK_data"];
    $klasse = new Klasse($klassenName, $notenSchluessel);
    $klasse->createKlasseOnDB();

    echo json_encode(0);
}
catch(Exception $e) {
    echo json_encode($e->getMessage());
}
