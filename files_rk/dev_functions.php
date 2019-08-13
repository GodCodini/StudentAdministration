<?php

class D {

    function takeDump($dumpObject){
        echo "<pre class='takeDump'>";
        var_dump($dumpObject);
        echo "</pre>";
    }

    function takeDump_r($dumpObject){
        echo "<pre class='takeDump'>";
        print_r($dumpObject);
        echo "</pre>";
    }

}

?>