<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    private $name;
    //TODO Random Picker mich ignorieren lassen
    public function __construct($name)
    {
        $this->name = $name;
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
            echo "Noch keine Einträge vorhanden.";
        } else {
            $start = $this->getStart();
            $data = $start->getData();
            echo "Richtige Liste <br>";
            $this->readData($start, $data);
        }
    }

    /**
     * @param $node
     * @param $data
     * @return int
     */
    public function readData($node, $data)
    {
        if ($node !== null) {
            echo $data . "<br>";
            $node = $node->getNext();
            if ($node !== null) {
                $this->readData($node, $node->getData());
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function resetList()
    {
        $this->count = 0;
        $this->start = null;
        $this->end = null;

    }

    public function reverseReadList()
    {
        if ($this->count === 0) {
            echo "Noch keine Einträge vorhanden.";
        } else {
            $end = $this->getEnd();
            $data = $end->getData();
            echo "Verkehrte Liste <br>";
            $this->reverseReadData($end, $data);
        }
    }

    /**
     * @param $node
     * @param $data
     */
    public function reverseReadData($node, $data)
    {
        if ($node !== null)
        {
            echo $data . "<br>";
            $node = $node->getPrevious();
            if ($node !== null)
            {
                $this->reverseReadData($node, $node->getData());
            }
            else
            {
                return;
            }
        }
        else
        {
            return;
        }
    }

    public function deleteNode($key)
    {
        $current = $this->start;

        for ($i = 1; $i <= $this->count; $i++) {
            if ($current->getData() === $key)
            {
                if ($this->count === 1)
                {
                    $this->resetList();
                    break;
                }
                elseif ($this->start === $current)
                {
                    $next = $current->getNext();
                    $next->setPrevious(null);
                    $this->start = $next;
                    $this->count--;
                    break;
                }
                elseif ($this->end === $current)
                {
                    $pre = $current->getPrevious();
                    $pre->setNext(null);
                    $this->end = $pre;
                    $this->count--;
                    break;
                }
                else
                    {
                    $pre = $current->getPrevious();
                    $nex = $current->getNext();
                    $pre->setNext($nex);
                    $nex->setPrevious($pre);
                    $this->count--;
                    break;
                }

            }
            $current = $current->getNext();
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

    public function setPrevious($element)
    {
        if ($element == null) {
            $this->prev = null;
        } else {
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
        return $this->data->getName();
    }

}