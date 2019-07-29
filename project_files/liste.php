<?php
session_start();
include_once '../ajaxNode.php';
if (isset($_POST['senden'])) {
   $test = $_POST['liste'];
   $liste = new DoublyLinkedList();
   $_SESSION['liste'] = serialize($liste);
   unset($_POST['submit']);
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../functions.js"></script>
</head>

<body>
<form id="list" method="post" action="liste.php">
    <label for="data">Daten fürn Knoten</label>
    <input class="test" type="text" name="name" autocomplete="off" autofocus id="name">
    <input type="submit" name="submit" value="Senden">
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
