<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 22.07.2019
 * Time: 17:13
 */

require 'class_lib.php';
try {
    $studentID = $_POST["studentID_data"];
    Student::deleteStudentOnDB($studentID);

    echo json_encode(0);
}
catch(Exception $e) {
    echo json_encode($e->getMessage());
}