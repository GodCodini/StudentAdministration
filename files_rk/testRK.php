<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="ajax_request.js"></script>

<?php

require 'class_lib.php';
require 'dev_functions.php';

/*
echo "// Test create object BenotungsObjekt with parameters: <br>";

$hausaufgabe = new BenotungsObjekt("Sinn von OOP darstellen", 95.45, "2019-10-10", "Hausaufgabe", "Toll umgesetzt", 1);
D::takeDump($hausaufgabe);

echo "<br><br>// Test create student object with paramters and test getter and setter methods: <br>";

$schuelerMax = new Schueler("Max", "Mustermann", "24.12.2000", "Fachinformatiker", "Anwendungsentwicklung");
echo $schuelerMax->getVorname() . "<br>";
echo $schuelerMax->setVorname("Lennart");
echo $schuelerMax->getVorname() . "<br>";

// create newstudent object in database
$schuelerMax->createStudent();
*/

$nodeList = new NodeList();
$nodeList->add_Node("A");
$nodeList->add_Node("B");
$nodeList->add_Node("C");
$nodeList->add_Node("D");
$nodeList->add_Node("E");
$nodeList->add_Node("F");

$nodeList->deleteSpecificNode("A");

$nodeList->deleteAllNodes();
// unset($nodeList);

$nodeList->add_Node("a");
$nodeList->add_Node("X");

$nodeList->displayAllNodes();
//$nodeList->displaySpecificNode("Daniel");

?>