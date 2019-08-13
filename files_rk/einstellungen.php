<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 09.08.2019
 * Time: 12:23
 */

include 'headerMenu.php';
?>
<div class="contentContainer">
    <?php

    $databaseScript = file_get_contents('schuelerverwaltung.sql');

    Database::connect()->query("DROP SCHEMA Schuelerverwaltung; $databaseScript");

    echo "Database was cleaned";

 include 'footer.php';

?>
