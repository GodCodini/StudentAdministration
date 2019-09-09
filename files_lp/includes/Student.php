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
    private $id;

    /**
     * Student constructor.
     * @param $id int id in der db
     * @param $firstName String Vorname Schüler
     * @param $lastName String Nachname Schüler
     * @param $bday Date Geburtstag
     * @param $class int id der Klasse
     */
    public function __construct($id, $firstName, $lastName, $bday, $class)
    {
        $this->id = $id;
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
            $sql = "INSERT INTO schueler (Vorname, Nachname, Geburtsdatum, Kurs_id_Kurs) values (?, ?, ?, ?)";
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
        $id = $this->getId();
        $first = $this->getFirstName();
        $last = $this->getLastName();
        $bd = $this->getBday();
        array_push($data, $first, $last, $bd, $id);

        return $data;
    }

    public function updateStudent($id, $first, $last, $bday, $classKey)
    {
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        try
        {
            $sql = "UPDATE schueler SET Vorname = ?, Nachname = ?, Geburtsdatum = ?, Kurs_id_Kurs = ? WHERE id_Schueler = ?";
            $res = $PDO->prepare($sql);
            $res->execute(array($first, $last, $bday, $classKey, $id));
        }
        catch (Exception $e)
        {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

}