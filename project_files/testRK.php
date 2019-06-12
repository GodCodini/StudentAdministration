<?php

require 'class_lib.php';
require 'dev_functions.php';

echo "// Test create object BenotungsObjekt with parameters: <br>";

$hausaufgabe = new BenotungsObjekt("Sinn von OOP darstellen", 95.45, "2019-10-10", "Hausaufgabe", "Toll umgesetzt", 1);
Dev::takeDump($hausaufgabe);

echo "<br><br>// Test create student object with paramters and test getter and setter methods: <br>";

$schuelerMax = new Schueler("Max", "Mustermann", "24.12.2000", "Fachinformatiker", "Anwendungsentwicklung", 1);
echo $schuelerMax->getVorname() . "<br>";
echo $schuelerMax->setVorname("Lennart");
echo $schuelerMax->getVorname() . "<br>";

echo "<br><br>// Test DB connection, get all students and close connection: <br>";

$dbconn = new Database;
$dbconn->connect();
$dbconn->showAllStudents();
$dbconn->disconnect(); // doesn't work

?>