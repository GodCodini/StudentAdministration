<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 08:27
 */
include_once 'files_lp/ui/header.php';
?>

<form id="list" method="post" action="./newStudentHelper.php">
    <label for="firstName">Vorname</label>
    <input class="test" type="text" name="firstName" autocomplete="off" autofocus id="firstName">
    <label for="lastName">Nachname</label>
    <input class="test" type="text" name="lastName" autocomplete="off" id="lastName">
    <label for="bday">Geburtstdatum</label>
    <input class="test" type="date" name="bday" autocomplete="off" id="bday">
    <select name="class" id="class">
        <?php
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        $sql = "SELECT id_kurs, Name FROM kurs";
        foreach ($PDO->query($sql) as $row)
        {
            echo "<option value='".$row['id_kurs']."'>".$row['Name']."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Senden">
</form>
