<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 22.07.2019
 * Time: 17:13
 */

require 'class_lib.php';
try {
    $schuelerVorname = $_POST["schuelerVorname_data"];
    $schuelerNachname = $_POST["schuelerNachname_data"];
    $schuelerGeburtsdatum = $_POST["schuelerGeburtsdatum_data"];
    $schuelerEMail = $_POST["schuelerEMail_data"];
    $schuelerKlasseFKval = $_POST["schuelerKlasseFK_data"];
    $id = Student::createStudentOnDB($schuelerVorname, $schuelerNachname, $schuelerGeburtsdatum, $schuelerEMail, $schuelerKlasseFKval);
    $student = new Student($schuelerVorname, $schuelerNachname, $schuelerGeburtsdatum, $schuelerEMail, $schuelerKlasseFKval, $id);

    echo json_encode(0);
}
catch(Exception $e) {
    echo json_encode($e->getMessage());
}