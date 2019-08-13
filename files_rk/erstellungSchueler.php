<?php

include 'headerMenu.php';

/*
echo "// Test create object BenotungsObjekt with parameters: <br>";

$hausaufgabe = new BenotungsObjekt("Sinn von OOP darstellen", 95.45, "2019-10-10", "Hausaufgabe", "Toll umgesetzt", 1);
D::takeDump($hausaufgabe);

echo "<br><br>// Test create student object with paramters and test getter and setter methods: <br>";

echo $schuelerMax->getVorname() . "<br>";
echo $schuelerMax->setVorname("Lennart");
echo $schuelerMax->getVorname() . "<br>";

// create newstudent object in database
$schuelerMax->createStudent();
*/

?>
<!-- TODO: erst SCHULE erstellen, dann KLASSE anlegen, dann LEHRER, dann FACH, dann NOTENOBJEKT und/oder SCHÜLER -->

<div class="contentContainer">

        <div class="sectionHeader">Schüler/in anlegen</div>
        <div class="inputArea">
            <form id="Student" class="formElement">
                <label for="schuelerVorname">Vorname:</label>
                <input id="schuelerVorname" class="schuelerVornameInput" type="text" name="student_Firstname"><br>

                <label for="schuelerNachname">Nachname:</label>
                <input id="schuelerNachname" class="schuelerNachnameInput" type="text" name="student_Lastname"><br>

                <label for="schuelerGeburtsdatum">Beburtsdatum:</label>
                <input id="schuelerGeburtsdatum" class="schuelerGeburtsdatumInput" type="date" name="student_Birthdate"><br>

                <label for="schuelerEMail">E-Mail:</label>
                <input id="schuelerEMail" class="schuelerEMailInput" type="email" name="student_Email"><br>

                <label for="schuelerKlasse">Klasse:</label>
                <select id="schuelerKlasse" class="schuelerKlasseInput dropDownItem" name="student_ClassID">
                    <?php
                        $paraArr=['id_Kurs','kursName'];
                        $meineKlassen = Database::getDatabaseData($paraArr, 'kurs');

                        foreach($meineKlassen as $entry)
                        {
                            echo'<option';
                            foreach($entry as $key => $value)
                            {
                                if($key=='id_Kurs'){
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
                <a class="addNewElementButton" title="weitere Klasse erstellen" href="erstellungKlasse.php">+</a><br>

                <input class="submitNewStudent styledButton" type="submit" value="Schüler/in anlegen" name="Student">
            </form>
        </div>

    <div>
        <table class="studentTable"> <!-- tabelle automatisch durch query auslesen und entsprechend erstellen-->
            <thead>
                <tr class="tableHead">
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Geburtsdatum</th>
                    <th>E-Mail</th>
                    <th>Klasse</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    Database::getAllStudents();  // array zurückgeben
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php

include 'footer.php';

?>