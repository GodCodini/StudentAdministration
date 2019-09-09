<?php
include 'headerMenu.php';
?>

<div class="contentContainer">
    <div class="sectionHeader">Neue Klasse anlegen</div>
    <div class="inputArea">
        <form id="Klasse" class="formElement newClassForm">
            <label for="klassenName">Klassebezeichnung:</label>
            <input id="klassenName" class="neueKlasseInput" type="text" name="klassenName" required><br>

            <label for="notenSchluesselTyp">Notenschlüssel:</label>
                <select id="notenSchluesselTyp" name="notenSchluessel dropDownItem" class="dropDownKlasse" name="classID" required>
                    <?php
                    $columnsArr=['idNotenschluesselTyp','SchlusselName'];
                    $dbResultArr = Database::getDatabaseData($columnsArr, 'notenschluesseltyp');

                    foreach($dbResultArr as $entry)
                    {
                        echo'<option';
                        foreach($entry as $key => $value)
                        {
                            if($key=='idNotenschluesselTyp'){
                                echo' value="'.$value.'">';
                            }
                            else{
                                echo $value.'';
                            }
                        }
                        echo '</option>';
                    }
                    ?>
                </select>
            <a class="addNewElementButton" title="weiteren Notenschlüssel erstellen" href="createGradeKey.php">+</a><br>

            <input class="styledButton" type="submit">
        </form>
    </div>

<?php
Database::getAllClasses();
//Database::getAllClassNodes();
include 'footer.php';
?>