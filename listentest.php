<head>
    <link rel="stylesheet" href="style/styles.css">
</head>

<?php
require 'functions.php';

class DoublyLinkedList
{
    private $start = null;
    private $end = null;
    private $count = 0;

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
        $start = $this->getStart();
        $data = $start->getData();
        $this->readData($start, $data);

    }

    public function readData($node, $data) {
        if ($node->getNext() === null) {
            $data = $node->getData();
            echo $data . "<br>";
            return 0;
        }
        else {
            echo $data . "<br>";
            $node = $node->getNext();
            $data = $node->getData();
            $this->readData($node, $data);
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
        return $this->data;
    }

    public function __toString()
    {
        return $this->data;
    }
}

$elm1 = "element 1";
$elm2 = "Das ist ein Test lol 2";
$elm3 = "testetstetstetstetstetstetst 3";
$elm4 = "teste 4";
$elm5 = "reeeeeeeeeeeeeeeee 5";
$liste = new DoublyLinkedList();

$liste->add($elm1);
$liste->add($elm2);
$liste->add($elm3);
$liste->add($elm4);
$liste->add($elm5);

echo $liste->getCount();

echo "<br>";
echo "<pre>";
highlight_string("<?php\n\$liste =\n" . var_export($liste, true) . ";\n?>");
echo "</pre>";
$array = $liste->readList();
dev::printTableFromObjectArray($array);
