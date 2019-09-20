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
<div class="contentContainer">
    <div class="sectionHeader">Schüler/in anlegen</div>
    <div class="inputArea">
        <form id="Student" class="formElement newStudentForm">
            <label for="schuelerVorname">Vorname:</label>
            <input id="schuelerVorname" class="schuelerVornameInput" type="text" name="student_Firstname" required><br>

            <label for="schuelerNachname">Nachname:</label>
            <input id="schuelerNachname" class="schuelerNachnameInput" type="text" name="student_Lastname" required><br>

            <label for="schuelerGeburtsdatum">Beburtsdag:</label>
            <input id="schuelerGeburtsdatum" class="schuelerGeburtsdatumInput" type="date" name="student_Birthdate" required><br>

            <label for="schuelerEMail">E-Mail:</label>
            <input id="schuelerEMail" class="schuelerEMailInput" type="email" name="student_Email" required><br>

            <label for="schuelerKlasse">Klasse:</label>
            <select id="schuelerKlasse" class="schuelerKlasseInput dropDownItem" name="student_ClassID" required>
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

            <input class="styledButton" type="submit">
        </form>
    </div>

    <div id="editRecord" title="Schüler bearbeiten" style="display: none">
        <form id="Student" class="formElement updateStudentForm">
            <label class="hiddenElement" for="schuelerID">ID:</label>
            <input id="EDITschuelerID" class="schuelerIDInput hiddenElement" type="number" name="studentID" required><br>

            <label for="schuelerVorname">Vorname:</label>
            <input onchange="checkForUpdate()" id="EDITschuelerVorname" class="schuelerVornameInput" type="text" name="student_Firstname" required><br>

            <label for="schuelerNachname">Nachname:</label>
            <input onchange="checkForUpdate()" id="EDITschuelerNachname" class="schuelerNachnameInput" type="text" name="student_Lastname" required><br>

            <label for="schuelerGeburtsdatum">Geburtstag:</label>
            <input onchange="checkForUpdate()" id="EDITschuelerGeburtsdatum" class="schuelerGeburtsdatumInput" type="date" name="student_Birthdate" required><br>

            <label for="schuelerEMail">E-Mail:</label>
            <input onchange="checkForUpdate()" id="EDITschuelerEMail" class="schuelerEMailInput" type="email" name="student_Email" required><br>

            <label for="schuelerKlasse">Klasse:</label>
            <select onchange="checkForUpdate()" id="EDITschuelerKlasse" class="schuelerKlasseInput dropDownItem" name="student_ClassID" required>
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
            <input class="styledButton updateButton" value="ändern" type="submit">
            <input class="styledButton deleteButton" value="löschen" type="button" onclick="return confirm('Schüler wirklich endgültig löschen?')">
        </form>
    </div>

<?php
//Database::getAllStudents();
Database::getAllStudentNodes();

include 'footer.php';
?>