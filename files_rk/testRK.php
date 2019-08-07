<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="ajax_request.js"></script>

<?php

require 'class_lib.php';
require 'dev_functions.php';

/*
echo "// Test create object BenotungsObjekt with parameters: <br>";

$hausaufgabe = new BenotungsObjekt("Sinn von OOP darstellen", 95.45, "2019-10-10", "Hausaufgabe", "Toll umgesetzt", 1);
Dev::takeDump($hausaufgabe);

echo "<br><br>// Test create student object with paramters and test getter and setter methods: <br>";

$schuelerMax = new Schueler("Max", "Mustermann", "24.12.2000", "Fachinformatiker", "Anwendungsentwicklung");
echo $schuelerMax->getVorname() . "<br>";
echo $schuelerMax->setVorname("Lennart");
echo $schuelerMax->getVorname() . "<br>";

// create newstudent object in database
$schuelerMax->createStudent();
*/

$nodeList = new NodeList();
$nodeList->add_Node("Anja");
$nodeList->add_Node("Björn");
$nodeList->add_Node("Castjel");
$nodeList->add_Node("Daniel");
$nodeList->add_Node("Pascal");
$count = $nodeList->count_Nodes();

echo "<div class='counter'>Total nodes: $count</div><br>";

$nodeList->displayAllNodes();

//$nodeList->displaySpecificNode(3);

?>