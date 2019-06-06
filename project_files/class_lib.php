<?php

class Schueler {
	public $vorname;
	public $nachname;
	public $geburtsdatum;
	public $kurs;
	public $fach;
	public $note;

// 	ADD getter & setter
}

// vormals Note (für mich zur Verständlichkeit)
class BenotungsObjekt{

	public $bezeichnung;
	public $prozentNote;
	public $datum;
	public $notenTyp;
	public $kommentar;
	public $schuelerID;
	public $note;

/*

*/

	function __constructor($bezeichnung, $prozentNote, $datum, $notenTyp, $kommentar, $schuelerID){
		$this->$bezeichnung=bezeichnung;
		$this->$prozentNote=prozentNote;
		$this->$datum=datum;
		$this->$kommentar=kommentar;
		$this->$schuelerID=schuelerID;
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

	public function getBezeichnung(){
		return $this->bezeichnung;
	}

	public function setBezeichnung($bezeichnung){
		$this->bezeichnung=$bezeichnung;
	}

	// 	ADD getter & setter 

}

class Kurs {
	public $kursBezeichnung;
	public $notenschluessel;

	function erstelleKurs($kursBezeichnung, $notenschluessel){
		// pack Werte per Query in neuen Kurs in die Datenbank
		// INSERT INTO Schuelerverwaltung.Kurs (Name, Notenschluessel) VALUES ($kursBezeichnung, $notenschluessel)
	}

// 	add getter & setter

}



?>
