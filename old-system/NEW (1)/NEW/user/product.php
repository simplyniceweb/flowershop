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
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['pid'])) {
    // Connect to the MySQL database
    include "../storescripts/connect_to_mysql.php";
    $pid = preg_replace('#[^0-9]#i', '', $_GET['pid']);
    // Use this var to check to see if this ID exists, if yes then get the product
    // details, if no then exit this script and give message why
    $sql = mysql_query("SELECT * FROM products WHERE pid='$pid' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
        // get all the product details
        while($row = mysql_fetch_array($sql)){
            $product_name = $row["product_name"];
            $price = $row["price"];
            $details = $row["details"];
            $category = $row["category"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }

    } else {
        echo "That item does not exist.";
        exit();
    }

} else {
    echo "Data to render this page is missing.";
    exit();
}
mysql_close();
?>


<?php
include "../storescripts/connect_to_mysql.php";

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
include "../storescripts/connect_to_mysql.php";

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
<div align="center" id="mainWrapper">
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

    <div class = "product">
        <table width="100%" border="0" cellspacing="0" cellpadding="40">
            <tr>
                <td width="19%" valign="top" align="center"><p><img src="../inventory_images/<?php echo $pid; ?>.jpg" width="250" style="border:#FFFFFF 1px solid;" height="250" alt="<?php echo $product_name; ?>" /><br />

                    <a href="../inventory_images/<?php echo $pid; ?>.jpg" target="_blank"></a></p>
                </td>
                <td width="81%" valign="top"><h3><?php echo"<b>Product Name:&nbsp;</b>" .$product_name; ?></h3>
                    <p><?php echo "<b>Price:</b> Php.&nbsp;".$price; ?><br />
                        <br />
                        <?php echo"<b>Category:&nbsp;</b>" .$category; ?> <br />
                        <br />
                        <?php echo"<b>Description:&nbsp;</b>" .$details; ?>
                        <br />
                    </p>
                    <form id="form1" name="form1" method="post" action="reservation.php">
                        <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>" />
                        <input type="submit" name="button" id="button" value="Order now" />
                    </form>      </td>
            </tr>

        </table>



        <div class = "footer">

        </div>





    </div>

    <br>






    <div class = "">
    </div>
</div>
</body>

</html>