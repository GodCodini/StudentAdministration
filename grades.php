<?php
include_once 'files_lp/ui/header.php';

if (isset($_GET["id"]) AND isset($_GET['class']))
{
    $id = $_GET["id"];
    $class = $_GET["class"];
}

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT note.Kommentar, note.Note, note.Prozent, note.Datum, note.scoredPoints, note.maxPoints, teacher.LastName, f.id_Fach, t.Fachname, n.NotenTyp, s.Vorname, s.Nachname FROM note
        LEFT JOIN fach f on note.Fach_id_Fach = f.id_Fach
        LEFT JOIN typ t on f.Typ_idTyp = t.idTyp
        LEFT JOIN notentyp n on note.NotenTyp_idNotenTyp = n.idNotenTyp
        LEFT JOIN schueler s on note.Schueler_id_Schueler = s.id_Schueler
        LEFT JOIN teacher on note.teacher_FK = teacher.id_teacher
        WHERE note.Schueler_id_Schueler = ?";
$pre = $PDO->prepare($sql);
$pre->execute(array($id));
$result = $pre->fetchAll(PDO::FETCH_ASSOC);
echo "<a href='index.php?id=$class'>Zurück zur Klasse $class</a><br><br>";
echo "Notentabelle für ".$result[0]['Vorname']." ".$result[0]['Nachname'];
echo "<table>";
echo "<tr>";
echo "<th>Note</th>";
echo "<th>Prozent</th>";
echo "<th>Punkte</th>";
echo "<th>Datum</th>";
echo "<th>Fachname</th>";
echo "<th>Notentyp</th>";
echo "<th>Kommentar</th>";
echo "<th>Lehrer/Kürzel</th>";
echo "</tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>";
    echo "<p>".$row['Note']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['Prozent']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['scoredPoints']."/".$row['maxPoints']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".DB::convertDate($row['Datum'])."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['Fachname']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['NotenTyp']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['Kommentar']."</p>";
    echo "</td>";
    echo "<td>";
    echo "<p>".$row['LastName']."</p>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

$average = avgGrades($id);

echo "Durchschnittlicher Prozentwert: ".$average[0]."<br>";
echo "Durchschnittliche Note: ".$average[1];