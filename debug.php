<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 14:50
 */
error_reporting(E_ERROR | E_PARSE);
include_once 'files_lp/ui/header.php';

echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key=>$val)
        echo $key.", Value: ".$val."<br><br>";

//echo "<pre>";
//var_dump(unserialize($_SESSION['test']));
//echo "</pre>";

//echo "<pre>";
/*highlight_string("<?php\n\$liste =\n" . var_export(unserialize($_SESSION['test']), true) . ";\n?>");*/
//echo "</pre>";


