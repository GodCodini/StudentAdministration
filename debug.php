<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 14:50
 */
include_once 'files_lp/ui/header.php';

echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key=>$val)
        echo $key.", Value: ".$val."<br/>";


