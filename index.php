<?php
session_start();
include_once './ajaxNode.php';


?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--<link rel="stylesheet" href="style/styles.css">-->

    <script type="text/javascript" src="functions.js"></script>

</head>

<body>
<form action="./project_files/liste.php" method="post">
    <label for="data">Daten für die Liste</label>
    <input class="test" type="text" name="liste" id="listenname">
    <input type="submit" name="submit" value="Senden">
    </form>
    <br><br><br>

<?php



if (isset($_POST['liste'])) {
    $test = $_POST['liste'];
    $liste = new DoublyLinkedList();
    $_SESSION['liste'] = $liste;
}

?>
</body>
