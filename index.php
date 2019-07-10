<?php
include_once './ajaxNode.php';


?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--<link rel="stylesheet" href="style/styles.css">-->

    <script type="text/javascript" src="functions.js"></script>

</head>

<body>

<form action="./index.php" onsubmit="return false;" method="post">
    <label for="data">Daten für die Liste</label>
    <input class="test" type="text" name="liste" id="listenname">
    <button onclick="listElement()">Senden</button>
</form>

<form action="./index.php" onsubmit="return false;" method="post">
    <label for="data">Daten fürn Knoten</label>
    <input class="test" type="text" name="data" id="name">
    <button onclick="nodeElement()">Senden</button>
</form>

<p>Hier stehen (hoffentlich irgendwann) alle Schüler:</p>
<?php



if (isset($_POST['liste'])) {
    $test = $_POST['liste'];
    $liste = new DoublyLinkedList();
}

if (isset($_POST['data'])) {
    $name = $_POST['data'];
    $schueler = new Schueler($name);
    $liste->add($schueler);
    $liste->readList();
}
?>
</body>
