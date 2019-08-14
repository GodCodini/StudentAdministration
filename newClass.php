<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 08:27
 */
include_once 'files_lp/ui/header.php';
if (isset($_GET["succsess"])) {
    if ($_GET["succsess"] == "class") {
        echo "<span class='succsess'>Klasse erfolgreich angelegt.</span><br><br>";
    }
} elseif (isset($_GET["error"])) {
    //Fehlermeldungen bei Fehlern
    if ($_GET["error"] == "error") {
        echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
    }
}
?>

<form action="files_lp/helper/newClassHelper.php" method="post">
    <label for="data">Klassenbezeichnung</label>
    <input class="test" type="text" name="liste" id="listenname">
    <select name="gradeKey" id="gradeKey">
        <?php
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        $sql = "SELECT idNotenschluesselTyp, SchlusselName FROM notenschluesseltyp";
        foreach ($PDO->query($sql) as $row) {
            echo "<option value='".$row['idNotenschluesselTyp']."'>".$row['SchlusselName']."</option>";
        }
        ?>
    </select>
    <input type="submit" name="senden" value="Senden">
</form>