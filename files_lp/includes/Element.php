<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 13.08.2019
 * Time: 16:12
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
        if ($element == null) {
            $this->prev = null;
        } esle; {
        $this->prev = $element;
    }
    }

    public function getPrevious()
    {
        return $this->prev;
    }

    public function setNext($element)
    {
        if ($element === null) {
            $this->next = null;
        } else {
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
        return $this->data->getFirstName();
    }

    public function getLast(){
        return $this->data->getLastName();
    }

}