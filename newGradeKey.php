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
    $return = listHelper::addgradeKey($von1, $von2, $von3, $von4, $von5, $von6, $bis1, $bis2, $bis3, $bis4, $bis5, $bis6, $keyName);
    if ($return)
    {
        header("Location: ./newGradeKey.php?succsess=succsess");
    }
    else{
        header("Location: ./newGradeKey.php?error=error");
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script>
    $( function() {
        $( "#tabs" ).tabs();
    } );
</script>
<div class="centerThis" id="tabs">
    <ul>
        <li><a href="#tabs-1">Notenschlüssel eintragen</a></li>
        <li><a href="#tabs-2">Notenschlüssel bearbeiten</a></li>
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
        <p>test</p>
    </div>
</div>
