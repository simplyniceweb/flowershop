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

$sql = mysql_query("SELECT * FROM user WHERE username='$myusername' AND password='$mypassword' LIMIT 1");
$userCount = mysql_num_rows($sql);
if ($userCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $userid = $row["userid"];
        $username = $row["username"];
        $bdate = $row["bdate"];
        $fname = $row["fname"];
        $email = $row["email"];
        $contact= $row["contact"];
        $address= $row["address"];

    }
} else {
    $user_list = "Please Login!";
}
?>
<?php

$sql = mysql_query("SELECT * FROM products");
$userCount = mysql_num_rows($sql);
if ($userCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $pid = $row["pid"];
        $product_name = $row["product_name"];
        $price = $row["price"];
        $productdesc = $row["details"];


    }
} else {
    $user_list = "Please Login!";
}
?>
<?php
include "securimage/securimage.php";

$securimage = new Securimage();

if ($securimage->check($_POST['ct_captcha']) == false) {

    // or you can use the following code if there is no validation or you do not know how

    echo "The security code entered was incorrect.<br /><br />";

    echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";

    exit;

}


?>

<?php
if (isset($_POST['accept'])) {
    $resid=$_POST['resid'];

    $receivername = mysql_real_escape_string($_POST['receivername']);
    $receiverno = mysql_real_escape_string($_POST['receiverno']);
    $date = mysql_real_escape_string($_POST['date']);
    $time = mysql_real_escape_string($_POST['time']);
    $receiveradd = mysql_real_escape_string($_POST['receiveradd']);
    $cardmessage = mysql_real_escape_string($_POST['cardmessage']);
    $sql = mysql_query("INSERT INTO reservation (resid,senderusername,senderfname,sendercontact,senderemail,receivername,receivercontact,datetodeliver,timetodeliver,receiveradd,cardmessage,pid,product_name,productdesc,price,date_added,status)
        VALUES('$resid','$username','$fname','$contact','$email','$receivername','$receiverno','$date','$time','$receiveradd','$cardmessage','$pid','$product_name','$productdesc','$price',now(),'Pending')") or die (mysql_error());

  header('location:viewbill.php?resid='.$resid);
}
else {
    echo '<p>If you wish to place an order, please accept the <a href="Terms%20and%20conditions.php">Terms and Conditions </a>by checking<br />
  the box. We reserve the right to refuse any order at our sole discretion and will refund<br /> the fee<br></p>';
    echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";

}

?>

















