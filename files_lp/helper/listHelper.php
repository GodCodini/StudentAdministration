<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 09.08.2019
 * Time: 12:36
 */

require_once '../includes/DoublyLinkedList.php';
require_once '../includes/Element.php';
require_once '../includes/Student.php';
require_once '../../project_files/Database.php';
include_once '../../project_files/_config.php';

//TODO Funktionen neu anpassen
abstract class listHelper {

    public static function createList($name, $key) {
        $liste = new DoublyLinkedList($name, $key);
        $_SESSION[$name] = serialize($liste);
        try {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "INSERT INTO kurs (Name, NotenschluesselTyp_idNotenschluesselTyp) VALUES (?, ?)";
            $exe = $PDO->prepare($sql);
            $exe->execute(array($name, $key));
        }
        catch (Exception $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public static function addStudent($firstName, $lastName, $bday, $class) {

//        $test = "SELECT Name FROM kurs WHERE id_Kurs = ?";
//        $res = $PDO->prepare($test);
//        $result = $res->execute(array($class));
//        var_dump($result);
//        $liste = unserialize($_SESSION[$result['Name']]);
//        $schueler = new Student($firstName, $lastName, $bday, $class);
//        $liste->add($schueler);
//        $liste->readList();
//        $_SESSION[$result['Name']] = serialize($liste);
        try {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) VALUES (?, ?, ?, ?)";
            $exe = $PDO->prepare($sql);
            $exe->execute(array($firstName, $lastName, $bday, $class));
        }
        catch (Exception $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public static function delete($data, $listName) {
        $liste = unserialize($_SESSION[$listName]);
        $liste->deleteNode($data);
        $liste->readList();
        $_SESSION[$listName] = serialize($liste);
        try {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "DELETE FROM schueler WHERE Nachname = ?";
            $exe = $PDO->prepare($sql);
            $exe->execute(array($data));
        }
        catch (Exception $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    public static function listHelperData() {
        $name = $_SESSION['name'];
        $liste = unserialize($_SESSION[$name]);
        $liste->readList();
        $_SESSION[$name] = serialize($liste);
    }

    public static function listHelperReverse() {
        $name = $_SESSION['name'];
        $liste = unserialize($_SESSION[$name]);
        $liste->reverseReadList();
        $_SESSION[$name] = serialize($liste);
    }

    public static function listReset() {
        $name = $_SESSION['name'];
        $liste = unserialize($_SESSION[$name]);
        $liste->resetList();
        $liste->readList();
        $_SESSION[$name] = serialize($liste);
    }

    public static function setListName($listName){
        $_SESSION['name'] = $listName;

    }
}