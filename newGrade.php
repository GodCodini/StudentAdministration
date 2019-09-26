<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */
include_once 'files_lp/ui/header.php';

if (isset($_GET))
{
    if (isset($_GET['class']))
    {
        $class = $_GET["class"];
    }

    $id = $_GET["id"];
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
}

if (isset($_POST['submit'])) {
    $percent = $_POST['percent'];
    $date = $_POST['date'];
    $course = $_POST['course'];
    $gradeType = $_POST['gradeType'];
    $gradeKey = $_POST['gradeKey'];
    $comment = $_POST['comment'];
    $scored = $_POST['scored'];
    $max = $_POST['max'];

    $return = addGrade($percent, $date, $id, $course, $gradeType, $gradeKey, $scored, $max, $comment);
    if ($return)
    {
        header("Location: ./newGrade.php?id=".$id."&class=".$class."&succsess=grade");
    }
    else {
        header("Location: ./newGrade.php?id=".$id."&error=error");
    }
}
$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT Vorname, Nachname FROM schueler
        WHERE id_Schueler = ?";
$pre = $PDO->prepare($sql);
$pre->execute(array($id));
$result = $pre->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="centerThis">
    <a href="index.php?id=<?= $class ?>">Zurück zur Klasse <?= $class ?></a>
    <p>Noten für <?= $result[0]['Vorname'] ?> <?= $result[0]['Nachname']?></p>
    <form method="post" action="">
        <input name="id" type="hidden" value="<?= $id; ?>">
        <ul class="form-style-1">
            <li><label>Erreichte/Maximale Punkte</label><input type="number" required step="0.5" id="scored" name="scored" class="field-divided calc" placeholder="Erreicht" />/<input type="number" step="0.5" id="max" name="max" class="field-divided calc" placeholder="Maximal" /></li>
            <li>
                <label for="name">Prozent</label>
                <input type="number" min="0" max="100" name="percent" required autocomplete="off" id="percent">
            </li>
            <li>
                <label for="name">Note</label>
                <input type="number" min="1" max="15" name="grade" required autocomplete="off" id="grade">
            </li>
            <li>
                <label for="name">Datum</label>
                <input type="date" name="date" autocomplete="off" required id="date">
            </li>
            <li>
                <label for="name">Fach</label>
                <select name="course" required id="course">
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
            </li>
            <li>
                <label for="name">Notentyp</label>
                <select name="gradeType" required id="gradeType">
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
            </li>
            <li>
                <label for="name">Notenschlüssel</label>
                <select name="gradeKey" required id="gradeKey">
                    <?php
                    try {
                        $sqlGrade = "SELECT idNotenschluesselTyp, SchlusselName FROM notenschluesseltyp";
                        foreach ($PDO->query($sqlGrade) as $row) {
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
            </li>
            <li>
                <label for="name">Kommentar</label>
                <input type="text" name="comment" autocomplete="off" pattern="^[A-Za-z][A-Za-z0-9,:%/ ÄäÜüÖö]*$" id="comment">
            </li>
            <li>
                <input type="submit" name="submit" value="Note eintragen" >
            </li>
        </ul>
    </form>
</div>

<script>
    //ändert Note/prozent aufgrund der Punktzahl
    $("#scored, #max, select[name=gradeKey]").change(function ()
    {
        let score = parseInt($("#scored").val());
        let max = parseInt($("#max").val());
        if (max)
        {
            if (score <= max)
            {
                let calc = Math.round((score / max) * 100);
                $("#percent").val(calc);
                getGrade();
            }
            else
            {
                $("#percent").val(100);
                $("#grade").val(1);
            }
        }
    });

    function getGrade ()
    {
        let percent = $("#percent").val();
        let gradeKey = $("select[name=gradeKey]").val();

        $.ajax({
            url: "ajax_grades.php",
            method: "post",
            data: {
                percent: percent,
                key: gradeKey
            },
            dataType: "html",
            success: function (grade)
            {
                $("#grade").val(grade);
            },
            error: function (data)
            {
                console.log(data);
                alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
            }
        })
    }
</script>