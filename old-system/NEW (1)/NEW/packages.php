<?php
session_start();
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['packID'])) {
    // Connect to the MySQL database
    include "storescripts/connect_to_mysql.php";
    $packID = preg_replace('#[^0-9]#i', '', $_GET['packID']);
    // Use this var to check to see if this ID exists, if yes then get the product
    // details, if no then exit this script and give message why
    $sql = mysql_query("SELECT * FROM packages WHERE packID='$packID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
        // get all the product details
        while($row = mysql_fetch_array($sql)){
            $packagename = $row["packagename"];
            $packagedesc = $row["packagedesc"];
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
include "storescripts/connect_to_mysql.php";

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
include "storescripts/connect_to_mysql.php";

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
<link rel="shortcut icon" href="images/icon.ico" >
<title>Keanna's Flower Shop</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" />
</head>


<body>
<div class = "banner">
</div>

<div id='cssmenu'>
    <ul>
        <li><a href='index.php'><span>Home</span></a></li>
        <li class='has-sub'><a href='allproducts.php'><span>Product</span></a>
            <ul>
                <?php echo $category2 ?>
            </ul>
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
        <li class='has-sub last'><a href='#'><span>Log-in</span></a>
            <ul>
                <li><a href='user/signup.php'><span>Sign-up</span></a></li>
                <li class='last'><a href='user/login.php'><span>Log in</span></a></li>
            </ul>
        </li>
    </ul>
</div>

</br>

<div class = "content1">


    <table width="100%" border="0" cellspacing="0" cellpadding="40">
        <tr>
            <td width="19%" valign="top" align="center"><p><img src="package_images/<?php echo $packID; ?>.jpg" width="250" style="border:#FFFFFF 1px solid;" height="250" alt="<?php echo $product_name; ?>" /><br />

                <a href="package_images/<?php echo $packID; ?>.jpg" target="_blank"></a></p>
            </td>
            <td width="81%" valign="top"><h3><?php echo"<b>Package Name:&nbsp;</b>" .$packagename; ?></h3>
                <p>
                    <?php echo"<b>Package Description:&nbsp;</b>" .$packagedesc; ?>
                    <br />
                </p>
                <form id="form1" name="form1" method="post" action="user/reservation.php">
                    <input type="hidden" name="pid" id="pid" value="<?php echo $packID; ?>" />
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
</body>

</html>