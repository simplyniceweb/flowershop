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
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
if (isset($_POST['receivername'])) {

    $resid = mysql_real_escape_string($_POST['thisID']);
    $receivername = mysql_real_escape_string($_POST['receivername']);
    $timetodeliver= mysql_real_escape_string($_POST['time']);
    $datetodeliver = mysql_real_escape_string($_POST['date']);
    $receiveradd = mysql_real_escape_string($_POST['receiveradd']);
    $cardmessage = mysql_real_escape_string($_POST['cardmessage']);
    $sql = mysql_query("UPDATE reservation SET receivername='$receivername', timetodeliver='$timetodeliver', datetodeliver='$datetodeliver',receiveradd='$receiveradd', cardmessage='$cardmessage' WHERE resid='$resid'");

    header("location: orderedit.php?resid=$resid");
    exit();
}
?>
<?php
if (isset($_GET['resid'])) {
    $targetID = $_GET['resid'];
    $sql = mysql_query("SELECT * FROM reservation WHERE resid='$targetID' LIMIT 1");
    $orderCount = mysql_num_rows($sql);
    if ($orderCount > 0) {
        while($row = mysql_fetch_array($sql)){

            $resid=$row["resid"];
            $senderusername = $row["senderusername"];
            $senderfname = $row["senderfname"];
            $senderemail = $row["senderemail"];
            $receivername = $row["receivername"];
            $receivercontact = $row["receivercontact"];
            $receiveradd = $row["receiveradd"];
            $timetodeliver = $row["timetodeliver"];
            $datetodeliver = $row["datetodeliver"];
            $pid = $row["pid"];
            $product_name = $row["product_name"];
            $productdesc = $row["productdesc"];
            $cardmessage = $row["cardmessage"];
            $status = $row["status"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));



        }
    } else {
        echo "Sorry dude that crap dont exist.";
        exit();
    }
}

?>

<?php
$category2 = "";
$sql = mysql_query("SELECT * FROM category ORDER BY catname ASC");
$categoryCount = mysql_num_rows($sql);
if ($categoryCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $catid = $row["catid"];
        $catname = $row["catname"];
        $catdesc = $row["catdesc"];
        $category2 .= '
         <li><a href="'.$catname.'.php"><span>'.$catname.'</span></a></li>

    ';
    }
} else {
    $category2 = "You have no category listed in your store yet";
}

?>
<?php
$package2 = "";
$sql = mysql_query("SELECT * FROM packages ORDER BY packagename ASC");
$packageCount = mysql_num_rows($sql);
if ($packageCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $packID = $row["packID"];
        $packagename = $row["packagename"];
        $packagedesc = $row["packagedesc"];
        $package2 .= '
         <li><a href="packages.php?packID='.$packID.'"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>







<html>
<head>
    <link rel="shortcut icon" href="../images/icon.ico" >
    <title>Keanna's Flower Shop</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" />
</head>


<body>
<div class = "banner">
</div>

<div id='cssmenu'>
    <ul>
        <li><a href='index.php'><span>Home</span></a></li>
        <li><a href='orders.php'><span>My Orders</span></a>

        </li>
        <li class='has-sub'><a href='allproducts.php'><span>Product</span></a>
            <ul>
                <?php echo $category2 ?>
            </ul>
        </li>
        </li>
        <li><a href='#'><span>Packages</span></a>
            <ul>
                <?php echo $package2 ?>

            </ul>

        </li>
        <li class='has-sub'><a href='#'><span>Company</span></a>
            <ul>
                <li><a href='about.php'><span>About</span></a></li>
                <li><a href='location.php'><span>Location</span></a></li>
                <li class='last'><a href='terms.php'><span>Terms and Conditions</span></a></li>
            </ul>
        </li>

        <li><a href='contact.php'><span>Contact</span></a></li>
        <li class='has-sub last'><a href='logout.php'><span>Logout</span></a>

        </li>
    </ul>
</div>
</br>

<div class = "content2">

    <div id="pageContent"><br />

        <div align="left" style="margin-left:24px;">
            <h2><?php echo $senderfname;  ?></h2>Current Status: <b><?php echo $status;  ?></b>


        </div>
        <hr />

        <h3>

        </h3>
        <form action="rescheduleorder.php"  name="myForm" id="myform" method="post">
            <table width="90%" border="0" cellspacing="0" cellpadding="6">
                <tr>
                    <td width="20%" align="right"><b>Sender's Name:&nbsp;</b></td>
                    <td width="80%"><label>
                        <?php echo $senderfname; ?>
                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Email:&nbsp;</b></td>
                    <td><label>
                        <?php echo $senderemail; ?>
                    </label></td>
                </tr>
                <tr>

                    <td align="right"><b>Product Image:&nbsp;</b></td>
                    <td><label>
                        <img src="../inventory_images/<?php echo $pid; ?>.jpg" width="100" style="border:#FFFFFF 1px solid;" height="100" alt="<?php echo $product_name; ?>" />

                    </label></td>
                </tr>

                <tr>

                    <td align="right"><b>Ordered Product:&nbsp;</b></td>
                    <td><label>
                        <?php echo $product_name; ?>
                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Description:&nbsp;</b></td>
                    <td><label>
                        <?php echo $productdesc; ?>
                    </label></td>
                </tr>

                <tr>
                    <td align="right"><b>Receiver's Name:&nbsp;</b></td>
                    <td><label>
                        <input type="text" name="receivername" value="<?php echo $receivername; ?>" >
                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Time of Delivery:&nbsp;</b></td>
                    <td><label>
                        <input type="time" name="time" value="<?php echo $timetodeliver; ?>" >

                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Date of Delivery:&nbsp;</b></td>
                    <td><label>
                        <input type="date" name="date" value="<?php echo $datetodeliver; ?>" >

                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Address to Deliver:&nbsp;</b></td>
                    <td><label>
                        <textarea name="receiveradd" cols="50" rows="4"><?php echo $receiveradd; ?></textarea>
                    </label></td>
                </tr>
                <tr>
                    <td align="right"><b>Card Message:&nbsp;</b></td>
                    <td><label>
                        <textarea name="cardmessage" cols="50" rows="4"><?php echo $cardmessage; ?></textarea>
                    </label></td>
                </tr>





                <tr>
                    <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                <td><input type="submit" name="button" id="button" value="Make Changes" /></td>
                </tr>




                </tr>


            </table>
            <br />
            <br />
    </div>




</div>

<br>






<div class = "">

</div>
</body>

</html>