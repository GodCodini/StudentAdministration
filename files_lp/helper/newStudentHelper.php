<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 08:28
 */
session_start();
require_once 'listHelper.php';
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $bday = $_POST['bday'];
    $class = $_POST['class'];
    //$listName = $_SESSION['name'];
    listHelper::addStudent($firstName, $lastName, $bday, $class);
    header("Location: ../../newStudent.php?succsess=student");
}
