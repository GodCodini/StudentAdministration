<?php

require '_config.php';

class Student {

	public $vorname, $nachname, $geburtsdatum, $email, $klasse;

	function __construct($vorname, $nachname, $geburtsdatum, $email, $klasse){
		$this->vorname = $vorname;
		$this->nachname = $nachname;
		$this->geburtsdatum = $geburtsdatum;
		$this->email = $email;
		$this->klasse = $klasse;
	}
	/**
	 * @param String $vorname
	 * @param String $nachname
	 * @param Date $geburtsdatum
	 * @param Number $klasse
	 * @return Boolean
	 */

	public function createStudentOnDB(){
        Database::connect()->query("INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, eMail, Kurs_id_Kurs) VALUES ('".$this->vorname."', '".$this->nachname."', '".$this->geburtsdatum."', '".$this->email."','".$this->klasse."')");
	}

	function setVorname($neuerVorname){
		$this->vorname = $neuerVorname;
	}

	function getVorname(){
		return $this->vorname;
	}

	function setNachname($neuerNachname){
	    $this->nachname = $neuerNachname;
    }

    function getNachname(){
	    return $this->nachname;
    }

    function setGeburtsdatum($neuesGeburtsdatum){
	    $this->geburtsdatum = $neuesGeburtsdatum;
    }

    function getGeburtsdatum(){
	    return $this->geburtsdatum;
    }

    function setKlasse($neueKlasse){
	    $this->klasse = $neueKlasse;
    }

    function getKlasse(){
	    return $this->klasse;
    }

    function setFach($neuesFach){
	    $this->fach = $neuesFach;
    }

    function getFach(){
	    return $this->fach;
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

class Schule {
    private $bezeichnungSchule;

    /**
     * @param String $bezeichnungSchule (Schulenbezeichnung)
     */
    function __construct($bezeichnungSchule){
        $this->bezeichnungSchule = $bezeichnungSchule;
    }

    function setBezeichnungSchule($neueBezeichnungSchule){
        $this->bezeichnungSchule = $neueBezeichnungSchule;
    }

    function getBezeichnungSchule(){
        return $this->bezeichnungSchule;
    }

    function getAlleSchule() {
        $sql = "SELECT 'Name'";
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

    function setNotenschluesselKlasse($neueNotenschluesselKlasse){
        $this->notenschluessel = $neueNotenschluesselKlasse;
    }

    function createKlasseOnDB(){
        Database::connect()->query("INSERT INTO schuelerverwaltung.kurs (kursName, NotenschluesselTyp_idNotenschluesselTyp) VALUES ('$this->bezeichnungKlasse', '.$this->notenschluessel.')");
    }

    function getNotenschluesselKlasse(){
        return $this->notenschluessel;
    }
}

class Leherer {
    //TODO
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
		$stmt = $this->connect()->query("SELECT * FROM schueler");

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

    function getAlleKlassen() {

        // Revive KnötchenListe
        if(!isset($klassenListe)){
            $klassenListe = new Nodelist();
        }
        //

        $stmt = Database::connect()->query("SELECT kursName, SchlusselName FROM kurs JOIN notenschluesseltyp ON notenschluesseltyp.idNotenschluesselTyp = kurs.NotenschluesselTyp_idNotenschluesselTyp;");

        echo "<table id='klassenTable' class='klassenTabelle'>";
        echo  "<thead>";
        echo  "<tr class='tableHead'>";
        echo  "<th>Klasse</th>";
        echo  "<th>Notenschlüssel</th>";
        echo  "</tr>";
        echo  "</thead>";
        echo  "<tbody>";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Revive Knötchen
            $kurs = $row["kursName"];
            $notenschluessel = $row["SchlusselName"];

            $klasse = new Klasse($kurs, $notenschluessel);
            $klassenListe->add_Node($klasse);
            //

            echo  "<tr>";
            foreach ($row as $value) {
                echo  "<td>".$value."</td>";
            }
            echo  "</tr>";
        }
        echo  "</tbody>";
        echo  "</table>";

        echo  "<div><br>Number of Nodes in List: ".$klassenListe->counter."<br><br>";
        $klassenListe->displayAllNodesKlasse();
        echo "</div>";
    }

    function getDatabaseData($columnsArr=[], $table) {

        $sql = "SELECT";

        for($i=0; $i < sizeof($columnsArr);$i++){

            if($i +1 == sizeof($columnsArr))
            {
                $sql .= ' '.$columnsArr[$i];
            }else{
                $sql .= ' '.$columnsArr[$i].',';
            }
        }

        $sql .= ' FROM '.$table;

        $stmt = Database::connect()->query($sql);

        $resultArr=[];
        $counter = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            foreach ($columnsArr as $entry){
                $resultArr[$counter][$entry] = $row[$entry];
            }
            $counter++;
        }
        return $resultArr;
    }

    function getAllStudents() {
        $stmt = Database::connect()->query("SELECT Vorname, Nachname, Geburtsdatum, eMail, kursName FROM schueler JOIN kurs ON kurs.id_Kurs = schueler.Kurs_id_Kurs;");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr onclick="window.location=\'student.php\';">';
            echo '<td>'.$row["Vorname"].'</td>';
            echo '<td>'.$row["Nachname"].'</td>';
            echo '<td>'.$row["Geburtsdatum"].'</td>';
            echo '<td>'.$row["eMail"].'</td>';
            echo '<td>'.$row["kursName"].'</td>';
            echo '</tr>';
        }
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

	function getNodeData(){
		return $this->nodeData;
	}

	function getPrevNode(){
	    return $this->prevNode;
    }

    function getNextNode(){
	    return $this->nextNode;
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

	function __destruct(){
       // echo "Selected node deleted";
    }

    function add_Node($nodeData){
		$node = new Node($nodeData);

		if ($this->counter == 0){

			$node->nodeIndex = $this->counter;
			$node->prevNode = NULL;
			$node->nextNode = NULL;
			$this->counter++;
			$this->firstNode = $node;
			$this->lastNode = $node;
		}
		else {

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

	function displayAllNodesKlasse(){

	    if (isset($this->firstNode)){

		    $currentNode = $this->firstNode;

            while($currentNode !== NULL){

                if ($currentNode->prevNode !== NULL){
                    $pre = $currentNode->prevNode->nodeData->getBezeichnungKlasse();
                } else {
                    $pre = NULL;
                }

                if($currentNode->nextNode !== NULL){
                    $nex = $currentNode->nextNode->nodeData->getBezeichnungKlasse();
                } else {
                    $nex = NULL;
                }

                $dat = $currentNode->nodeData->getBezeichnungKlasse();

                echo "<div class='nodeElement'>";
                    echo "<div class='prevNode'>".$pre." <-- Prev</div>";
                    echo "<div class='nodeIndex'>Node: ".$dat."</div>";
                    echo "<div class='nextNode'>Next --> ".$nex."</div>";
                echo "</div>";

                $currentNode = $currentNode->nextNode;
            }
        }
    }

	function displaySpecificNode($nodeID){
		$currentNode = $this->firstNode;

		if ($nodeID < $this->counter){
			while ($currentNode->nodeIndex !== $nodeID){
				$currentNode = $currentNode->nextNode;
				}
		}

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


		if ($nodeID < $this->counter){
			echo "<div class='nodeElement'>";
                echo "<div class='prevNode'><-- Prev node: ".$pre."</div>";
                echo "<div class='nodeIndex'>Data: ".$dat."</div>";
                echo "<div class='nextNode'>Next node: ".$nex." --></div>";
			echo "</div>";

		} else {
			echo "entered note id does not exists";
		}
	}

	function deleteAllNodes(){
	    unset($this->firstNode);
	    unset($this->lastNode);
	    $this->counter = 0;
    }

    function deleteSpecificNode($nodeData){

        $currentNode = $this->firstNode;

        for($i = 0; $i <= $this->counter; $i++) {
            if($currentNode !== NULL){
                if ($currentNode->nodeData == $nodeData) {
                    $this->counter--;
                    $prev = $currentNode->getPrevNode();
                    $next = $currentNode->getNextNode();

                    if($prev != NULL){
                        $prev->nextNode = $next;
                    } else {
                        $this->firstNode = $next;
                        //echo "new first node: ".$this->firstNode->nodeData."<br>";
                    }

                    if($next != NULL){
                        $next->prevNode = $prev;
                    } else {
                        $this->lastNode = $prev;
                        //echo "new last node: ".$this->lastNode->nodeData."<br>";
                    }
                    unset($currentNode);
                    break;
                } else {
                    $currentNode = $currentNode->nextNode;
                }
            } else {
                echo "node not found";
            }
        }
    }

    // TODO: Sortierung, Oberfläche, Datenbank Login, Rechteverwaltung und Einschränkungen, Notenberechnung, weitere Listenelemente
}
?>