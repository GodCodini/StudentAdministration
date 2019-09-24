<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */
include "./project_files/Database.php";
include "./project_files/_config.php";
$percent = $_POST['percent'];
$key = $_POST['key'];

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT entspricht FROM notenschluessel WHERE notenschluesselTyp_id = ? AND von <= ? AND bis >= ?";
$exe = $PDO->prepare($sql);
$exe->execute(array($key, $percent, $percent));
$grade = $exe->fetch(PDO::FETCH_ASSOC);

echo $grade['entspricht'];