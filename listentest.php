<?php
class DoublyLinkedList {
    private $start = null;
    private $end = null;
    private $count = 0;
    //TODO Add-Funktion überarbeiten, verkettet rekursiv, sollte linear
    public function add(Element $element) {
        //das erste element bekommt den start und endpunkt
        if($this->start === null) {
            $this->start = $element;
            $this->end = $element;
            $this->count++;
            return;
        }

        //ende auf das neue element setzen, wenn schon eins existiert.
        $this->end->setNext($element);
        $element->setPrevious($this->end);
        $this->current = $element;
        $this->end = $element;
        $this->count++;
    }

    public function getCount() {
        return $this->count;
    }
    //TODO Daten aus der Liste wiederbekommen
    public function readList() {
        $start = $this->getStart();
        $test = $start->getData();
        $count = $this->getCount();
        for ($i = 0; $i < $count; $i++) {
            echo $test;
            $test = $test->getNext();
        }
    }

    public function getStart() {
        return $this->start;
    }

    public function getEnd() {
        return $this->end;
    }
}

class Element {
    private $prev;
    private $next;
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function setPrevious(Element $element) {
        $this->prev = $element;
    }

    public function setNext(Element $element) {
        $this->next = $element;
    }

    public function getNext() {
        return $this->next;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }
}

$elm1 = new Element("element 1");
$elm2 = new Element("Das ist ein Test lol 2");
$elm3 = new Element("testetstetstetstetstetstetst 3");
$elm4 = new Element("teste");
$elm5 = new Element("reeeeeeeeeeeeeeeee");


$liste = new DoublyLinkedList();
$liste->add($elm1);
$liste->add($elm2);
$liste->add($elm3);
$liste->add($elm4);
$liste->add($elm5);
/*echo "<pre>";
var_dump($liste);
echo "</pre>";*/
echo $liste->getCount();
echo "<br>";
echo "<pre>";
var_dump($liste);
echo "</pre>";