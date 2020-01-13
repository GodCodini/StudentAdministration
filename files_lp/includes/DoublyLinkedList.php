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
require_once 'Element.php';

class DoublyLinkedList
{
    private $start;
    private $end;
    private $count;
    private $name;
    private $gradeKey;
    private $sorted;
    private $id;

    public function __construct($name, $key, $id)
    {
        $this->name = $name;
        $this->start = null;
        $this->end = null;
        $this->count = 0;
        $this->gradeKey = $key;
        $this->sorted = false;
        $this->id = $id;
    }

    /**
     * @param $data
     */
    public function add(Student $data)
    {
        $element = new Element($data);
        //das erste element bekommt den start und endpunkt
        if ($this->start === null) {
            $this->start = $element;
            $this->end = $element;
            $this->count++;
            $this->sorted = false;
            return;
        }
        //ende auf das neue element setzen, wenn schon eins existiert.
        $this->end->setNext($element);
        $element->setPrevious($this->end);
        $this->end = $element;
        $this->count++;
        $this->sorted = false;
    }

    public function readList()
    {
        /**
         * var Element $start;         * 
         */
        $array = array();
        if ($this->count === 0)
        {
            echo "Noch keine Einträge vorhanden.<br>";
            return $array;
        }
        else
        {
            $start = $this->getStart();
            $data = $start->getData();
            for ($i = 0; $i < $this->count; $i++) {
                $array[] = $data;
                $start = $start->getNext();
                if ($start !== null)
                {
                    $data = $start->getData();
                }
                else
                {
                    return $array;
                }
            }
            return $array;
        }
    }

    public function quickSort(DoublyLinkedList $liste)
    {
        $size = $liste->getSize();
        $randomIndex = random_int(0, $size-1);
        $pivot = $start = $this->start;
        for ($i = 0; $i < $randomIndex; $i++)
        {
            $pivot = $pivot->getNext();
        }
        $left = array();
        $right = array();
        for ($i = 0; $i < $size; $i++)
        {
            if (strcasecmp($start->getLast(), $pivot->getLast()) < 0)
            {
                $left[] = $start;
            }
            elseif (strcasecmp($start->getLast(), $pivot->getLast()) > 0)
            {
                $right[] = $start;
            }
            $start = $start->getNext();
        }



    }

    public function swapData($first, $second)
    {
        $student = $first->getStudentObj();
        $first->setData($second->getStudentObj());
        $second->setData($student);
    }

    /**
     * BubbleSort für eine DoublyLinkedList
     * @param DoublyLinkedList $liste
     * @return DoublyLinkedList
     */
    public function ListSorter(DoublyLinkedList $liste)
    {
        /**
         * @var $start Element
         * @var $next Element
         */
        do
        {
            $start = $liste->getStart();
            $next = $start->getNext();
            $swapped = false;
            for ($i = 0; $i < $liste->count - 1; $i++)
            {
                $firstLastName = $start->getLast();
                $secondLastName = $next->getLast();
                if (strcasecmp($firstLastName, $secondLastName) > 0)
                {

                    $this->swapData($start, $next);
                    $swapped = true;
                }

                else
                {
                    $start = $next;
                    $next = $start->getNext();
                }
            } //Ende for-Schleife
        }
        while ($swapped);
        $this->setSorted(true);
        return $liste;
    }

    public function resetList()
    {
        $this->start = null;
        $this->end = null;
        $this->count = 0;
        $this->sorted = false;
    }

    public function randomPick()
    {
        /**
         * @var $data Element
         * @var $start Element
         */
        do
        {
            $count = $this->count;
            $id = mt_rand(1, $count - 1);
            $start = $this->start;
            for($i = 0; $i < $id; $i++)
            {
                $start = $start->getNext();
            }
            $first = $start->getFirst();
            $last = $start->getLast();
            $arr = [$first, $last];
        }
        while ($last == "Pamperin");

        return $arr;
    }
//
//    public function reverseReadList()
//    {
//        if ($this->count === 0)
//        {
//            echo "Noch keine Einträge vorhanden.";
//        }
//        else
//        {
//            $end = $this->getEnd();
//            $data = $end->getData();
//            echo "Verkehrte Liste <br>";
//            $this->reverseReadData($end, $data);
//        }
//    }
//
//    public function deleteNode($key)
//    {
//        $current = $this->start;
//
//        for ($i = 0; $i <= $this->count; $i++) {
//            if ($current->getLastName() === $key)
//            {
//                if ($this->count === 1)
//                {
//                    $this->resetList();
//                    break;
//                }
//                elseif ($this->start === $current)
//                {
//                    $next = $current->getNext();
//                    $next->setPrevious(null);
//                    $this->start = $next;
//                    $this->count--;
//                    break;
//                }
//                elseif ($this->end === $current)
//                {
//                    $pre = $current->getPrevious();
//                    $pre->setNext(null);
//                    $this->end = $pre;
//                    $this->count--;
//                    break;
//                }
//                else
//                {
//                    $pre = $current->getPrevious();
//                    $nex = $current->getNext();
//                    $pre->setNext($nex);
//                    $nex->setPrevious($pre);
//                    $this->count--;
//                    break;
//                }
//
//            }
//            $current = $current->getNext();
//        }
//    }

    public function getCount()
    {
        return $this->count;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSorted($sorted)
    {
        $this->sorted = $sorted;
    }

    public function getSorted()
    {
        return $this->sorted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function findStudent($id)
    {
        $start = $this->start;
        $error = array();
        for ($i = 0; $i < $this->count; $i++)
        {
            $test_data = $start->getStudent($id);
            if ($test_data[0] == $id)
            {
                return $test_data;
                break;
            }
            else
            {
                $error[] = $start->getStudent($id);
                $error[] = "in Liste nicht gefunden ".$i;
                $start = $start->getNext();
            }
        }
        return $error;
    }
}