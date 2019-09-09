<?php
/**
 * Created by PhpStorm.
 * User: klassen
 * Date: 09.08.2019
 * Time: 10:59
 */

include 'headerMenu.php';

echo '<div class="contentContainer">';

/*
echo 'Einrichtungsablauf:<br> SCHULE -> KLASSE -> LEHRER -> FACH -> NOTENTYPEN -> SCHÜLER -> NOTENOBJEKT';
echo '<pre>
1 SCHULE hat mind 1 KLASSE -> 
1 Klasse hat mind 1 LEHRER -> 
1 Leher unterrichtet mind 1 FACH -> 
1 NOTENOBJEKT hat 1 NOTENTYPEN -> 
1 SCHÜLER hat mind 1 SCHULE, KLASSE, LEHRER, FACH -> 
1 NOTENOBJEKT hat 1 SCHÜLER, NOTENTYPEN, NOTE
</pre>';
*/
echo '<div class="leftSide" style="
    width: fit-content;
    display: inline-block;
">';
Database::getAllClasses();
echo '</div>';

echo '<div class="rightSide" style="
    width: fit-content;
    display: inline-block;
    vertical-align: top;
    margin-left: 30px;
">';
Database::getAllStudents();
echo '</div>';

include 'footer.php';

?>