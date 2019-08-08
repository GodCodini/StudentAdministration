<?php

class D {

    function takeDump($dumpObject){
        echo "<pre>";
        var_dump($dumpObject);
        echo "</pre>";
    }

    function takeDump_r($dumpObject){
        echo "<pre>";
        print_r($dumpObject);
        echo "</pre>";
    }

}

?>