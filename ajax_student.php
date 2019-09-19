<?php
session_start();
require_once 'project_files/Database.php';
include_once "files_lp/includes/DoublyLinkedList.php";
include_once "files_lp/includes/Element.php";
include_once "files_lp/includes/Student.php";
include_once "files_lp/helper/listHelper.php";

$first = $_POST['first'];
$last = $_POST['last'];
$birth = $_POST['birth'];
$course = $_POST['course'];
$id = $_POST['studentID'];

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT kursName FROM kurs WHERE id_Kurs = ?";
$res = $PDO->prepare($sql);
$res->execute(array($course));
$result = $res->fetch(PDO::FETCH_ASSOC);
$className = $result['kursName'];
$liste = unserialize($_SESSION[$className]);
$student = $liste->findStudent($id);

$student[1]->setFirstName($first);
$student[1]->setLastName($last);
$student[1]->setBday($birth);
$student[1]->setClass($course);
$student[1]->save();

echo json_encode($student[1]);