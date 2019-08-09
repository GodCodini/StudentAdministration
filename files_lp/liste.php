<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include_once './ajaxNode.php';
include_once './listHelper.php';
$pw = $_COOKIE['password'];
$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');
$redirect_after_login = './liste.php';

$sql = "SELECT (aktuellesPW) FROM passwort";
$statement = $pdo->query($sql);
$result = $statement->fetch(PDO::FETCH_ASSOC);
$aktuellesPW = $result['aktuellesPW'];

if (isset($_GET['succsess'])) {
    if ($_GET['succsess'] == "pwupdated") {
        $remember_password = strtotime('+1 days');
        $sql = "SELECT (aktuellesPW) FROM passwort";
        $statement = $pdo->query($sql);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $aktuellePW = $result['aktuellesPW'];
        setcookie("password", $aktuellePW, $remember_password);
        header('Refresh:5;url=./admin.php?succsess=pwupdate');
    }
} elseif (empty($_COOKIE['password'])) {
    //Wenn der Cookie leer ist oder das falsche Passwort hat, redirect zur login.php
    header('Location: ./login.php');
    exit;
} elseif ($pw != $aktuellesPW) {
    header('Location: ./login.php');
    exit;
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

<form action="" method="post">
    <select name="klasse" id="klasse">
        <?php
        foreach ($_SESSION as $key=>$val)
        {
            echo "<option value='".$key."'>".$key."</option>";
        }
        ?>
    </select>
    <input type="submit" name="laden" value="Laden">
</form>

<p>Hier stehen (hoffentlich irgendwann) alle Schüler:</p>
<?php
$name = $_SESSION['name'];
function setListName($listName) {
    global $name;
    $name = $listName;
    $_SESSION['name'] = $name;
}

if (isset($_POST['laden'])) {
    $listName = $_POST['klasse'];
    setListName($listName);
}
var_dump($GLOBALS['name']);
if (isset($_POST['senden'])) {
    $name = $_POST['liste'];
    listHelper::createList($name);
    unset($_POST['submit']);
}

if (isset($_POST['delete'])) {
    $data = $_POST['data'];
    listHelper::delete($data);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    listHelper::addStudent($name);
}

if (array_key_exists('listData', $_POST)) {
    listHelper::listHelperData();
}

if (array_key_exists('reverseListData', $_POST)) {
    listHelper::listHelperReverse();
}

if (array_key_exists('resetList', $_POST)) {
    listHelper::listReset();
}



echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key=>$val)
    echo $key.", Val: ".$val."<br/>";
?>
</body>
