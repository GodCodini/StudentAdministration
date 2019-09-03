<?php
require_once 'files_lp/includes/DoublyLinkedList.php';
require_once 'files_lp/includes/Element.php';
require_once 'files_lp/includes/Student.php';
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';

abstract class listHelper
{
    public static function createList($name, $key)
    {
        $liste = new DoublyLinkedList($name, $key);
        $_SESSION[$name] = serialize($liste);
        try
        {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "INSERT INTO kurs (kursName, NotenschluesselTyp_idNotenschluesselTyp) VALUES (?, ?)";
            $exe = $PDO->prepare($sql);
            $exe->execute(array($name, $key));
            return 1;
        }
        catch (Exception $e)
        {
            echo $e->getCode();
            echo $e->getMessage();
            return 0;
        }
    }

    public static function loadList($name, $key)
    {
        $liste = new DoublyLinkedList($name, $key);
        $_SESSION[$name] = serialize($liste);
    }

    public static function buildList($class)
    {
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        if (isset($_SESSION[$class]))
        {
            $liste = unserialize($_SESSION[$class]);
        }
        else
        {
            $keysql = "SELECT NotenschluesselTyp_idNotenschluesselTyp FROM kurs WHERE kursName = ?";
            $res = $PDO->prepare($keysql);
            $res->execute(array($class));
            $key = $res->fetch(PDO::FETCH_ASSOC);
            listHelper::loadList($class, $key['NotenschluesselTyp_idNotenschluesselTyp']);
            $liste = unserialize($_SESSION[$class]);
        }

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

    public static function addStudent($firstName, $lastName, $bday, $class)
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
            listHelper::buildList($name);
            $liste = unserialize($_SESSION[$name]);
        }
        $schueler = new Student($id, $firstName, $lastName, $bday, $class);
        $liste->add($schueler);
        $_SESSION[$name] = serialize($liste);
    }

    /**
     * @param $percent
     * @param $date
     * @param $studentID
     * @param $classID
     * @param $gradeTypID
     * @param $gradeKey
     * @param null $comment
     * @return int
     */
    public static function addGrade($percent, $date, $studentID, $classID, $gradeTypID, $gradeKey, $comment = null) {
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        try
        {
            $sql = "SELECT entspricht FROM notenschluessel WHERE notenschluesselTyp_id = ? AND von <= ? AND bis > ?";
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
            $sql = "INSERT INTO note (Kommentar, Note, Prozent, Datum, Schueler_id_Schueler, Fach_id_Fach, NotenTyp_idNotenTyp, notenschluesselTyp_Id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $exe = $PDO->prepare($sql);
            $return = $exe->execute(array($comment, $grade[0]['entspricht'], $percent, $date, $studentID, $classID, $gradeTypID, $gradeKey));
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

    public static function addgradeKey($von1, $von2, $von3, $von4, $von5, $von6, $bis1, $bis2, $bis3, $bis4, $bis5, $bis6, $gradeKey)
    {
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
            for ($i = 1; $i <= 6; $i++)
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
//TODO Funktionen neu anpassen

//    public static function delete($data, $listName)
//    {
//        $liste = unserialize($_SESSION[$listName]);
//        $liste->deleteNode($data);
//        $liste->readList();
//        $_SESSION[$listName] = serialize($liste);
//
//        try {
//            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
//            $sql = "DELETE FROM schueler WHERE Nachname = ?";
//            $exe = $PDO->prepare($sql);
//            $exe->execute(array($data));
//        }
//        catch (Exception $e) {
//            echo $e->getCode();
//            echo $e->getMessage();
//        }
//    }
//
//
//    public static function listHelperData()
//    {
//        $name = $_SESSION['name'];
//        $liste = unserialize($_SESSION[$name]);
//        $liste->readList();
//        $_SESSION[$name] = serialize($liste);
//    }
//
//    public static function listHelperReverse()
//    {
//        $name = $_SESSION['name'];
//        $liste = unserialize($_SESSION[$name]);
//        $liste->reverseReadList();
//        $_SESSION[$name] = serialize($liste);
//    }
//
//    public static function listReset()
//    {
//        $name = $_SESSION['name'];
//        $liste = unserialize($_SESSION[$name]);
//        $liste->resetList();
//        $liste->readList();
//        $_SESSION[$name] = serialize($liste);
//    }
//
//    public static function setListName($listName)
//    {
//        $_SESSION['name'] = $listName;
//
//    }
}