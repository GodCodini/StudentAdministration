<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 13.08.2019
 * Time: 16:11
 */
require_once 'Element.php';
require_once 'DoublyLinkedList.php';
class Student
{
    private $firstName;
    private $lastName;
    private $bday;
    private $class;

    /**
     * Student constructor.
     * @param $firstName
     * @param $lastName
     * @param $bday
     * @param $class
     */
    public function __construct($firstName, $lastName, $bday, $class)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bday = $bday;
        $this->class = $class;
    }

    public function addToDB($first, $last, $bday, $class)
    {
        try
        {
            $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
            $sql = "INSERT IGNORE INTO schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) values (?, ?, ?, ?)";
            $pre = $PDO->prepare($sql);
            $pre->execute(array($first, $last, $bday, $class));
        }
        catch (Exception $e)
        {
            echo $e->getCode();
            echo $e->getMessage();
        }

    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * @param mixed $bday
     */
    public function setBday($bday)
    {
        $this->bday = $bday;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    public function getStudentData()
    {
        $data = array();
        $first = $this->getFirstName();
        $last = $this->getLastName();
        $bd = $this->getBday();
        array_push($data, $first, $last, $bd);

        return $data;
    }

}