<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include_once '../ajaxNode.php';
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../functions.js"></script>
    <title>Schülerverwaltung</title>
</head>

<body>
<form id="list" method="post" action="liste.php">
    <label for="data">Daten des Schülers</label>
    <input class="test" type="text" name="name" autocomplete="off" autofocus id="name">
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

<p>Hier stehen (hoffentlich irgendwann) alle Schüler:</p>
<?php
//$liste = unserialize($_SESSION['liste']);
//echo "<pre>";
//var_dump($liste);
//echo "</pre>";
if (isset($_POST['senden'])) {
    $test = $_POST['liste'];
    $liste = new DoublyLinkedList();
    $liste->readList();
    $_SESSION['liste'] = serialize($liste);
    unset($_POST['submit']);
}

if (isset($_POST['delete'])) {
    $liste = unserialize($_SESSION['liste']);
    $data = $_POST['data'];
    $liste->deleteNode($data);
    $liste->readList();
    $_SESSION['liste'] = serialize($liste);
}

if (isset($_POST['submit'])) {
    $liste = unserialize($_SESSION['liste']);
    $name = $_POST['name'];
    $schueler = new Schueler($name);
    $liste->add($schueler);
    $liste->readList();
    $_SESSION['liste'] = serialize($liste);
}

if (array_key_exists('listData', $_POST)) {
    $liste = unserialize($_SESSION['liste']);
    $liste->readList();
    $_SESSION['liste'] = serialize($liste);
}

if (array_key_exists('reverseListData', $_POST)) {
    $liste = unserialize($_SESSION['liste']);
    $liste->reverseReadList();
    $_SESSION['liste'] = serialize($liste);
}

if (array_key_exists('resetList', $_POST)) {
    $liste = unserialize($_SESSION['liste']);
    $liste->resetList();
    $liste->readList();
    $_SESSION['liste'] = serialize($liste);
}
?>
</body>
