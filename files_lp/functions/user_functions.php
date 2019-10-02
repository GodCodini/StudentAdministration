<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */

include_once '../../project_files/Database.php';
include_once '../../project_files/_config.php';

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);