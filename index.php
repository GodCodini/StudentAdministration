<?php
//$pw = $_COOKIE['password'];
//$pdo = new PDO('mysql:host=localhost;dbname=schuelerverwaltung', 'root', '');$redirect_after_login = 'files_lp/liste.php';
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
//    header('Location: files_lp/login.php');
//    exit;
//} elseif ($pw != $aktuellesPW) {
//    header('Location: files_lp/login.php');
//    exit;
//} else {
//    header("Location: files_lp/liste.php");
//}
require_once 'project_files/Database.php';
require_once 'project_files/_config.php';
include_once 'files_lp/ui/header.php';

$PDO = DB::load(DBHOST, DBNAME, DBUSERNAME, DBPASSWORD);

if (isset($_GET['id'])) {
    $kurs = $_GET['id'];
    listHelper::buildList($kurs);
    $liste = unserialize($_SESSION[$kurs]);
    $array = $liste->readList();
    var_dump($array);
}
else {
    $sql = "SELECT Name FROM kurs";
    $result = $PDO->query($sql);
?>

    <table id="myTable">
        <th>Klasse</th>

        <?php
        foreach ($result as $item) {
            echo "<tr>";
            echo "<td>";
            echo "<a href='index.php?id=" . $item['Name'] . "'>" . $item['Name'] . "</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>

<?php
}