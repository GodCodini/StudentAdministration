<?php

require '_config.php';

class Schueler {

	public $vorname, $nachname, $geburtsdatum, $klasse, $fach, $id;

	function __construct($vorname, $nachname, $geburtsdatum, $klasse, $fach, $id = NULL){
		$this->vorname = $vorname;
		$this->nachname = $nachname;
		$this->geburtsdatum = $geburtsdatum;
		$this->klasse = $klasse;
		$this->fach = $fach;
		$this->id = $id;
	}
	/**
	 * @param String $vorname
	 * @param String $nachname
	 * @param date $geburtsdatum
	 * @param Number $klasse
	 * @return Boolean
	 */
	function create($vorname, $nachname, $geburtsdatum, $klasse) {
		$sql = "INSERT INTO schuelerverwaltung.schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) VALUES (?, ?, ?, ?)";
		$pdo_conn = DATABASE::connect();
		$stmt = $pdo_conn->prepare($sql);
		$result = $stmt->execute(array($vorname, $nachname, $geburtsdatum, $klasse));
		if ($result) {
			DATABASE::disconnect();
			return true;
		}
		else {
			DATABASE::disconnect();
			return false;
		}
	}

	public function createStudent(){
		$this->connect()->query("INSERT INTO `student` (`studentID`, `firstName`, `lastName`, `birthDate`) VALUES (NULL, '".$this->vorname."', '".$this->nachname."', '".$this->geburtsdatum);
	}

	function setVorname($neuerVorname){
		$this->vorname = $neuerVorname;
	}

	function getVorname(){
		return $this->vorname;
	}
}

// vormals Note (für mich zur Verständlichkeit, 
// da eine Note kein Objekt ist sondern z.B. die Klassenarbeit)
class BenotungsObjekt{

	private $bezeichnung, $prozentNote, $datum, $notenTyp, $kommentar, $schuelerID;

	/**
	 * @param String $bezeichnung (Name des Benotungsfalles)
	 * @param number $prozentNote (Note in Prozent)
	 * @param date $datum (Datum des Benotungsfalles)
	 * @param String $notenTyp (Art/Kategorie des Benotungsfalles)
	 * @param String $kommentar (Kommentar zur Benotung)
	 * @param number $schuelerID (ID des zugehörigen Schülers)
	*/
	function __construct($bezeichnung, $prozentNote, $datum, $notenTyp, $kommentar, $schuelerID){
		$this->bezeichnung=$bezeichnung;
		$this->prozentNote=$prozentNote;
		$this->datum=$datum;
		$this->notenTyp = $notenTyp;
		$this->kommentar=$kommentar;
		$this->schuelerID=$schuelerID;
	}

	function berechneNote($notenschluessel, $prozentNote){
		if ($notenschluessel = "IHK") {
			switch (true) {
 				case ($prozentNote <= 100 && $prozentNote >=92):
					$note = 1;
      					break;
 				case ($prozentNote <= 91 && $prozentNote >= 81):
					$note = 2;
      					break;
 				case ($prozentNote <= 80 && $prozentNote >= 67):
					$note = 3;
      					break;
 				case ($prozentNote <= 66 && $prozentNote >= 50):
					$note = 4;
      					break;
 				case ($prozentNote <= 49 && $prozentNote >= 30):
					$note = 5;
      					break;
 				// case ($prozentNote <= 29 && $prozentNote >= 0):
				// 	$note = 6;
      				// 	break;
				default:
					$note = 6;
			} 
		}

		// Sonst Abischlüssel
		else {
			switch (true) {
 				case ($prozentNote <= 100 && $prozentNote >=96):
					$note = 1;
      					break;
 				case ($prozentNote <= 95 && $prozentNote >= 80):
					$note = 2;
      					break;
 				case ($prozentNote <= 79 && $prozentNote >= 60):
					$note = 3;
      					break;
 				case ($prozentNote <= 59 && $prozentNote >= 45):
					$note = 4;
      					break;
 				case ($prozentNote <= 44 && $prozentNote >= 16):
					$note = 5;
      					break;
 				// case ($prozentNote <= 15 && $prozentNote >= 0):
				// 	$note = 6;
      				// 	break;
				default:
					$note = 6;
			} 
		}
	}

	public function setBezeichnung($neueBezeichnung){
		$this->bezeichnung=$neueBezeichnung;
	}

	public function getBezeichnung(){
		return $this->bezeichnung;
	}
}

class Klasse {
	private $bezeichnungKlasse, $notenschluessel;

	/**
	 * @param String $bezeichnungKlasse (Klassenbezeichnung)
	 * @param String $notenschluessel (Notenschlüssel)
	 */
	function __construct($bezeichnungKlasse, $notenschluessel){
		$this->bezeichnungKlasse = $bezeichnungKlasse;
		$this->notenschluessel = $notenschluessel;
	}

	function setBezeichnungKlasse($neueBezeichnungKlasse){
		$this->bezeichnungKlasse = $neueBezeichnungKlasse;
	}

	function getBezeichnungKlasse(){
		return $this->bezeichnungKlasse;
	}

	function getAlleKlassen() {
		$sql = "SELECT 'Name', 'Notenschluesseltyp_id_Notenschluesseltyp'";
	}
}

class Notenschluessel {
	private $notenschluesselID, $notenschluesselTyp;

	/**
	 * @param number $notenschluesselID
	 * @param String $notenschluesselTyp
	 */

	function __construct($notenschluesselID, $notenschluesselTyp){
		$this->notenschluesselID = $notenschluesselID;
		$this->notenschluesselTyp = $notenschluesselTyp;
	}

	function setNotenschluesselTyp($neuerNST){
		$this->notenschluesselTyp = $neuerNST;
	}

	function getNotenschluesselTyp(){
		return $this->notenschluesselTyp;
	}
}

abstract class Database {

	private $hostname;
	private $dbname;
	private $charset;
	private $username;
	private $password;

	public function connect(){

		try {
			$dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=".DBCHARSET."";
			$pdo_conn = new PDO($dsn, DBUSERNAME, DBPASSWORD);
			$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Yupiee, connection succsessful!";
			return $pdo_conn;
		} catch (PDOException $e){
			echo "Sorry, connection failed: ".$e->getMessage();
		}
	}

	public function disconnect(){
		$pdo_conn = NULL;
	}

	public function showAllStudents(){
		$stmt = $this->connect()->query("SELECT * FROM student");
		
		echo "<table>";

			echo "<th>studentID</th>";
			echo "<th>firstName</th>";
			echo "<th>lastName</th>";
			echo "<th>birthDate</th>";

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";

					foreach ($row as $value) {
					echo "<td>".$value."</td>";
					}
					
				echo "</tr>";
			}

		echo "</table>";
	}
}

class Node {
	public $nodeData;
	public $nodeIndex;
	public $nextNode;
	public $prevNode;

	function __construct($nodeData, $nodeIndex = NULL, $prevNode = NULL, $nextNode = NULL) {
		$this->nodeData = $nodeData;
		$this->nodeIndex = $nodeIndex;
		$this->prevNode = $prevNode;
		$this->nextNode = $nextNode;
	}

	function getNodeData() {
		return $this->nodeData;
	}
}

class NodeList {
	public $firstNode;
	public $lastNode;
	public $counter;
	
	function __construct($firstNode = NULL, $lastNode = NULL, $counter = 0){
		$this->counter = $counter;
		$this->firstNode = $firstNode;
		$this->lastNode = $lastNode;
	}

	function add_Node($nodeData){
		$node = new Node($nodeData);
				
		if ($this->counter == 0)
		{
			$node->nodeIndex = $this->counter;
			$node->prevNode = NULL;
			$node->nextNode = NULL;
			$this->counter++;
			$this->firstNode = $node;
			$this->lastNode = $node;
		}	
		else 
		{
			$this->lastNode->nextNode = $node;
			$node->prevNode = $this->lastNode;
			$node->nodeIndex = $this->counter;
			$this->lastNode = $node;
			
			$node->nextNode = NULL; 
			
			$this->counter++;
		}	
	}

	function count_Nodes(){
		return $this->counter;
	}

	function displayAllNodes(){
		$currentNode = $this->firstNode;
		$offset = 40;

		while($currentNode !== NULL){

			if ($currentNode->prevNode !== NULL){
				$pre = $currentNode->prevNode->nodeData;
			} else {
				$pre = NULL;
			}

			if($nex = $currentNode->nextNode !== NULL){
				$nex = $currentNode->nextNode->nodeIndex;
			} else {
				$nex = NULL;
			}

			$dat = $currentNode->nodeData;
			$cur = $currentNode->nodeIndex;
			
			$steps = $offset * $cur;

			echo "<div class='nodeElement' style='margin-top:".$steps."px'>";
        		echo "<div class='prevNode'><-- Prev node: ".$pre."</div>";
        		echo "<div class='nodeIndex'>Node index: ".$cur."<br>Data: ".$dat."</div>";
        		echo "<div class='nextNode'>Next node: ".$nex." --></div>";
			echo "</div>";
			
			$currentNode = $currentNode->nextNode;
		}
	}

	function displaySpecificNode($nodeID){
		$currentNode = $this->firstNode;

		if ($nodeID <= $this->counter){
			while ($currentNode->nodeIndex !== $nodeID){
				$currentNode = $currentNode->nextNode;
			}
		} 
/*
		while ($currentNode->nodeIndex !== $nodeID){
			$currentNode = $currentNode->nextNode;
		}
*/
		if ($currentNode->prevNode !== NULL){
			$pre = $currentNode->prevNode->nodeData;
		} else {
			$pre = NULL;
		}

		if($nex = $currentNode->nextNode !== NULL){
			$nex = $currentNode->nextNode->nodeIndex;
		} else {
			$nex = NULL;
		}

		$dat = $currentNode->nodeData;
		$cur = $currentNode->nodeIndex;

		echo "<div class='nodeElement'>";
		echo "<div class='prevNode'><-- Prev node: ".$pre."</div>";
		echo "<div class='nodeIndex'>Node index: ".$cur."<br>Data: ".$dat."</div>";
		echo "<div class='nextNode'>Next node: ".$nex." --></div>";
		echo "</div>";		
	}
}
?>