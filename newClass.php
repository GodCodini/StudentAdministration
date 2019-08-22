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
    if ($_GET["succsess"] == "class") {
        echo "<span class='succsess'>Klasse erfolgreich angelegt.</span><br><br>";
    }
} elseif (isset($_GET["error"])) {
    //Fehlermeldungen bei Fehlern
    if ($_GET["error"] == "error") {
        echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
    }
}

if (isset($_POST['senden'])) {
    $name = $_POST['liste'];
    $gradeKey = $_POST['gradeKey'];

    $return = listHelper::createList($name, $gradeKey);
    if ($return)
    {
        header("Location: ./newClass.php?succsess=class");
    }
    else {
        header("Location: ./newClass.php?error=error");
    }

}
?>

<form class="form-style-7" method="post" action="">
    <ul>
        <li>
            <label for="name">Klassenbezeichnung</label>
            <input type="text" name="liste" autocomplete="off" autofocus id="listenname">
            <span>Geben Sie das Kürzel der Klasse ein</span>
        </li>

        <li>
            <label for="name">Notenschlüssel</label>
            <select name="gradeKey" id="gradeKey">
                <?php
                try {
                    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
                    $sql = "SELECT idNotenschluesselTyp, SchlusselName FROM notenschluesseltyp";
                    foreach ($PDO->query($sql) as $row) {
                        echo "<option value='".$row['idNotenschluesselTyp']."'>".$row['SchlusselName']."</option>";
                    }
                }
                catch (Exception $e)
                {
                    echo $e->getCode();
                    echo $e->getMessage();
                }

                ?>
            </select>
            <span>Geben Sie den Notenschlüssel an</span>
        </li>

        <li>
            <input type="submit" name="senden" value="Klasse anlegen" >
        </li>
    </ul>
</form>