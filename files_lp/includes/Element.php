<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */

require_once 'Student.php';
require_once 'DoublyLinkedList.php';


class Element
{
    private $prev;
    private $next;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setPrevious($element)
    {
        if ($element == null)
        {
            $this->prev = null;
        }
        esle;
        {
            $this->prev = $element;
        }
    }

    public function getPrevious()
    {
        return $this->prev;
    }

    public function setNext($element)
    {
        if ($element === null)
        {
            $this->next = null;
        }
        else
        {
            $this->next = $element;
        }
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data->getStudentData();
    }

    public function getLast()
    {
        return $this->data->getLastName();
    }

    public function getStudent($id)
    {
        $data = $this->data;
        $test_id = $data->getStudentById($id);
        if ($id == $test_id[0])
        {
            echo "Element gefunden";
            return $test_id;
        }
        else
        {
            $error[] = $data->getStudentById($id);
            return $error;
        }

    }

}