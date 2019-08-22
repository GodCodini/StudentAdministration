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

        $search = "SELECT s.Vorname, s.Nachname, s.Geburtsdatum FROM kurs
                   LEFT JOIN schueler s on kurs.id_Kurs = s.Kurs_id_Kurs
                   WHERE kurs.kursName = ?";
        $pre = $PDO->prepare($search);
        $pre->execute(array($class));
        $test = $pre->fetchAll(PDO::FETCH_ASSOC);
        foreach ($test as $row)
        {
            $student = new Student($row['Vorname'], $row['Nachname'], $row['Geburtsdatum'], $class);
            $liste->add($student);
        }
        $_SESSION[$class] = serialize($liste);
    }

    public static function addStudent($firstName, $lastName, $bday, $class)
    {
        try
        {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
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
        $schueler = new Student($firstName, $lastName, $bday, $class);
        $liste->add($schueler);
        $_SESSION[$name] = serialize($liste);
        try
        {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) VALUES (?, ?, ?, ?)";
            $exe = $PDO->prepare($sql);
            $exe->execute(array($firstName, $lastName, $bday, $class));
        }
        catch (Exception $e)
        {
            echo $e->getCode();
            echo $e->getMessage();
        }
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