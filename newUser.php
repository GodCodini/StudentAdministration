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


if (isset($_GET["signup"])) {
    if ($_GET["signup"] == "success") {
        echo "<span class='succsess'>Lehrer erfolgreich angelegt.</span><br><br>";
    }
    elseif ($_GET["signup"] == "error")
    {
        echo "<span class='error'>Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.</span><br><br>";
    }
}

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $bday = $_POST['bday'];
    $priv = $_POST['priv'];
    $short = $_POST['short'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $hashPW = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO teacher (FirstName, LastName, Birthday, privileg, short, login, password, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $PDO->prepare($sql);
    $result->execute(array($firstName, $lastName, $bday, $priv, $short, $username, $hashPW, $email));
    $resultedRows = $result->rowCount();

    if ($resultedRows > 0)
    {
        header('Location: newUser.php?signup=success');
    }
    else
    {
        header('Location: newUser.php?signup=error');
    }
}
?>
<div class="centerThis">
    <form class="form-style-7" method="post" action="">
        <ul>
            <li>
                <label for="name">Vorname</label>
                <input type="text" name="firstName" autocomplete="off" pattern="^[A-Za-zÖöÄäÜüß -]*$" autofocus id="firstName">
                <span>Geben Sie den Vornamen ein</span>
            </li>
            <li>
                <label for="name">Nachname</label>
                <input type="text" name="lastName" autocomplete="off" pattern="^[A-Za-zßÜüÖöäÄ-]*$" autofocus id="lastName">
                <span>Geben Sie den Nachnamen ein</span>
            </li>
            <li>
                <label for="name">Geburtstag</label>
                <input type="date" name="bday" autocomplete="off" id="bday">
                <span>Geben Sie das Geburtsdatum ein</span>
            </li>
            <li>
                <label for="name">Rechte</label>
                <select class="neueKlasseInput" name="priv" id="priv">
                    <?php
                    $sql = "SELECT id_privileg, privName FROM privileg";
                    foreach ($PDO->query($sql) as $row)
                    {
                        if ($row['privName'] != "KLASSENLEHRER")
                            {
                                echo "<option value='".$row['id_privileg']."'>".$row['privName']."</option>";
                            }
                    }
                    ?>
                </select>
                <span>Geben Sie die Rechte an</span>
            </li>
            <li>
                <label for="name">Kürzel</label>
                <input type="text" name="short" autocomplete="off" id="short">
                <span>Geben Sie das Kürzel ein</span>
            </li>
            <li>
                <label for="name">Loginname</label>
                <input type="text" name="username" autocomplete="off" id="username">
                <span>Geben Sie den Loginnamen an</span>
            </li>
            <li>
                <label for="name">Passwort</label>
                <input type="password" name="password" autocomplete="off" id="password">
                <span>Geben Sie das Passwort an</span>
            </li>
            <li>
                <label for="name">Email</label>
                <input type="email" name="email" autocomplete="off" id="email">
                <span>Geben Sie die Email an</span>
            </li>
            <li>
                <input type="submit" name="submit" value="Lehrer eintragen">
            </li>
        </ul>
    </form>
</div>
