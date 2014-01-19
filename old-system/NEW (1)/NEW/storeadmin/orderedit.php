<?php

session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php");
    exit();
}
$adminID = preg_replace('#[^0-9]#i', '', $_SESSION["adminID"]);
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]);
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);


include "../storescripts/connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM admin WHERE id='$adminID' AND username='$manager' AND password='$password' LIMIT 1");

$existCount = mysql_num_rows($sql);
if ($existCount == 1) {
    header("location: admin_login.php");
    exit();
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
if (isset($_POST['status'])) {


    $resid = mysql_real_escape_string($_POST['thisID']);

    $status = mysql_real_escape_string($_POST['status']);
    $sql = mysql_query("UPDATE reservation SET status='$status' WHERE resid='$resid'");

    header("location: manageorders.php");
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
$statuslist="";
$sql = mysql_query("SELECT * FROM orderstatus");
$statusCount = mysql_num_rows($sql); // count the output amount
if ($statusCount > 0) {
    while($row = mysql_fetch_array($sql)){



        $orderstatus = $row["status"];
        $statuslist .='<option value="'.$orderstatus.'">'.$orderstatus.'</option>';

    }
} else {

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
         <li><a href="manage'.$catname.'.php"><span>'.$catname.'</span></a></li>

    ';
    }
} else {
    $category = "You have no category listed in your store yet";
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
         <li><a href="packageEdit.php?packID='.$packID.'"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>
<html>


<head>
    <link rel="shortcut icon" href="images/icon.ico" >
    <title>Keanna's Flower Shop</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" />
</head>


<body>
<div align="center" id="mainWrapper">
    <div class = "banner">
    </div>

    <div id='cssmenu'>
        <ul>
            <li><a href='index.php'><span>Home</span></a></li>
            <li class='has-sub'><a href='manageorders.php'><span>Orders</span></a>

            </li>
            <li class='has-sub'><a href='inventory_list.php'><span>Product</span></a>
                <ul>
                    <?php echo $category2 ?>
                    <li class='has-sub last'><a href='manageCat.php'><span>Edit Categories</span></a>
                </ul>
            </li>
            <li><a href='Package.php'><span>Packages</span></a>
                <ul>
                    <?php echo $package2 ?>
                    <li class='has-sub last'><a href='addPack.php'><span>Add Package</span></a>

                </ul>

            </li>

            <li class='has-sub last'><a href='advertisement.php'><span>Advertisement</span></a>
            </li>
            <li class='has-sub last'><a href='logout.php'><span>Logout</span></a>
            </li>
        </ul>
    </div>
    </br>

    <div class = "ordercontent">




        <div id="pageContent">
            <div align="left" style="margin-left:24px;">
                <div align="left" style="margin-left:24px;">
                    <h2><?php echo $senderfname;  ?></h2>Current Status: <b><?php echo $status;  ?></b>


                </div>
                <hr />

                <h3>

                </h3>
                <form action="orderedit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
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
                                <?php echo $receivername; ?>
                            </label></td>
                        </tr>
                        <tr>
                            <td align="right"><b>Time of Delivery:&nbsp;</b></td>
                            <td><label>
                                <?php echo $timetodeliver; ?>
                            </label></td>
                        </tr>
                        <tr>
                            <td align="right"><b>Address to Deliver:&nbsp;</b></td>
                            <td><label>
                                <?php echo $receiveradd; ?>
                            </label></td>
                        </tr>
                        <tr>
                            <td align="right"><b>Card Message:&nbsp;</b></td>
                            <td><label>
                                <?php echo $cardmessage; ?>
                            </label></td>
                        </tr>




                        <tr>
                            <td align="right"><b>Status:&nbsp;</b></td>
                            <td><label>
                                <select name="status" id="status">

                                    <?php echo $statuslist; ?>

                                </select>
                            </label></td>
                        </tr>

                        <tr>

                            <td>
                                <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                                <input type="submit" name="button" id="button" value="Change Order Status" />
                            </td>
                        </tr>





                        </tr>


                    </table>
                    <br />
                    <br />
            </div>
            </div>
            <br />
            <br />
            <br />
        </div>




    </div>

    <br>






    <div class = "">

    </div></div>
</body>

</html>