<?php
session_start();
include "../storescripts/connect_to_mysql.php";
if (isset($_GET['resid'])) {
    $resid = mysql_real_escape_string($_GET['resid']);
    $status = mysql_real_escape_string($_GET['status']);
    $sql = mysql_query("SELECT resid FROM reservation");
    $sql = mysql_query("UPDATE reservation SET status='Cancel' WHERE resid='$resid'") or die (mysql_error());
    header("location:orders.php");
}
else {
    echo 'Sorry, order not exist';
    echo "<a href='javascript:history.go(-1)'>Back</a>";

}

?>
