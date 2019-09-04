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
    //TODO Random Picker mich ignorieren lassen :--))
    public function __construct($name, $key)
    {
        $this->name = $name;
        $this->start = null;
        $this->end = null;
        $this->count = 0;
        $this->gradeKey = $key;
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
                array_push($array, $data);
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
        for ($i = 0; $i < $liste->count-1; $i++)
        {
            $start = $liste->getStart();
            $next = $start->getNext();
            for ($j = 0; $j < $liste->count - $i - 1; $j++)
            {
                $firstLastName = $start->getLast();
                $secondLastName = $next->getLast();
                if ($liste->start == $start)
                {
                    if (strcasecmp($firstLastName, $secondLastName))
                    {
                        $nextNode = $next->getNext();
                        if ($nextNode == null)
                        {
                            return $liste;
                        }
                        else
                        {
                            $nextNode->setPrevious($start);
                        }
                        $liste->start = $next;
                        $start->setNext($nextNode);
                        $start->setPrevious($next);
                        $next->setNext($start);
                        $next->setPrevious(null);
                        $next = $start->getNext();

                    }
                    else
                    {
                        $start = $next;
                        $next = $next->getNext();
                    }
                }
                elseif ($liste->end === $next)
                {
                    $prev = $start->getPrevious();
                    $prev->setNext($next);
                    $next->setPrevious($prev);
                    $next->setNext($start);
                    $start->setPrevious($next);
                    $start->setNext(null);
                    $liste->end = $start;
                    return $liste;
                }
                else
                {
                    if (strcasecmp($firstLastName, $secondLastName))
                    {
                        $prevNode = $start->getPrevious();
                        $nextNode = $next->getNext();
                        if ($nextNode !== null)
                        {
                            $prevNode->setNext($next);
                            $next->setPrevious($prevNode);
                            $next->setNext($start);
                            $start->setPrevious($next);
                            $start->setNext($nextNode);
                            $nextNode->setPrevious($start);
                        }
                        else
                        {
                            $liste->end = $next;
                        }
                    }
                    else
                    {
                        $start = $next;
                        $next = $next->getNext();
                    }
                }

            }
        }
        return $liste;
    }


//    public function readData($node, $data)
//    {
//        $array = array();
//        if ($node !== null)
//        {
//            array_push($array, $data);
//            $node = $node->getNext();
//            echo "<pre>";
//            var_dump($array);
//            echo "</pre>";
//            if ($node !== null)
//            {
//                $this->readData($node, $node->getData());
//            }
//            else
//            {
//                return $array;
//            }
//        }
//        else
//        {
//            return $array;
//        }
//    }
//
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
//    /**
//     * @param $node
//     * @param $data
//     */
//    public function reverseReadData($node, $data)
//    {
//        if ($node !== null)
//        {
//            echo $data . "<br>";
//            $node = $node->getPrevious();
//            if ($node !== null)
//            {
//                $this->reverseReadData($node, $node->getData());
//            }
//            else
//            {
//                return;
//            }
//        }
//        else
//        {
//            return;
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

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
}