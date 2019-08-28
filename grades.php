<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 28.08.2019
 * Time: 11:37
 */
include_once 'files_lp/ui/header.php';
include_once 'project_files/Database.php';
include_once 'project_files/_config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
$sql = "SELECT note.Kommentar, note.Note, note.Prozent, note.Datum, t.Fachname, n.NotenTyp FROM note
        LEFT JOIN fach f on note.Fach_id_Fach = f.id_Fach
        LEFT JOIN typ t on f.Typ_idTyp = t.idTyp
        LEFT JOIN notentyp n on note.NotenTyp_idNotenTyp = n.idNotenTyp
        WHERE note.Schueler_id_Schueler = ?";
$pre = $PDO->prepare($sql);
$pre->execute(array($id));
$result = $pre->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<tr>";
echo "<th>Note</th>";
echo "<th>Prozent</th>";
echo "<th>Datum</th>";
echo "<th>Fachname</th>";
echo "<th>Notentyp</th>";
echo "<th>Kommentar</th>";
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
    echo "</tr>";
}
echo "</table>";