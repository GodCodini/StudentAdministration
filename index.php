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

error_reporting(E_ERROR | E_PARSE);
if (isset($_SESSION['UserRight']) AND isset($_SESSION['UserLogin']))
{
    $userRight = $_SESSION['UserRight'];
    $userLogin = $_SESSION['UserLogin'];

    if ($userRight == "ADMIN")
    {
        if (isset($_GET['id']) AND isset($_GET['sort']))
        {
            $kurs = strtoupper($_GET['id']);
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
            echo "<p id='className'> Klasse ".$kurs."</p>";
            echo "<table id='myTable'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nachname</th>";
            echo "<th>Vorname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Note hinzufügen</th>";
            echo "</tr>";
            echo "</thead>";
            printList($liste, $kurs, true);
            echo "</table>";
        }
        elseif (isset($_GET['id']))
        {
            $kurs = strtoupper($_GET['id']);
            if (isset($_SESSION[$kurs]))
            {
                $liste = unserialize($_SESSION[$kurs]);
            }
            else
            {
                buildList($kurs);
                $liste = unserialize($_SESSION[$kurs]);
            }
            ?>
            <p id='className'>Klasse <?= $kurs ?></p>
            <button class='ui-button' onclick="location.href='?id=<?= $kurs ?>&sort=true'">Sortieren</button>
            <?php
            echo "<table id='myTable'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nachname</th>";
            echo "<th>Vorname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Note hinzufügen</th>";
            echo "</tr>";
            echo "</thead>";

            printList($liste, $kurs);

            echo "</table>";
        }
        else
        {
            $sql = "SELECT kursName FROM kurs";
            $result = $PDO->query($sql);
            echo "<table id='Table'>";
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
    }
    else
    {
        if (isset($_GET['id']) AND isset($_GET['sort']))
        {
            $kurs = strtoupper($_GET['id']);
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
            echo "<p id='className'> Klasse ".$kurs."</p>";
            echo "<table id='myTable'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nachname</th>";
            echo "<th>Vorname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Note hinzufügen</th>";
            echo "</tr>";
            echo "</thead>";
            printList($liste, $kurs, true);
            echo "</table>";
        }
        elseif (isset($_GET['id']))
        {
            $kurs = strtoupper($_GET['id']);
            if (isset($_SESSION[$kurs]))
            {
                $liste = unserialize($_SESSION[$kurs]);
            }
            else
            {
                buildList($kurs);
                $liste = unserialize($_SESSION[$kurs]);
            }
            ?>
            <p id='className'>Klasse <?= $kurs ?></p>
            <button class='ui-button' onclick="location.href='?id=<?= $kurs ?>&sort=true'">Sortieren</button>
            <?php
            echo "<table id='myTable'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nachname</th>";
            echo "<th>Vorname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Note hinzufügen</th>";
            echo "</tr>";
            echo "</thead>";

            printList($liste, $kurs);

            echo "</table>";
        }
        else
        {
            //TODO Query nach benutzerrecht anpassen (= zugriff beschränken)
            $sql = "SELECT kursName FROM kurs
                    LEFT JOIN classes c on kurs.id_Kurs = c.kursFK
                    LEFT JOIN teacher t on c.teacherFK = t.id_Teacher
                    WHERE t.login = ?";
            $result = $PDO->prepare($sql);
            $result->execute(array($userLogin));
            $array = $result->fetchAll(PDO::FETCH_ASSOC);
            echo "<table id='Table'>";
            echo "<th>Klasse</th>";
            foreach ($array as $item)
            {
                echo "<tr>";
                echo "<td>";
                echo "<a href='index.php?id=" . $item["kursName"] . "'>" . $item["kursName"] . "</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
else
{
    header("Location: login.php");
}
?>

<div id="dialog" title="Schüler bearbeiten" style="display: none;">
    <form class="form-style-7" id="updateStudent" method="post" action="">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="sorted" id="sorted">
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
    });

    function makeTrClickableAgain(e)
    {
            var date = $(e).find("#birth").text();
            var newdate = date.split(".").reverse().join("-");
            $("input#id").val($(e).find("#id").text());
            $("input#sorted").val($(e).find("#sorted").text());
            $("input#firstName").val($(e).find("#first").text());
            $("input#lastName").val($(e).find("#last").text());
            $("input#bday").val(newdate);
            $("select option[value='<?php echo $liste->getId() ?>']").attr('selected', 'selected');
            $( "#dialog" ).dialog( "open" );
    }

    function updateStudent()
    {
        const id = $("input[type=hidden]#id").val();
        const sorted = $("input[type=hidden]#sorted").val();
        const firstName = $("#firstName").val();
        const lastName = $("#lastName").val();
        const bday = $("#bday").val();
        const courseKey = $("select[name=class]").val();

        $.ajax({
            type: "post",
            url: "ajax_student.php",
            data:
                {
                    first: firstName,
                    last: lastName,
                    birth: bday,
                    course: courseKey,
                    studentID: id,
                    sorted: sorted
                },
            dataType: "html",
            success: function (data) {
                $("#myTbody").remove();
                $("#myTable").append(data);
                console.log("yay");
                console.log(data);
                $( "#dialog" ).dialog( "close" );
            },
            error: function (data) {
                console.log("fail");
                console.log(data);
            }
        })
    }
</script>