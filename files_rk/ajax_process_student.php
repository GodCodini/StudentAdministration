<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 22.07.2019
 * Time: 17:13
 */

require 'class_lib.php';

try {
    $create = end($_POST); // get type = Student
    array_pop($_POST); // Remove type from array

    $i = 0; // set loop counter
    $param = []; // set parameter string for object creation

    foreach ($_POST as $key => $value) {   // loop over array contents and fill parameter string
        $param[] = $value;
    }

    $object = new $create(...$param); // create new object from type variable name and transmit parameters
    //$object->createStudentOnDB();

    $object->getVorname();

    echo json_encode($param);
    //echo json_encode(0);
}
catch(Exception $e) {
    echo json_encode($e->getMessage());
}