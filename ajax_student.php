<?php

require_once 'project_files/Database.php';
include_once "files_lp/includes/DoublyLinkedList.php";
include_once "files_lp/includes/Element.php";
include_once "files_lp/includes/Student.php";
include_once "files_lp/helper/listHelper.php";

$first = $_POST['first'];
$last = $_POST['last'];
$birth = $_POST['birth'];
$class = $_POST['class'];
$id = $_POST['studentID'];

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT kursName FROM kurs WHERE id_Kurs = ?";
$res = $PDO->prepare($sql);
$res->execute(array($class));
$result = $res->fetch(PDO::FETCH_ASSOC);
$className = $result['kursName'];
$liste = unserialize($_SESSION[$className]);
$student = $liste->findStudent($id);

$student->updateStudent($id, $first, $last, $birth, $class);