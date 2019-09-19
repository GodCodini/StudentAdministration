<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 29.08.2019
 * Time: 15:50
 */
include_once 'files_lp/ui/header.php';

if (isset($_GET["succsess"]))
{
    if ($_GET["succsess"] == "grade")
    {
        echo "<span class='succsess'>Note erfolgreich angelegt.</span><br><br>";
    }
}
elseif (isset($_GET["error"]))
{
    //Fehlermeldungen bei Fehlern
    if ($_GET["error"] == "error")
    {
        echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
    }
}

if (isset($_POST['submit'])) {
    $id = $_POST['gradekey'];

}
else {
    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
    ?>
    <div class="centerThis">
        <form class="form-style-7" method="post" action="">
            <ul>
                <li>
                    <label for="name">Notenschlüssel</label>
                    <select name="gradekey" id="gradekey">
                        <?php
                        try {
                            $sql = "SELECT idNotenschluesselTyp, SchlusselName from notenschluesseltyp";
                            $result = $PDO->query($sql);
                            //$result = $PDO->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                echo "<option value='" . $row['idNotenschluesselTyp'] . "'>" . $row['SchlusselName'] . "</option>";
                            }
                        } catch (Exception $e) {
                            echo $e->getCode();
                            echo $e->getMessage();
                        }
                        ?>
                    </select>
                    <span>Wählen Sie den Schlüssel zum bearbeiten</span>
                </li>
                <li>
                    <input type="submit" name="submit" value="Note eintragen">
                </li>
            </ul>
        </form>
    </div>
    <?php
}