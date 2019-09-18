<?php
/**
 * Copyright (c) 2019. Ralf Klaßen & Lennart Pamperin
 * This Software is licensed under GPL 3.0.
 * This program comes with ABSOLUTELY NO WARRANTY!
 * This is free software, and you are welcome to redistribute it
 * under certain conditions:
 * https://github.com/TheAmazingCodini/StudentAdministration/blob/master/LICENSE
 */
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';
include_once 'files_lp/ui/header.php';

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
//$pw = $_COOKIE['password'];
//$redirect_after_login = 'files_lp/liste.php';
//
//$sql = "SELECT (aktuellesPW) FROM passwort";
//$statement = $PDO->query($sql);
//$result = $statement->fetch(PDO::FETCH_ASSOC);
//$aktuellesPW = $result['aktuellesPW'];
////wenn das passwort geändert wurde, cookie aktualisieren
//if (isset($_GET['succsess']))
// {
//    if ($_GET['succsess'] == "pwupdated")
//    {
//        $remember_password = strtotime('+1 days');
//        $sql = "SELECT (aktuellesPW) FROM passwort";
//        $statement = $PDO->query($sql);
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        $aktuellePW = $result['aktuellesPW'];
//        setcookie("password", $aktuellePW, $remember_password);
//        header('Refresh:5;url=./admin.php?succsess=pwupdate');
//    }
//} elseif (empty($_COOKIE['password']))
//{
//    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
//    header('Location: files_lp/login.php');
//    exit;
//} elseif ($pw != $aktuellesPW)
//{
//    header('Location: files_lp/login.php');
//    exit;
//} else
//    {
//        header("Location: files_lp/liste.php");
//    }
error_reporting(E_ERROR | E_PARSE);

if (isset($_GET['id']) AND isset($_GET['sort']))
{
    $kurs = $_GET['id'];
    $sort = $_GET['sort'];
    if (isset($_SESSION[$kurs]))
    {
        $liste = unserialize($_SESSION[$kurs]);
    }
    else
    {
        buildList($kurs);
        $liste = unserialize($_SESSION[$kurs]);
    }
    $list = sortList($kurs);
    $array = $list->readList();

    echo "<button class='ui-button' onclick=\"location.href='?id=".$kurs."&sort=true'\">Sortieren</button>";

    echo "<table id='myTable'>";
    echo "<tr>";
    echo "<th>Nachname</th>";
    echo "<th>Vorname</th>";
    echo "<th>Geburtsdatum</th>";
    echo "<th>Note hinzufügen</th>";
    echo "</tr>";
    foreach ($array as $row)
    {
        echo "<tr>";
        echo "<td id='id' style='display: none'>".$row[3]."</td>";
        echo "<td id='last' class='dontTouchThis'>";
        echo "<a href='grades.php?id=".$row[3]."'>".$row[1]."</a>";
        echo "</td>";
        echo "<td id='first'>";
        echo $row[0];
        echo "</td>";
        echo "<td id='birth'>";
        echo DB::convertDate($row[2]);
        echo "</td>";
        echo "<td class='dontTouchThis'>";
        echo "<a href='newGrade.php?id=".$row[3]."&class=".$kurs."'>Noten für ".$row[0]." ".$row[1]." eintragen</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<pre>";
/*    highlight_string("<?php\n\$liste =\n" . var_export($list, true) . ";\n?>");*/
    var_dump($list);
    echo "</pre>";
}
elseif (isset($_GET['id']))
{
    $kurs = $_GET['id'];
    if (isset($_SESSION[$kurs]))
    {
        $liste = unserialize($_SESSION[$kurs]);
    }
    else
    {
        buildList($kurs);
        $liste = unserialize($_SESSION[$kurs]);
    }
    $array = $liste->readList();
    ?>
    <button class='ui-button' onclick="location.href='?id=<?php echo $kurs ?>&sort=true'">Sortieren</button>
    <?php
    echo "<table id='myTable'>";
    echo "<tr>";
    echo "<th>Nachname</th>";
    echo "<th>Vorname</th>";
    echo "<th>Geburtsdatum</th>";
    echo "<th>Note hinzufügen</th>";
    echo "</tr>";
    foreach ($array as $row)
    {
        echo "<tr>";
        echo "<td id='id' style='display: none'>".$row[3]."</td>";
        echo "<td id='last' class='dontTouchThis'>";
        echo "<a href='grades.php?id=".$row[3]."'>".$row[1]."</a>";
        echo "</td>";
        echo "<td id='first'>";
        echo $row[0];
        echo "</td>";
        echo "<td id='birth'>";
        echo DB::convertDate($row[2]);
        echo "</td>";
        echo "<td class='dontTouchThis'>";
        echo "<a href='newGrade.php?id=".$row[3]."&class=".$kurs."'>Noten für ".$row[0]." ".$row[1]." eintragen</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<pre>";
/*    highlight_string("<?php\n\$liste =\n" . var_export($liste, true) . ";\n?>");*/
    var_dump($liste);
    echo "</pre>";
}
else
    {
    $sql = "SELECT kursName FROM kurs";
    $result = $PDO->query($sql);
    echo "<table id='myTable'>";
        echo "<th>Klasse</th>";
        foreach ($result as $item)
        {
            echo "<tr>";
            echo "<td>";
            echo "<a href='index.php?id=" . $item['kursName'] . "'>" . $item['kursName'] . "</a>";
            echo "</td>";
            echo "</tr>";
        }
    echo "</table>";
}
?>

<div id="dialog" title="Schüler bearbeiten" style="display: none;">
    <form class="form-style-7" id="updateStudent" method="post" action="">
        <input type="hidden" name="id" id="id">
        <ul>
            <li>
                <label for="name">Vorname</label>
                <input type="text" name="firstName" autocomplete="off" value="" pattern="^[A-Za-zÖöÄäÜüß -]*$" autofocus id="firstName">
                <span>Geben Sie den Vornamen ein</span>
            </li>
            <li>
                <label for="name">Nachname</label>
                <input type="text" name="lastName" autocomplete="off" pattern="^[A-Za-zßÜüÖöäÄ-]*$" id="lastName">
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
                <input type="button" onclick="updateStudent()" name="submit" value="Schüler eintragen" >
            </li>
        </ul>
    </form>
</div>

<script>
    $( function() {
        $( "#dialog" ).dialog({
            autoOpen: false,
            show: {
                effect: "blind",
                duration: 500
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });

        $( "#myTable tr" ).not(':first, tr > td.dontTouchThis').click( function(e) {
            var date = $(e.currentTarget).find("#birth").text();
            var newdate = date.split(".").reverse().join("-");
            $("input#id").val($(e.currentTarget).find("#id").text());
            $("input#firstName").val($(e.currentTarget).find("#first").text());
            $("input#lastName").val($(e.currentTarget).find("#last").text());
            $("input#bday").val(newdate);
            $("select option[value='<?php echo $liste->getId() ?>']").attr('selected', 'selected');
            $( "#dialog" ).dialog( "open" );
        });
    } );

    function updateStudent() {
        var id = $("#id").val();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var bday = $("#bday").val();
        var courseKey = $("#class option:selected").val();
        var course = $("#class option:selected").text();

        $.ajax({
            type: "post",
            url: "ajax_student.php",
            data:
                {
                    first: firstName,
                    last: lastName,
                    birth: bday,
                    class: courseKey,
                    studentID: id
                },
            dataType: "json",
            success: function (data) {
                // $(".studentOutputTable").prepend('' +
                //     '<tr>' +
                //     '<td class="last">'+lastName+'</td>' +
                //     '<td class="first">'+firstName+'</td>' +
                //     '<td class="birth">'+bday+'</td>' +
                //     '<td><a href="newGrade.php?id='+id+'&class='+course+'">Noten für '+firstName + lastName+' eintragen</a></td>' +
                //     '</tr>');
                console.log("yay");
                console.log(data);
            },
            error: function (data) {
                console.log("fail");
                console.log(data);
            }
        })
    }
</script>