<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 14.08.2019
 * Time: 08:27
 */
include_once 'files_lp/ui/header.php';
include_once 'project_files/Database.php';
include_once 'project_files/_config.php';
if (isset($_GET["succsess"])) {
    if ($_GET["succsess"] == "student") {
        echo "<span class='succsess'>Schüler erfolgreich angelegt.</span><br><br>";
    }
} elseif (isset($_GET["error"])) {
    //Fehlermeldungen bei Fehlern
    if ($_GET["error"] == "error") {
        echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
    }
}

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $bday = $_POST['bday'];
    $class = $_POST['class'];
    //$listName = $_SESSION['name'];
    listHelper::addStudent($firstName, $lastName, $bday, $class);
    header("Location: ./newStudent.php?succsess=student");
}
?>

<form id="list" method="post" action="">
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
