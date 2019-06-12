<?php

require '_config.php';

class Schueler {

	public $vorname, $nachname, $geburtsdatum, $klasse, $fach, $id;

	function __construct($vorname, $nachname, $geburtsdatum, $klasse, $fach, $id){
		$this->vorname = $vorname;
		$this->nachname = $nachname;
		$this->geburtsdatum = $geburtsdatum;
		$this->klasse = $klasse;
		$this->fach = $fach;
		$this->id = $id;
	}

	function setVorname($neuerVorname){
		$this->vorname = $neuerVorname;
	}

	function getVorname(){
		return $this->vorname;
	}
}

// vormals Note (für mich zur Verständlichkeit, 
// da eine Note kein Objekt ist sondern z.B. di Klassenarbeit)
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

class Database {

	private $hostname;
	private $dbname;
	private $charset;
	private $username;
	private $password;

	public function connect(){
		$this->hostname = DBHOST;
		$this->dbname = DBNAME;
		$this->charset = DBCHARSET;
		$this->username = DBUSERNAME;
		$this->password = DBPASSWORD;

		try {
			$dsn = "mysql:host=".$this->hostname.";dbname=".$this->dbname.";charset=".$this->charset;
			$pdo_conn = new PDO($dsn, $this->username, $this->password);
			$pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Yupiee, connection succsessful!";
			return $pdo_conn;
		} catch (PDOException $e){
			echo "Sorry, connection failed: ".$e->getMessage();
		}
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

	public function disconnect(){
		$pdo_conn = NULL;
	}
}

?>