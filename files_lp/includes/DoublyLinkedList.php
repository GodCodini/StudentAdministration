<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 13.08.2019
 * Time: 16:12
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
    //TODO Random Picker mich ignorieren lassen :--))
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
    public function add($data)
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
        $array = array();
        if ($this->count === 0)
        {
            echo "Noch keine Einträge vorhanden.<br>";
        }
        else
        {
            $start = $this->getStart();
            $data = $start->getData();
            echo $this->name;
            echo "<br>";
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

    public function sortList($liste)
    {
        do
        {
            $start = $liste->getStart();
            $next = $start->getNext();
            $swapped = false;
            for ($i = 0; $i < $liste->count - 1; $i++)
            {
                $firstLastName = $start->getLast();
                $secondLastName = $next->getLast();
                if ($firstLastName > $secondLastName)
                {
                    if ($liste->count >= 5)
                    {
                        if ($i === 0)
                        {
                            $nextNext = $next->getNext();
                            $start->setPrevious($next);
                            $start->setNext($nextNext);
                            $next->setPrevious(null);
                            $next->setNext($start);
                            $nextNext->setPrevious($start);
                            $liste->start = $next;
                            $next = $start->getNext();
                            $swapped = true;
                        }
                        elseif ($liste->end === $next->getNext())
                        {
                            $prev = $start->getPrevious();
                            $nextNode = $next->getNext();
                            $prev->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext($nextNode);
                            $next->setPrevious($prev);
                            $next->setNext($start);
                            $nextNode->setPrevious($start);
                            $next = $start->getNext();
                            $swapped = true;
                        }
                        elseif($liste->end === $next)
                        {
                            $prevNode = $start->getPrevious();
                            $prevNode->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext(null);
                            $next->setPrevious($prevNode);
                            $next->setNext($start);
                            $liste->end = $start;
                            $swapped = true;
                        }
                        else
                        {
                            $pre = $start->getPrevious();
                            $nex = $next->getNext();
                            $pre->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext($nex);
                            $next->setPrevious($pre);
                            $next->setNext($start);
                            $nex->setPrevious($start);
                            $next = $start->getNext();
                            $swapped = true;
                        }
                    }
                    elseif ($liste->count == 1)
                    {
                        return $liste;
                    }
                    elseif ($liste->count == 2)
                    {
                        $start->setNext(null);
                        $start->setPrevious($next);
                        $liste->end = $start;
                        $next->setPrevious(null);
                        $next->setNext($start);
                        $liste->start = $next;
                        $swapped = true;
                    }
                    elseif ($liste->count == 3)
                    {
                        $prevN = $start->getPrevious();
                        $nextN = $next->getNext();
                        if (isset($prevN))
                        {
                            $prevN->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext(null);
                            $liste->end = $start;
                            $next->setPrevious($prevN);
                            $next->setNext($start);
                            $swapped = true;
                        }
                        elseif (isset($nextN))
                        {
                            $start->setNext($nextN);
                            $start->setPrevious($next);
                            $next->setNext($start);
                            $next->setPrevious(null);
                            $liste->start = $next;
                            $nextN->setPrevious($start);
                            $next = $start->getNext();
                            $swapped = true;
                        }
                    }
                    elseif ($liste->count == 4)
                    {
                        $prevNo = $start->getPrevious();
                        $nextNo = $next->getNext();
                        if (isset($prevNo) && isset($nextNo))
                        {
                            $prevNo->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext($nextNo);
                            $next->setPrevious($prevNo);
                            $next->setNext($start);
                            $nextNo->setPrevious($start);
                            $next = $start->getNext();
                            $swapped = true;
                        }
                        elseif (isset($prevNo) and !isset($nextNo))
                        {
                            $prevNo->setNext($next);
                            $start->setPrevious($next);
                            $start->setNext(null);
                            $liste->end = $start;
                            $next->setPrevious($prevNo);
                            $next->setNext($start);
                            $swapped = true;
                        }
                        elseif (isset($nextNo) and !isset($prevNo))
                        {
                            $start->setPrevious($next);
                            $start->setNext($nextNo);
                            $next->setPrevious(null);
                            $next->setNext($start);
                            $liste->start = $next;
                            $nextNo->setPrevious($start);
                            $next = $start->getNext();
                            $swapped = true;
                        }
                    }

                }
                else
                {
                    $start = $next;
                    $next = $start->getNext();
                }
            } //Ende for-Schleife
        }
        while ($swapped);
        $liste->setSorted(true);
        return $liste;
    }

//    public function resetList()
//    {
//        $this->count = 0;
//        $this->start = null;
//        $this->end = null;
//
//    }
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
            if ($start->getStudent($id) == $id)
            {
                echo "gefunden: ".$i;
                return $start->getStudent($id);
            }
            else
            {
                $error = $start->getStudent($id);
                $error[] = "Liste nicht gefunden ".$i;
                $start = $start->getNext();
            }
        }
        return $error;
    }
}