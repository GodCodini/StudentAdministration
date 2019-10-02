<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include_once 'includes/DoublyLinkedList.php';
include_once 'includes/Student.php';
include_once 'includes/Element.php';
include_once 'functions/listHelper.php';
include_once '../project_files/_config.php';
//$pw = $_COOKIE['password'];
//$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');
//$redirect_after_login = './liste.php';
//
//$sql = "SELECT (aktuellesPW) FROM passwort";
//$statement = $pdo->query($sql);
//$result = $statement->fetch(PDO::FETCH_ASSOC);
//$aktuellesPW = $result['aktuellesPW'];
//
//if (isset($_GET['succsess'])) {
//    if ($_GET['succsess'] == "pwupdated") {
//        $remember_password = strtotime('+1 days');
//        $sql = "SELECT (aktuellesPW) FROM passwort";
//        $statement = $pdo->query($sql);
//        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        $aktuellePW = $result['aktuellesPW'];
//        setcookie("password", $aktuellePW, $remember_password);
//        header('Refresh:5;url=./admin.php?succsess=pwupdate');
//    }
//} elseif (empty($_COOKIE['password'])) {
//    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
//    header('Location: ./login.php');
//    exit;
//} elseif ($pw != $aktuellesPW) {
//    header('Location: ./login.php');
//    exit;
//}

//NEUE LISTE ANLEGEN
if (isset($_POST['senden'])) {
    $name = $_POST['liste'];
    $gradeKey = $_POST['gradeKey'];

    createList($name, $gradeKey);
}

?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../functions.js"></script>
    <title>Schülerverwaltung</title>
</head>

<body>
<form action="liste.php" method="post">
    <label for="data">Daten für die Liste</label>
    <input class="test" type="text" name="liste" id="listenname">
    <input type="submit" name="senden" value="Senden">
</form>
<!-- NEUEN SCHÜLER ANLEGEN -->
<form id="list" method="post" action="liste.php">
    <label for="data">Vorname</label>
    <input class="test" type="text" name="firstName" autocomplete="off" autofocus id="firstName">
    <label for="data">Nachname</label>
    <input class="test" type="text" name="lastName" autocomplete="off" id="lastName">
    <label for="data">Geburtstdatum</label>
    <input class="test" type="date" name="bday" autocomplete="off" id="bday">
    <select name="klasse" id="klasse">
        <?php
        $PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);
        $sql = "SELECT id_kurs, Name FROM kurs";

        foreach ($PDO->query($sql) as $key=>$val)
        {
            echo "<option value='".$key."'>".$val."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Senden">
</form>

<form id="delete" method="post" action="liste.php">
    <label>Daten löschen</label>
    <input class="test" type="text" name="data" autocomplete="off" id="delete">
    <input type="submit" name="delete" value="Löschen">
</form>

<form id="readList" method="post">
    <input type="submit" name="listData" value="Liste ausgeben">
</form>

<form id="reverseList" method="post">
    <input type="submit" name="reverseListData" value="Liste anders ausgeben">
</form>

<form id="resetList" method="post">
    <input type="submit" name="resetList" value="Liste resetten">
</form>

<form action="" method="post">
    <select name="klasse" id="klasse">
        <?php
        foreach ($_SESSION as $key=>$val)
        {
            if ($key !== "name") {
                echo "<option value='".$key."'>".$key."</option>";
            }

        }
        ?>
    </select>
    <input type="submit" name="laden" value="Laden">
</form>

<p>Hier stehen (hoffentlich irgendwann) alle Schüler:</p>
<?php
//LISTE LADEN/FESTLEGEN
if (isset($_POST['laden'])) {
    $listName = $_POST['klasse'];
    $_SESSION['name'] = $listName;
    $liste = unserialize($_SESSION[$listName]);
    $liste->readList();
}

//KNOTEN LÖSCHEN
if (isset($_POST['delete'])) {
    $data = $_POST['data'];
    $name = $_SESSION['name'];
    delete($data, $name);
}
//NEUEN SCHÜLER HINZUFÜGEN
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $bday = $_POST['bday'];
    $class = $_POST['class'];
    $listNa = $_SESSION['name'];
    addStudent($firstName, $lastName, $bday, $class, $listNa);
}
//LISTE AUSGEBEN
if (array_key_exists('listData', $_POST)) {
    listHelperData();
}
//LISTE VERKEHRT AUSGEBEN
if (array_key_exists('reverseListData', $_POST)) {
    listHelperReverse();
}
//LISTE ZURÜCKSETZEN
if (array_key_exists('resetList', $_POST)) {
    listReset();
}

//echo "<h3> PHP List All Session Variables</h3>";
//foreach ($_SESSION as $key=>$val)
//    if ($key !== "name") {
//        echo $key.", Val: ".$val."<br/>";
//    }

?>
</body>