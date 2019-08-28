<?php
include_once 'files_lp/ui/header.php';
include_once 'project_files/Database.php';
include_once 'project_files/_config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
elseif (isset($_GET["succsess"]))
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
    $grade = $_POST['grade'];
    $percent = $_POST['percent'];
    $date = $_POST['date'];
    $course = $_POST['course'];
    $gradeType = $_POST['gradeType'];
    $comment = $_POST['comment'];

    $return = listHelper::addGrade($grade, $percent, $date, $id, $course, $gradeType, $comment);
    if ($return)
    {
        header("Location: ./newGrade.php?succsess=grade");
    }
    else {
        header("Location: ./newGrade.php?error=error");
    }

}
$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT typ.Fachname from typ left join fach f on typ.idTyp = f.Typ_idTyp left join kurs k on f.Kurs_id_Kurs = k.id_Kurs left join schueler s on k.id_Kurs = s.Kurs_id_Kurs where s.id_Schueler = ?";
?>
<div class="centerThis">
    <form class="form-style-7" method="post" action="">
        <input name="id" type="hidden" value="<?php echo $id; ?>">
        <ul>
            <li>
                <label for="name">Note</label>
                <input type="number" min="1" max="6" name="grade" autocomplete="off" autofocus id="grade">
                <span>Geben Sie die Note ein</span>
            </li>
            <li>
                <label for="name">in Prozent</label>
                <input type="number" min="0" max="100" name="percent" autocomplete="off" autofocus id="percent">
                <span>Geben Sie den Prozentwert ein</span>
            </li>
            <li>
                <label for="name">Datum</label>
                <input type="date" name="date" autocomplete="off" id="date">
                <span>Geben Sie das Datum ein</span>
            </li>
            <li>
                <label for="name">Fach</label>
                <select name="course" id="course">
                    <?php
                    try {
                        $sql = "SELECT typ.idTyp, typ.Fachname, f.id_Fach FROM typ 
                                LEFT JOIN fach f ON typ.idTyp = f.Typ_idTyp 
                                LEFT JOIN kurs k ON f.Kurs_id_Kurs = k.id_Kurs
                                LEFT JOIN schueler s ON k.id_Kurs = s.Kurs_id_Kurs
                                WHERE s.id_Schueler = ?";
                        $pre = $PDO->prepare($sql);
                        $pre->execute(array($id));
                        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo "<option value='".$row['id_Fach']."'>".$row['Fachname']."</option>";
                        }
                    }
                    catch (Exception $e)
                    {
                        echo $e->getCode();
                        echo $e->getMessage();
                    }
                    ?>
                </select>
                <span>Geben Sie das Fach an</span>
            </li>
            <li>
                <label for="name">Notentyp</label>
                <select name="gradeType" id="gradeType">
                    <?php
                    try {
                        $sqlGrade = "SELECT idNotenTyp, NotenTyp FROM notentyp";
                        foreach ($PDO->query($sqlGrade) as $row) {
                            echo "<option value='".$row['idNotenTyp']."'>".$row['NotenTyp']."</option>";
                        }
                    }
                    catch (Exception $e)
                    {
                        echo $e->getCode();
                        echo $e->getMessage();
                    }
                    ?>
                </select>
                <span>Geben Sie den Notentyp an</span>
            </li>
            <li>
                <label for="name">Kommentar</label>
                <input type="text" name="comment" autocomplete="off" pattern="^[A-Za-z][A-Za-z0-9,:%/ ÄäÜüÖö]*$" id="comment">
                <span>Geben Sie einen optionalen Kommentar ab</span>
            </li>
            <li>
                <button type="submit" name="submit" value="Note eintragen" >Absenden</button>
            </li>
        </ul>
    </form>
</div>