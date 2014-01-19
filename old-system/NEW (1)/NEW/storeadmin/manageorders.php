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
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete order with ID of ' . $_GET['deleteid'] . '? <a href="manageorders.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    // remove item from system and delete its picture
    // delete from database
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysql_query("DELETE FROM reservation WHERE resid='$id_to_delete' LIMIT 1") or die (mysql_error());

    header("location: manageorders.php");
    exit();
}
?>

<?php
$order_list = "";
$sql = mysql_query("SELECT * FROM reservation ORDER BY date_added DESC");
$orderCount = mysql_num_rows($sql); // count the output amount
if ($orderCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $resid = $row["resid"];
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
        $status = $row["status"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));


        $order_list .= '<table width="100%" border="1" cellspacing="0" cellpadding="6" bordercolor="#FFFFFF" frame="below" rules="fixed">
          <tr>


          <td width="20%" align="center"><a href="orderedit.php?resid='.$resid.'"><small>' . $resid. '</small> </a> </td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$senderfname.'</small> </a></td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$status.'</small></a></td>
          </td><td width="20%" align="center"> <a href="manageorders.php?deleteid='.$resid.'"><small><img src="../style/delete.png"  width="40" height="40"  /></small></a></td>

          </tr>
      </table>';
    }
} else {
    $order_list = "You have no orders listed in your store yet.";
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

    <div class = "content2">

        <h2>Order list</h2>
        <table width="100%" border="1" cellspacing="0" cellpadding="6" bordercolor="#FFFFFF" frame="below" rules="fixed">
            <tr>


                <td width="20%" align="center"><strong>Reservation ID</strong></td>
                <td width="20%" align="center"><strong>Sender's Name</strong>  </td>
                <td width="20%" align="center"><strong>Status</strong></td>


                <td width="20%" align="center"><strong>DELETING ORDER</strong></td>
                <div style="border:#FFFFFF 1px solid"></div></a></td>
            </tr>
        </table>
        <?php
        echo $order_list;
        ?>



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