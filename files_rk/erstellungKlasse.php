<?php
include 'headerMenu.php';
?>

<div class="contentContainer">
    <div class="sectionHeader">Neue Klasse anlegen</div>
    <div class="inputArea">

        <div class="inputAreaElement">
            <label for="klassenName">Klassebezeichnung:</label>
            <input id="klassenName" class="neueKlasseInput" type="text" name="klassenName"><br>
        </div>

        <div class="inputAreaElement">
            <label for="notenSchluesselTyp">Notenschlüssel:</label>
                <select id="notenSchluesselTyp" name="notenSchluessel" class="dropDownKlasse">
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
        </div>

        <div class="inputAreaElement">
            <input class="submitNeueKlasse styledButton" type="button" name="neueKlasse" value="Klasse anlegen">
        </div>
    </div>
<?php
Database::getAlleKlassen();
include 'footer.php';
?>