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
    $von1 = $_POST['von1'];
    $von2 = $_POST['von2'];
    $von3 = $_POST['von3'];
    $von4 = $_POST['von4'];
    $von5 = $_POST['von5'];
    $von6 = $_POST['von6'];

    $bis1 = $_POST['bis1'];
    $bis2 = $_POST['bis2'];
    $bis3 = $_POST['bis3'];
    $bis4 = $_POST['bis4'];
    $bis5 = $_POST['bis5'];
    $bis6 = $_POST['bis6'];
    $keyName = $_POST['keyName'];
    $return = addgradeKey($keyName, $von1, $von2, $von3, $von4, $von5, $von6, $bis1, $bis2, $bis3, $bis4, $bis5, $bis6);
    if ($return)
    {
        header("Location: ./newGradeKey.php?succsess=succsess");
    }
    else{
        header("Location: ./newGradeKey.php?error=error");
    }
}

if (isset($_POST['senden'])) {
    $von1 = $_POST['von1'];
    $von2 = $_POST['von2'];
    $von3 = $_POST['von3'];
    $von4 = $_POST['von4'];
    $von5 = $_POST['von5'];
    $von6 = $_POST['von6'];
    $von7 = $_POST['von7'];
    $von8 = $_POST['von8'];
    $von9 = $_POST['von9'];
    $von10 = $_POST['von10'];
    $von11 = $_POST['von11'];
    $von12 = $_POST['von12'];
    $von13 = $_POST['von13'];
    $von14 = $_POST['von14'];
    $von15 = $_POST['von15'];

    $bis1 = $_POST['bis1'];
    $bis2 = $_POST['bis2'];
    $bis3 = $_POST['bis3'];
    $bis4 = $_POST['bis4'];
    $bis5 = $_POST['bis5'];
    $bis6 = $_POST['bis6'];
    $bis7 = $_POST['bis7'];
    $bis8 = $_POST['bis8'];
    $bis9 = $_POST['bis9'];
    $bis10 = $_POST['bis10'];
    $bis11 = $_POST['bis11'];
    $bis12 = $_POST['bis12'];
    $bis13 = $_POST['bis13'];
    $bis14 = $_POST['bis14'];
    $bis15 = $_POST['bis15'];

    $keyName = $_POST['keyName'];
    $return = addgradeKey($keyName, $von1, $von2, $von3, $von4, $von5, $von6, $bis1, $bis2, $bis3, $bis4, $bis5, $bis6,
        $von7, $von8, $von9, $von10, $von11, $von12, $von13, $von14, $von15, $bis7 ,$bis8, $bis9, $bis10, $bis11, $bis12,
        $bis13, $bis14, $bis15);
    if ($return)
    {
        header("Location: ./newGradeKey.php?succsess=succsess");
    }
    else
    {
        header("Location: ./newGradeKey.php?error=error");
    }
}
?>
<script>
    $( function() {
        $( "#tabs" ).tabs();
    } );
</script>
<div class="centerThis" id="tabs">
    <ul>
        <li><a href="#tabs-1">Notenschlüssel 6 Noten</a></li>
        <li><a href="#tabs-2">Notenschlüssel 15 Punkte</a></li>
        <li><a href="#tabs-3">Notenschlüssel bearbeiten</a></li>
    </ul>
    <div id="tabs-1">
        <?php
        if (isset($_GET["succsess"])) {
            if ($_GET["succsess"] == "succsess") {
                echo "<span class='succsess'>Notenschlüssel erfolgreich angelegt.</span><br><br>";
            }
        } elseif (isset($_GET["error"])) {
            //Fehlermeldungen bei Fehlern
            if ($_GET["error"] == "error") {
                echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
            }
        }
        ?>
        <form action="" method="post">
        <ul class="form-style-1">
            <li><label>Von/bis 1 <span class="required">*</span></label><input type="text" name="von1" class="field-divided" placeholder="Von" /> <input type="text" name="bis1" class="field-divided" placeholder="Bis" /></li>
            <li><label>Von/bis 2 <span class="required">*</span></label><input type="text" name="von2" class="field-divided" placeholder="Von" /> <input type="text" name="bis2" class="field-divided" placeholder="Bis" /></li>
            <li><label>Von/bis 3 <span class="required">*</span></label><input type="text" name="von3" class="field-divided" placeholder="Von" /> <input type="text" name="bis3" class="field-divided" placeholder="Bis" /></li>
            <li><label>Von/bis 4 <span class="required">*</span></label><input type="text" name="von4" class="field-divided" placeholder="Von" /> <input type="text" name="bis4" class="field-divided" placeholder="Bis" /></li>
            <li><label>Von/bis 5 <span class="required">*</span></label><input type="text" name="von5" class="field-divided" placeholder="Von" /> <input type="text" name="bis5" class="field-divided" placeholder="Bis" /></li>
            <li><label>Von/bis 6 <span class="required">*</span></label><input type="text" name="von6" class="field-divided" placeholder="Von" /> <input type="text" name="bis6" class="field-divided" placeholder="Bis" /></li>
            <li>
                <label>Schlüsselname <span class="required">*</span></label>
                <input type="text" name="keyName" class="field-long" />
            </li>
            <li>
                <input type="submit" name="submit" value="Senden" />
            </li>
        </ul>
        </form>
    </div>
    <div id="tabs-2">
        <form action="" method="post">
            <ul class="form-style-1">
                <li><label>Von/bis 1 <span class="required">*</span></label><input type="text" name="von1" class="field-divided" placeholder="Von" /> <input type="text" name="bis1" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 2 <span class="required">*</span></label><input type="text" name="von2" class="field-divided" placeholder="Von" /> <input type="text" name="bis2" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 3 <span class="required">*</span></label><input type="text" name="von3" class="field-divided" placeholder="Von" /> <input type="text" name="bis3" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 4 <span class="required">*</span></label><input type="text" name="von4" class="field-divided" placeholder="Von" /> <input type="text" name="bis4" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 5 <span class="required">*</span></label><input type="text" name="von5" class="field-divided" placeholder="Von" /> <input type="text" name="bis5" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 6 <span class="required">*</span></label><input type="text" name="von6" class="field-divided" placeholder="Von" /> <input type="text" name="bis6" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 7 <span class="required">*</span></label><input type="text" name="von7" class="field-divided" placeholder="Von" /> <input type="text" name="bis7" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 8 <span class="required">*</span></label><input type="text" name="von8" class="field-divided" placeholder="Von" /> <input type="text" name="bis8" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 9 <span class="required">*</span></label><input type="text" name="von9" class="field-divided" placeholder="Von" /> <input type="text" name="bis9" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 10 <span class="required">*</span></label><input type="text" name="von10" class="field-divided" placeholder="Von" /> <input type="text" name="bis10" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 11 <span class="required">*</span></label><input type="text" name="von11" class="field-divided" placeholder="Von" /> <input type="text" name="bis11" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 12 <span class="required">*</span></label><input type="text" name="von12" class="field-divided" placeholder="Von" /> <input type="text" name="bis12" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 13 <span class="required">*</span></label><input type="text" name="von13" class="field-divided" placeholder="Von" /> <input type="text" name="bis13" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 14 <span class="required">*</span></label><input type="text" name="von14" class="field-divided" placeholder="Von" /> <input type="text" name="bis14" class="field-divided" placeholder="Bis" /></li>
                <li><label>Von/bis 15 <span class="required">*</span></label><input type="text" name="von15" class="field-divided" placeholder="Von" /> <input type="text" name="bis15" class="field-divided" placeholder="Bis" /></li>
                <li>
                    <label>Schlüsselname <span class="required">*</span></label>
                    <input type="text" name="keyName" class="field-long" />
                </li>
                <li>
                    <input type="submit" name="senden" value="Senden" />
                </li>
            </ul>
        </form>
    </div>
    <div id="tabs-3">
        Die magische Miesmuschel sagt: Eines Tages vielleicht.
    </div>
</div>
