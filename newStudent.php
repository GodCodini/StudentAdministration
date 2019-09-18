<?php
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
    addStudent($firstName, $lastName, $bday, $class);
    header("Location: ./newStudent.php?succsess=student");
}
?>
<div class="centerThis">
    <form class="form-style-7" method="post" action="">
        <ul>
            <li>
                <label for="name">Vorname</label>
                <input type="text" name="firstName" autocomplete="off" pattern="^[A-Za-zÖöÄäÜüß -]*$" autofocus id="firstName">
                <span>Geben Sie den Vornamen ein</span>
            </li>
            <li>
                <label for="name">Nachname</label>
                <input type="text" name="lastName" autocomplete="off" pattern="^[A-Za-zßÜüÖöäÄ-]*$" autofocus id="lastName">
                <span>Geben Sie den Nachnamen ein</span>
            </li>
            <li>
                <label for="name">Geburtstag</label>
                <input type="date" name="bday" autocomplete="off" id="bday">
                <span>Geben Sie das Geburtsdatum ein</span>
            </li>
            <li>
                <label for="name">Klasse</label>
                <select class="neueKlasseInput" name="class" id="class">
                    <?php
                    $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
                    $sql = "SELECT id_kurs, kursName FROM kurs";
                    foreach ($PDO->query($sql) as $row)
                    {
                        echo "<option value='".$row['id_kurs']."'>".$row['kursName']."</option>";
                    }
                    ?>
                </select>
                <span>Geben Sie die Klasse an</span>
            </li>
            <li>
                <input type="submit" name="submit" value="Schüler eintragen" >
            </li>
        </ul>
    </form>
</div>
