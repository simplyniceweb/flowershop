<?php

session_start();
if (!isset($_SESSION["myusername"])) {
    header("location: login.php");
    exit();
}
$userID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);
$myusername = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["myusername"]);
$mypassword = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["mypassword"]);


include "../storescripts/connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM user WHERE userid='$userID' AND username='$myusername' AND password='$mypassword' LIMIT 1");

$existCount = mysql_num_rows($sql);
if ($existCount == 1) {
    header("location: login.php");
    exit();
}
?>
<?php
if (isset($_GET['refnumber'])) {
    $resid=$_GET['resid'];

    $refnumber = mysql_real_escape_string($_GET['refnumber']);

    mysql_query("UPDATE reservation SET refnumber='$refnumber', status='Processing' WHERE resid='$resid'") or die (mysql_error());

 header('location:orders.php');
}
else {

}

?>