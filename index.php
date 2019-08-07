<?php
session_start();
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="functions.js"></script>
</head>

<body>
<form action="./project_files/liste.php" method="post">
    <label for="data">Daten für die Liste</label>
    <input class="test" type="text" name="liste" id="listenname">
    <input type="submit" name="senden" value="Senden">
    </form>
</body>
