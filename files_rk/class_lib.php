<?php

require '_config.php';

class Schueler {

	public $id, $vorname, $nachname, $geburtsdatum, $email, $klasse, $schuelerKlasseFKval;

	function __construct($vorname, $nachname, $geburtsdatum, $email, $klasse, $schuelerKlasseFKval, $id = NULL){
		$this->id = $id;
		$this->vorname = $vorname;
		$this->nachname = $nachname;
		$this->geburtsdatum = $geburtsdatum;
		$this->email = $email;
		$this->klasse = $klasse;
		$this->schuelerKlasseFKval = $schuelerKlasseFKval;
	}
	/**
	 * @param String $vorname
	 * @param String $nachname
	 * @param Date $geburtsdatum
	 * @param Number $klasse
	 * @return Boolean
	 */

	public static function  createStudentOnDB($schuelerVorname, $schuelerNachname, $schuelerGeburtsdatum, $schuelerEMail, $schuelerKlasseFKval){
        $PDI = Database::connect();
        $PDI->query("INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, eMail, Kurs_id_Kurs) VALUES ('".$schuelerVorname."', '".$schuelerNachname."', '".$schuelerGeburtsdatum."', '".$schuelerEMail."','".$schuelerKlasseFKval."')");
        $id = $PDI->lastInsertId();
        return $id;
	}

    public static function  updateStudentOnDB($id, $schuelerVorname, $schuelerNachname, $schuelerGeburtsdatum, $schuelerEMail, $schuelerKlasseFKval){
        $PDI = Database::connect();
        $PDI->query("UPDATE schueler SET Vorname = '".$schuelerVorname."', Nachname = '".$schuelerNachname."', Geburtsdatum = '".$schuelerGeburtsdatum."', eMail = '".$schuelerEMail."' , Kurs_id_Kurs = '".$schuelerKlasseFKval."' WHERE schueler.id_Schueler ='".$id."'");
    }

    public static function  deleteStudentOnDB($id){
        $PDI = Database::connect();
        $PDI->query("DELETE FROM schueler WHERE schueler.id_Schueler ='".$id."'");
    }

    function getID(){
        return $this->id;
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

    function getKlasseFK(){
	    return $this->schuelerKlasseFKval;
    }

    function setFach($neuesFach){
	    $this->fach = $neuesFach;
    }

    function getEmail(){
	    return $this->email;
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

	function getAllStudentNodes() {
        // Revive KnötchenListe
        if(!isset($studentList)){
            $studentList = new Nodelist();
        }

        $stmt = Database::connect()->query("SELECT id_Schueler, Vorname, Nachname, Geburtsdatum, eMail, kursName, Kurs_id_Kurs FROM schueler  JOIN kurs ON kurs.id_Kurs = schueler.Kurs_id_Kurs;");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Revive Knötchen
            $id = $row["id_Schueler"];
            $vorname = $row["Vorname"];
            $nachname = $row["Nachname"];
            $geburtsdatum = $row["Geburtsdatum"];
            $email = $row["eMail"];
            $klasse = $row["kursName"];
            $klasseFK = $row["Kurs_id_Kurs"];

            $student = new Student($vorname, $nachname, $geburtsdatum, $email, $klasse, $klasseFK, $id);
            $studentList->add_Node($student);
        }

        $studentList->sortNodes("up","Nachname", "Vorname");
    }

    function getAllClasses() {

        // Revive KnötchenListe
        if(!isset($klassenListe)){
            $klassenListe = new Nodelist();
        }

        $stmt = Database::connect()->query("SELECT kursName, SchlusselName FROM kurs JOIN notenschluesseltyp ON notenschluesseltyp.idNotenschluesselTyp = kurs.NotenschluesselTyp_idNotenschluesselTyp;");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Revive Knötchen
            $kurs = $row["kursName"];
            $notenschluessel = $row["SchlusselName"];

            $klasse = new Klasse($kurs, $notenschluessel);
            $klassenListe->add_Node($klasse);
        }
       // echo  "Number of Nodes in List: ".$klassenListe->counter."<br><br>";
        $klassenListe->sortNodes("up","BezeichnungKlasse", "NotenschluesselKlasse");

        $klassenListe->displayAllNodesKlasseTest();
    }

    function getAllClassNodes() {

        // Revive KnötchenListe
        if(!isset($klassenListe)){
            $klassenListe = new Nodelist();
        }

        $stmt = Database::connect()->query("SELECT kursName, SchlusselName FROM kurs JOIN notenschluesseltyp ON notenschluesseltyp.idNotenschluesselTyp = kurs.NotenschluesselTyp_idNotenschluesselTyp;");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Revive Knötchen
            $kurs = $row["kursName"];
            $notenschluessel = $row["SchlusselName"];

            $klasse = new Klasse($kurs, $notenschluessel);
            $klassenListe->add_Node($klasse);
        }
        // echo  "Number of Nodes in List: ".$klassenListe->counter."<br><br>";
        $klassenListe->displayAllNodesKlasse();
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

        echo '<table class="studentTable"> <!-- tabelle automatisch durch query auslesen und entsprechend erstellen-->
            <thead>
                <tr class="tableHead">
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Geburtsdatum</th>
                    <th>E-Mail</th>
                    <th>Klasse</th>
                </tr>
            </thead>
            <tbody>
            <tr>';

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr onclick="window.location=\'student.php\';">';
            echo '<td>'.$row["Vorname"].'</td>';
            echo '<td>'.$row["Nachname"].'</td>';
            echo '<td>'.$row["Geburtsdatum"].'</td>';
            echo '<td>'.$row["eMail"].'</td>';
            echo '<td>'.$row["kursName"].'</td>';
            echo '</tr>';
        }
        echo '</tr>
            </tbody>
        </table>';
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

    function setPrevNode($newPrevNode){
        $this->prevNode = $newPrevNode;
    }

    function setNextNode($newNextNode){
        $this->nextNode = $newNextNode;
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

    function displayAllNodesSchueler(){

        if (isset($this->firstNode)){

            $currentNode = $this->firstNode;

            while($currentNode !== NULL){

                if ($currentNode->prevNode !== NULL){
                    $pre = $currentNode->prevNode->nodeData->getNachname();
                } else {
                    $pre = NULL;
                }

                if($currentNode->nextNode !== NULL){
                    $nex = $currentNode->nextNode->nodeData->getNachname();
                } else {
                    $nex = NULL;
                }

                $dat = $currentNode->nodeData->getNachname();

                echo "<div class='nodeElement'>";
                echo "<div class='prevNode'>".$pre." <-- Prev</div>";
                echo "<div class='nodeIndex'>Node: ".$dat."</div>";
                echo "<div class='nextNode'>Next --> ".$nex."</div>";
                echo "</div>";

                $currentNode = $currentNode->nextNode;
            }
        }
    }

    function displayAllNodesKlasseTest(){

        if (isset($this->firstNode)){

            $currentNode = $this->firstNode;
            echo "<table id='classTable' class='classOutputTable'>";
            echo  "<thead>";
            echo  "<tr class='tableHead'>";
            echo  "<th>Klasse</th>";
            echo  "<th>Notenschlüssel</th>";
            echo  "</tr>";
            echo  "</thead>";
            echo  "<tbody>";

            while($currentNode !== NULL){

                $dat = $currentNode->nodeData->getBezeichnungKlasse();
                $datNS = $currentNode->nodeData->getNotenschluesselKlasse();
                echo "<tr><td>".$dat."</td>";
                echo "<td>".$datNS."</td></tr>";
                $currentNode = $currentNode->nextNode;
            }
            echo "</tbody></table>";
        }
    }

    function displayAllStudentNodes(){

        if (isset($this->firstNode)){

            $currentNode = $this->firstNode;
            echo "<table id='studentTable' class='studentOutputTable'>";
            echo  "<thead>";
            echo  "<tr class='tableHead'>";
            echo  "<th class='hiddenElement'>ID</th>";
            echo  "<th>Nachname</th>";
            echo  "<th>Vorname</th>";
            echo  "<th>Geburtsdatum</th>";
            echo  "<th>E-Mail</th>";
            echo  "<th>Klasse</th>";
            echo  "</tr>";
            echo  "</thead>";
            echo  "<tbody>";

            while($currentNode !== NULL){

                $id = $currentNode->nodeData->getID();
                $vorname = $currentNode->nodeData->getVorname();
                $nachname = $currentNode->nodeData->getNachname();
                $geburtsdatum = $currentNode->nodeData->getGeburtsdatum();
                $email = $currentNode->nodeData->getEmail();
                $klasse = $currentNode->nodeData->getKlasse();
                $klasseFK = $currentNode->nodeData->getKlasseFK();
                echo "<tr class='studentRow'>";
                echo "<td class='hiddenElement studentID'>".$id."</td>";
                echo "<td class='schuelerNachname'>".$nachname."</td>";
                echo "<td class='schuelerVorname'>".$vorname."</td>";
                echo "<td class='schuelerGeburtsdatum'>".$geburtsdatum."</td>";
                echo "<td class='schuelerEmail'>".$email."</td>";
                echo "<td id='".$klasseFK."' class='schuelerKlasse'>".$klasse."</td>";
                echo "</tr>";
                $currentNode = $currentNode->nextNode;
            }
            echo "</tbody></table>";
        }
    }

    function displayAllStudentsDescending(){

        if (isset($this->firstNode)){

            $currentNode = $this->lastNode;
            echo "<table id='studentTable' class='studentOutputTable'>";
            echo  "<thead>";
            echo  "<tr class='tableHead'>";
            echo  "<th>Nachname</th>";
            echo  "<th>Vorname</th>";
            echo  "<th>Geburtsdatum</th>";
            echo  "<th>E-Mail</th>";
            echo  "<th>Klasse</th>";
            echo  "</tr>";
            echo  "</thead>";
            echo  "<tbody>";

            while($currentNode !== NULL){

                $vorname = $currentNode->nodeData->getVorname();
                $nachname = $currentNode->nodeData->getNachname();
                $geburtsdatum = $currentNode->nodeData->getGeburtsdatum();
                $email = $currentNode->nodeData->getEmail();
                $klasse = $currentNode->nodeData->getKlasse();
                echo "<tr>";
                echo "<td>".$nachname."</td>";
                echo "<td>".$vorname."</td>";
                echo "<td>".$geburtsdatum."</td>";
                echo "<td>".$email."</td>";
                echo "<td>".$klasse."</td>";
                echo "</tr>";
                $currentNode = $currentNode->prevNode;
            }
            echo "</tbody></table>";
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

    function sortNodes($sortOrder = "up", $firstValue, $secondValue = NULL)
    {
        if (isset($this->firstNode)) {

            $curr = $this->firstNode;

            for($i = 0; $i < $this->counter - 1; $i++){

                while ($curr !== NULL) {
                    $switched = false;
                    $prev = $curr->getPrevNode();

                    if ($curr->getNextNode() != NULL) {
                        $next = $curr->getNextNode();
                        $nextnext = $next->getNextNode();

                        $sortByFirst = "get".$firstValue;
                        $sortBySecond = "get".$secondValue;

                        // set srings to compare
                        $stringOne = $curr->nodeData->$sortByFirst();
                        $stringTwo = $next->nodeData->$sortByFirst();

                        $elementsToCompare = strnatcmp($stringOne, $stringTwo);

                        if ($elementsToCompare == 1) {
                     //       echo "<br><br><b> Comparing: " . $curr->nodeData->getNachname() . " with " . $stringTwo . "</b><br>";
                     //       echo "$stringOne should come after $stringTwo<br><br>";

                            $tempCurrPrev = $prev; //NULL
                            $tempCurrNext = $next; // Klaßen

                            $curr->prevNode = $next;
                            $curr->nextNode = $next->nextNode;
                            /*                            echo "1. switched " . $curr->nodeData->getNachname() . "->prev to " . $next->nodeData->getNachname() . "<br>";
                            echo "2. switched ";
                            if ($curr != NULL) {
                                echo $curr->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "->next to ";
                            if ($next->nextNode != NULL) {
                                echo $next->nextNode->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "<br>";*/

                            $next->prevNode = $tempCurrPrev;
                            $next->nextNode = $curr;
                            /*echo "3. switched ";
                            if ($next != NULL) {
                                echo $next->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "->prev to ";
                            if ($tempCurrPrev != NULL) {
                                echo $tempCurrPrev->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "<br>";
                            echo "4. switched ";
                            if ($next != NULL) {
                                echo $next->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "->next to ";
                            if ($curr != NULL) {
                                echo $curr->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "<br>";*/


                            if ($tempCurrPrev != NULL && $tempCurrPrev->nextNode != NULL) {
                                $tempCurrPrev->nextNode = $next;
                            }
                            /*echo "5. swiched new prev ";
                            if ($tempCurrPrev != NULL && $tempCurrPrev->nextNode != NULL) {
                                echo $tempCurrPrev->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "->next to ";
                            if ($next != NULL) {
                                echo $next->nodeData->getNachname();
                            } else {
                                echo "NULL";
                            };
                            echo "<br>";*/

                            if ($nextnext) {
                                $nextnext->prevNode = $curr;
                                //echo "6. switched " . $nextnext->nodeData->getNachname() . "->prev to " . $curr->nodeData->getNachname() . "<br>";
                            }

                            if ($prev == NULL) {
                                $this->firstNode = $next;
                                //echo "<i>X. changed first node to " . $next->nodeData->getNachname() . "</i><br>";
                            }

                            if ($curr->nextNode == NULL) {
                                $this->lastNode = $curr;
                                //echo "<i>X. changed last node to " . $curr->nodeData->getNachname() . "</i><br>";
                            }
                            $switched = true;
                        }

                        elseif ($elementsToCompare == 0) {
                            $stringOneDetail = $curr->nodeData->$sortBySecond();
                            $stringTwoDetail = $next->nodeData->$sortBySecond();

                            $detailElementsToCompare = strnatcmp($stringOneDetail, $stringTwoDetail);

                            if ($detailElementsToCompare == 1) {
                                //       echo "<br><br><b> Comparing: " . $curr->nodeData->getNachname() . " with " . $stringTwo . "</b><br>";
                                //       echo "$stringOne should come after $stringTwo<br><br>";

                                $tempCurrPrev = $prev; //NULL
                                $tempCurrNext = $next; // Klaßen

                                $curr->prevNode = $next;
                                $curr->nextNode = $next->nextNode;
                                /*                            echo "1. switched " . $curr->nodeData->getNachname() . "->prev to " . $next->nodeData->getNachname() . "<br>";
                                echo "2. switched ";
                                if ($curr != NULL) {
                                    echo $curr->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "->next to ";
                                if ($next->nextNode != NULL) {
                                    echo $next->nextNode->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "<br>";*/

                                $next->prevNode = $tempCurrPrev;
                                $next->nextNode = $curr;
                                /*echo "3. switched ";
                                if ($next != NULL) {
                                    echo $next->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "->prev to ";
                                if ($tempCurrPrev != NULL) {
                                    echo $tempCurrPrev->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "<br>";
                                echo "4. switched ";
                                if ($next != NULL) {
                                    echo $next->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "->next to ";
                                if ($curr != NULL) {
                                    echo $curr->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "<br>";*/


                                if ($tempCurrPrev != NULL && $tempCurrPrev->nextNode != NULL) {
                                    $tempCurrPrev->nextNode = $next;
                                }
                                /*echo "5. swiched new prev ";
                                if ($tempCurrPrev != NULL && $tempCurrPrev->nextNode != NULL) {
                                    echo $tempCurrPrev->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "->next to ";
                                if ($next != NULL) {
                                    echo $next->nodeData->getNachname();
                                } else {
                                    echo "NULL";
                                };
                                echo "<br>";*/

                                if ($nextnext) {
                                    $nextnext->prevNode = $curr;
                                    //echo "6. switched " . $nextnext->nodeData->getNachname() . "->prev to " . $curr->nodeData->getNachname() . "<br>";
                                }

                                if ($prev == NULL) {
                                    $this->firstNode = $next;
                                    //echo "<i>X. changed first node to " . $next->nodeData->getNachname() . "</i><br>";
                                }

                                if ($curr->nextNode == NULL) {
                                    $this->lastNode = $curr;
                                    //echo "<i>X. changed last node to " . $curr->nodeData->getNachname() . "</i><br>";
                                }
                                $switched = true;
                            }
                           // echo "<br>$stringOne is the same as $stringTwo and needs further ordering";
                        }
                        if (!$switched) {
                            $curr = $curr->nextNode;
                        }
                    } else {
                        $curr = NULL;
                    }
                }
                $curr = $this->firstNode;
            }
        }

        if($sortOrder == "down"){
            NodeList::displayAllStudentsDescending();
        } else{
            NodeList::displayAllStudentNodes();
        }
    }

    // TODO: Datenbank Login, Rechteverwaltung und Einschränkungen, Notenberechnung, weitere Listenelemente
}
?>