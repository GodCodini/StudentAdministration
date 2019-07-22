<?php
session_start();
include_once '../ajaxNode.php';
if (isset($_POST['submit'])) {
   $test = $_POST['liste'];
   $liste = new DoublyLinkedList();
}

?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--<link rel="stylesheet" href="style/styles.css">-->

    <script type="text/javascript" src="../functions.js"></script>

</head>

<body>
    <label for="data">Daten fürn Knoten</label>
    <input class="test" type="text" name="data" id="name">
    <button onclick="nodeElement()">Senden</button>

<p>Hier stehen (hoffentlich irgendwann) alle Schüler:</p>
<?php
$liste->readList();
//POST wird nicht richtig abgefangen. AJAX ist doch irgendwie komisch alla.
if (isset($_POST['data'])) {
    $name = $_POST['data'];
    $schueler = new Schueler($name);
    $liste->add($schueler);
    var_dump($liste);
    $liste->readList();
}
?>
</body>
