<?php

class Schueler
{
    private $name;

    /**
     * Schueler constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}

class DoublyLinkedList
{
    private $start;
    private $end;
    private $count;

    public function __construct()
    {
        $this->start = null;
        $this->end = null;
        $this->count = 0;
    }

    /**
     * @param $data
     */
    public function add($data)
    {
        $element = new Element($data);
        //das erste element bekommt den start und endpunkt
        if ($this->start === null) {
            $this->start = $element;
            $this->end = $element;
            $this->count++;
            return;
        }
        //ende auf das neue element setzen, wenn schon eins existiert.
        $this->end->setNext($element);
        $element->setPrevious($this->end);
        $this->end = $element;
        $this->count++;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function readList()
    {
        if ($this->count === 0) {
            echo "nix drin";
        }
        else {
            $start = $this->getStart();
            $data = $start->getData();
            echo "Richtige Liste <br>";
            $this->readData($start, $data);
        }
    }

    public function readData($node, $data)
    {
        if ($node !== null)
        {
            echo $data . "<br>";
            $node = $node->getNext();
            if ($node !== null) {
                $this->readData($node, $node->getData());
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }

    public function resetList() {
        $this->count = 0;
        $this->start = null;
        $this->end = null;

    }

    public function reverseReadList() {
        if ($this->count === 0) {
            echo "nix drin";
        }
        else {
            $end = $this->getEnd();
            $data = $end->getData();
            echo "Verkehrte Liste <br>";
            $this->reverseReadData($end, $data);
        }
    }

    public function reverseReadData($node, $data) {
        if ($node !== null) {
            echo $data . "<br>";
            $node = $node->getPrevious();
            if ($node !== null) {
                $this->reverseReadData($node, $node->getData());
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
}

/**
 * Class Element
 */
class Element
{
    private $prev;
    private $next;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function setPrevious(Element $element)
    {
        $this->prev = $element;
    }

    public function getPrevious()
    {
        return $this->prev;
    }

    public function setNext(Element $element)
    {
        $this->next = $element;
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
        return $this->data->getName();
    }

    public function __toString()
    {
        return $this->data;
    }
}
