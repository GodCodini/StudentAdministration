<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 09.08.2019
 * Time: 12:36
 */

abstract class listHelper extends Database {

    private static $currList;

    /**
     * @return mixed
     */
    public static function getCurrList()
    {
        return self::$currList;
    }

    public static function createList($name) {
        $liste = new DoublyLinkedList($name);
        $liste->readList();
        listHelper::$currList = $name;
        $_SESSION[''.$name.''] = serialize($liste);
    }

    public static function delete($data) {
        $name = listHelper::$currList;
        $liste = unserialize($_SESSION[''.$name.'']);
        $liste->deleteNode($data);
        $liste->readList();
        $_SESSION[''.$name.''] = serialize($liste);
    }

    public static function addStudent($name) {
        $list = listHelper::$currList;
        $liste = unserialize($_SESSION[''.$list.'']);
        $schueler = new Student($name);
        var_dump($liste);
        $liste->add($schueler);
        $liste->readList();
        $_SESSION[''.$list.''] = serialize($liste);
    }

    public static function listHelperData() {
        $name = listHelper::$currList;
        $liste = unserialize($_SESSION[''.$name.'']);
        $liste->readList();
        $_SESSION[''.$name.''] = serialize($liste);
    }

    public static function listHelperReverse() {
        $name = listHelper::$currList;
        $liste = unserialize($_SESSION[''.$name.'']);
        $liste->reverseReadList();
        $_SESSION[''.$name.''] = serialize($liste);
    }

    public static function listReset() {
        $name = listHelper::$currList;
        $liste = unserialize($_SESSION[''.$name.'']);
        $liste->resetList();
        $liste->readList();
        $_SESSION[''.$name.''] = serialize($liste);
    }

    public static function setListName($listName){
        listHelper::$currList = $listName;
    }
}