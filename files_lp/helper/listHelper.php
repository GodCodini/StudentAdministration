<?php
require_once 'files_lp/includes/DoublyLinkedList.php';
require_once 'files_lp/includes/Element.php';
require_once 'files_lp/includes/Student.php';
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';

/**
 * Funktion die ein leeres Listenobjekt erstellt und in der Session speichert.
 *
 * @param $name
 * @param $key
 * @return int
 */
function createList($name, $key)
{
    try
    {
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        $sql = "INSERT INTO kurs (kursName, NotenschluesselTyp_idNotenschluesselTyp) VALUES (?, ?)";
        $exe = $PDO->prepare($sql);
        $exe->execute(array($name, $key));
        $id = $PDO->lastInsertId();
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return 0;
    }
    $liste = new DoublyLinkedList($name, $key, $id);
    $_SESSION[$name] = serialize($liste);
}

/**
 * Funktion um Listenobjekt zu erstellen und mit Werten aus der DB zu füllen. Speichert Objekt in der Session.
 *
 * @param $class
 */
function buildList($class)
{
    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);

    $keysql = "SELECT NotenschluesselTyp_idNotenschluesselTyp FROM kurs WHERE kursName = ?";
    $res = $PDO->prepare($keysql);
    $res->execute(array($class));
    $key = $res->fetch(PDO::FETCH_ASSOC);
    $idsql = "SELECT id_Kurs FROM kurs WHERE kursName = ?";
    $result = $PDO->prepare($idsql);
    $result->execute(array($class));
    $id = $result->fetch(PDO::FETCH_ASSOC);
    $liste = new DoublyLinkedList($class, $key['NotenschluesselTyp_idNotenschluesselTyp'], $id['id_Kurs']);

    $search = "SELECT s.id_Schueler, s.Vorname, s.Nachname, s.Geburtsdatum FROM kurs
               LEFT JOIN schueler s on kurs.id_Kurs = s.Kurs_id_Kurs
               WHERE kurs.kursName = ?";
    $pre = $PDO->prepare($search);
    $pre->execute(array($class));
    $test = $pre->fetchAll(PDO::FETCH_ASSOC);
    if ($test[0]["id_Schueler"] !== null) {
        foreach ($test as $row)
        {
            $student = new Student($row['id_Schueler'], $row['Vorname'], $row['Nachname'], $row['Geburtsdatum'], $class);
            $liste->add($student);
        }
        $_SESSION[$class] = serialize($liste);
    }
    else{
        $_SESSION[$class] = serialize($liste);
    }
}

/**
 * Funktion um Schüler in der DB zu speichern.
 *
 * @param $firstName
 * @param $lastName
 * @param $bday
 * @param $class
 */
function addStudent($firstName, $lastName, $bday, $class)
{
    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
    try
    {
        $sql = "SELECT kursName FROM kurs WHERE id_Kurs = ?";
        $res = $PDO->prepare($sql);
        $res->execute(array($class));
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return;
    }

    try
    {
        $sql = "INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) VALUES (?, ?, ?, ?)";
        $exe = $PDO->prepare($sql);
        $exe->execute(array($firstName, $lastName, $bday, $class));
        $id = $PDO->lastInsertId();
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return;
    }

    $name = $result[0]['kursName'];
    if (isset($_SESSION[$name]))
    {
        $liste = unserialize($_SESSION[$name]);
    }
    else
    {
        buildList($name);
        $liste = unserialize($_SESSION[$name]);
    }
    $schueler = new Student($id, $firstName, $lastName, $bday, $class);
    $liste->add($schueler);
    $_SESSION[$name] = serialize($liste);
}

/**
 * Funktion, um die Note anhand Prozentwerte zu ermitteln und in der DB zu speichern.
 *
 * @param $percent
 * @param $date
 * @param $studentID
 * @param $classID
 * @param $gradeTypID
 * @param $gradeKey
 * @param $scored
 * @param $max
 * @param null $comment
 * @return bool
 */
function addGrade($percent, $date, $studentID, $classID, $gradeTypID, $gradeKey, $scored, $max, $comment = null)
{
    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
    try
    {
        $sql = "SELECT entspricht FROM notenschluessel WHERE notenschluesselTyp_id = ? AND von <= ? AND bis >= ?";
        $exe = $PDO->prepare($sql);
        $exe->execute(array($gradeTypID, $percent, $percent));
        $grade = $exe->fetchAll(PDO::FETCH_ASSOC);
        var_dump($grade);
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return 0;
    }

    try
    {
        $sql = "INSERT INTO note (Kommentar, Note, Prozent, Datum, Schueler_id_Schueler, Fach_id_Fach, NotenTyp_idNotenTyp, notenschluesselTyp_Id, scoredPoints, maxPoints)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $exe = $PDO->prepare($sql);
        $return = $exe->execute(array($comment, $grade[0]['entspricht'], $percent, $date, $studentID, $classID, $gradeTypID, $gradeKey, $scored, $max));
        if ($return)
        {
            return 1;
        }
        else
        {
            return $exe->errorCode();
        }
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return 0;
    }
}

/**
 * Funktion um Notenschlüssel in der DB zu speichern. Kann 6 Noten System und 15 Punkte System speichern.
 *
 * @param $gradeKey
 * @param $von1
 * @param $von2
 * @param $von3
 * @param $von4
 * @param $von5
 * @param $von6
 * @param $bis1
 * @param $bis2
 * @param $bis3
 * @param $bis4
 * @param $bis5
 * @param $bis6
 * @param null $von7
 * @param null $von8
 * @param null $von9
 * @param null $von10
 * @param null $von11
 * @param null $von12
 * @param null $von13
 * @param null $von14
 * @param null $von15
 * @param null $bis7
 * @param null $bis8
 * @param null $bis9
 * @param null $bis10
 * @param null $bis11
 * @param null $bis12
 * @param null $bis13
 * @param null $bis14
 * @param null $bis15
 * @return int
 */
function addgradeKey($gradeKey,
                     $von1,
                     $von2,
                     $von3,
                     $von4,
                     $von5,
                     $von6,
                     $bis1,
                     $bis2,
                     $bis3,
                     $bis4,
                     $bis5,
                     $bis6,
                     $von7 = null,
                     $von8 = null,
                     $von9 = null,
                     $von10 = null,
                     $von11 = null,
                     $von12 = null,
                     $von13 = null,
                     $von14 = null,
                     $von15 = null,
                     $bis7 = null,
                     $bis8 = null,
                     $bis9 = null,
                     $bis10 = null,
                     $bis11 = null,
                     $bis12 = null,
                     $bis13 = null,
                     $bis14 = null,
                     $bis15 = null
                     )
{
    $count = func_num_args() - 1;
    $new_count = $count / 2;
    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
    try
    {
        $sql = "INSERT INTO notenschluesseltyp (SchlusselName, isGlobal) VALUES (?, ?)";
        $exe = $PDO->prepare($sql);
        $exe->execute(array($gradeKey, 0));
        $id = $PDO->lastInsertId();
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return 0;
    }

    try
    {
        $sql = "INSERT INTO notenschluessel (notenschluesselTyp_id, von, bis, entspricht) VALUES (?, ?, ?, ?)";
        $result = $PDO->prepare($sql);
        for ($i = 1; $i <= $new_count; $i++)
        {
            switch ($i)
            {
                case 1:
                    $result->execute(array($id, $von1, $bis1, $i));
                    break;
                case 2:
                    $result->execute(array($id, $von2, $bis2, $i));
                    break;
                case 3:
                    $result->execute(array($id, $von3, $bis3, $i));
                    break;
                case 4:
                    $result->execute(array($id, $von4, $bis4, $i));
                    break;
                case 5:
                    $result->execute(array($id, $von5, $bis5, $i));
                    break;
                case 6:
                    $result->execute(array($id, $von6, $bis6, $i));
                    break;
                case 7:
                    $result->execute(array($id, $von7, $bis7, $i));
                    break;
                case 8:
                    $result->execute(array($id, $von8, $bis8, $i));
                    break;
                case 9:
                    $result->execute(array($id, $von9, $bis9, $i));
                    break;
                case 10:
                    $result->execute(array($id, $von10, $bis10, $i));
                    break;
                case 11:
                    $result->execute(array($id, $von11, $bis11, $i));
                    break;
                case 12:
                    $result->execute(array($id, $von12, $bis12, $i));
                    break;
                case 13:
                    $result->execute(array($id, $von13, $bis13, $i));
                    break;
                case 14:
                    $result->execute(array($id, $von14, $bis14, $i));
                    break;
                case 15:
                    $result->execute(array($id, $von15, $bis15, $i));
                    break;
                default:
                    return 0;
                    break;
            }
        }
    }
    catch (Exception $e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        return 0;
    }
    return 1;
}

/**
 * Funktion um eine Liste zu sortieren und wieder in der Session zu speichern.
 *
 * @param $name
 */
function sortList($name)
{
    /**
     * @var $liste DoublyLinkedList
     */
    $liste = unserialize($_SESSION[$name]);
    $newList = $liste->ListSorter($liste);
    $_SESSION[$name] = serialize($newList);
    test($newList, $name);
}

/**
 * @param $liste DoublyLinkedList
 * @param $kurs
 */
function test($liste, $kurs)
{

    $array = $liste->readList();
    echo "<tbody id='myTbody'>";
    foreach ($array as $row)
    {

        echo "<tr onclick='makeTrClickableAgain(this)'>";
        echo "<td id='id' style='display: none'>".$row[3]."</td>";
        echo "<td id='last' class='dontTouchThis'>";
        echo "<a href='grades.php?id=".$row[3]."&class=".$kurs."'>".$row[1]."</a>";
        echo "</td>";
        echo "<td id='first'>";
        echo $row[0];
        echo "</td>";
        echo "<td id='birth'>";
        echo DB::convertDate($row[2]);
        echo "</td>";
        echo "<td class='dontTouchThis'>";
        echo "<a href='newGrade.php?id=".$row[3]."&class=".$kurs."'>Noten für ".$row[0]." ".$row[1]." eintragen</a>";
        echo "</td>";
        echo "</tr>";

    }
    echo "</tbody>";
    echo "<pre>";
    /*    highlight_string("<?php\n\$liste =\n" . var_export($list, true) . ";\n?>");*/
    var_dump("wurde aufgerufen");
    echo "<br>";
    echo "</pre>";
}
// TODO funktionen neu anpassen
//
//function delete($data, $listName)
//{
//    $liste = unserialize($_SESSION[$listName]);
//    $liste->deleteNode($data);
//    $liste->readList();
//    $_SESSION[$listName] = serialize($liste);
//
//    try {
//        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
//        $sql = "DELETE FROM schueler WHERE Nachname = ?";
//        $exe = $PDO->prepare($sql);
//        $exe->execute(array($data));
//    }
//    catch (Exception $e) {
//        echo $e->getCode();
//        echo $e->getMessage();
//    }
//}
//
//function listHelperReverse()
//{
//    $name = $_SESSION['name'];
//    $liste = unserialize($_SESSION[$name]);
//    $liste->reverseReadList();
//    $_SESSION[$name] = serialize($liste);
//}
//
//function listReset()
//{
//    $name = $_SESSION['name'];
//    $liste = unserialize($_SESSION[$name]);
//    $liste->resetList();
//    $liste->readList();
//    $_SESSION[$name] = serialize($liste);
//}