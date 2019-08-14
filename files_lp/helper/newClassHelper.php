<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 08:28
 */
session_start();
require_once 'listHelper.php';
if (isset($_POST['senden'])) {
    $name = $_POST['liste'];
    $gradeKey = $_POST['gradeKey'];

    listHelper::createList($name, $gradeKey);
    header("Location: ../../newClass.php?succsess=class");
}