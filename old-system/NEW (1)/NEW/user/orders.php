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
$order_list = "";
$sql = mysql_query("SELECT * FROM reservation WHERE senderusername='$myusername' ORDER BY date_added DESC");
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


          <td width="20%" align="center"><a href="orderedit.php?resid='.$resid.'"><small>' . $product_name. '</small> </a> </td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$receivername.'</small> </a></td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$timetodeliver.'</small> </a></td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$datetodeliver.'</small> </a></td>
          <td width="20%"  align="center"><a href="orderedit.php?resid='.$resid.'"><small>'.$status.'</small></a></td>
          </td>

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

</div>
</br>

<div class = "content1">
    <table width="100%" border="1" cellspacing="0" cellpadding="6" bordercolor="#FFFFFF" frame="below" rules="fixed">
        <tr>


            <td width="20%" align="center"><strong>Product name</strong></td>
            <td width="20%" align="center"><strong>Receiver's name</strong>  </td>
            <td width="20%" align="center"><strong>Time to deliver</strong></td>
            <td width="20%" align="center"><strong>Date to deliver</strong>  </td>
            <td width="20%" align="center"><strong>Status</strong></td>



            </a></td>
        </tr>
    </table>
    <?php
echo $order_list
    ?>





</div>

<br>






<div class = "">

</div>
</body>

</html>