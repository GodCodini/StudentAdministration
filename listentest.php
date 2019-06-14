<?php
class ListNode
{
    public $data;
    public $next;
    function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }
    function readNode()
    {
        return $this->data;
    }
}
class LinkList
{
    private $firstNode;
    private $lastNode;
    private $count;
    function __construct()
    {
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->count = 0;
    }
//insertion at the start of linklist
    public function insertFirst($data)
    {
        $link = new ListNode($data);
        $link->next = $this->firstNode;
        $this->firstNode = &$link;
        /* If this is the first node inserted in the list
        then set the lastNode pointer to it.
        */
        if($this->lastNode == NULL)
            $this->lastNode = &$link;
        $this->count++;
    }
//displaying all nodes of linklist
    public function readList()
    {
        $listData = array();
        $current = $this->firstNode;
        while($current != NULL)
        {
            array_push($listData, $current->readNode());
            $current = $current->next;
        }
        foreach($listData as $v){
            echo $v." ";
        }
    }
//reversing all nodes of linklist
    public function reverseList()
    {
        if($this->firstNode != NULL)
        {
            if($this->firstNode->next != NULL)
            {
                $current = $this->firstNode;
                $new = NULL;
                while ($current != NULL)
                {
                    $temp = $current->next;
                    $current->next = $new;
                    $new = $current;
                    $current = $temp;
                }
                $this->firstNode = $new;
            }
        }
    }
//deleting a node from linklist $key is the value you want to delete
    public function deleteNode($key)
    {
        $current = $this->firstNode;
        $previous = $this->firstNode;
        while($current->data != $key)
        {
            if($current->next == NULL)
                return NULL;
            else
            {
                $previous = $current;
                $current = $current->next;
            }
        }
        if($current == $this->firstNode)
        {
            if($this->count == 1)
            {
                $this->lastNode = $this->firstNode;
            }
            $this->firstNode = $this->firstNode->next;
        }
        else
        {
            if($this->lastNode == $current)
            {
                $this->lastNode = $previous;
            }
            $previous->next = $current->next;
        }
        $this->count--;
    }
//empty linklist
    public function emptyList()
    {
        $this->firstNode == NULL;
    }
//insertion at index
    public function insert($NewItem,$key){
        if($key == 0){
            $this->insertFirst($NewItem);
        }
        else{
            $link = new ListNode($NewItem);
            $current = $this->firstNode;
            $previous = $this->firstNode;
            for($i=0;$i<$key;$i++)
            {
                $previous = $current;
                $current = $current->next;
            }
            $previous->next = $link;
            $link->next = $current;
            $this->count++;
        }
    }
}
$obj = new LinkList();
$obj->insertFirst($value);
$obj->insert($value,$key); //at any index
$obj->deleteNode($value);
$obj->readList();