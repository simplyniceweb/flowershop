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
include "../storescripts/connect_to_mysql.php";
$slide = "";
$sql = mysql_query("SELECT * FROM advertisement ORDER BY date_added DESC LIMIT 10");
while($row = mysql_fetch_array($sql)){
    $adID = $row["adID"];
    $advertisementName = $row["advertisementName"];
    $advertisementDesc = $row["advertisementDesc"];
    $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
    $slide .= ' <img src="../advertisement_slide/'.$adID.'.jpg" alt="" height="400px" width="600px" />';


}

$slide .= '</tr></table>';


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
$columncount = 0;
$dynamicList = '<table width="744" border="0" cellpadding="6"><tr>';
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 10");
while($row = mysql_fetch_array($sql)){
    $pid = $row["pid"];
    $product_name = $row["product_name"];
    $price = $row["price"];
    $dynamicList .= '
    <td width="200" align="center"><a href="product.php?pid=' . $pid . '"><img src="../inventory_images/' . $pid . '.jpg" alt="' . $product_name . '" width="230" height="220" border="2"></a>
<br>' . $product_name . '<br>
  Php' . $price . '<br>
  <a href="product.php?pid=' . $pid . '">View Product Details</a></td>';

    if($columncount == 3){
        $dynamicList .= '</tr><tr>';
        $columncount = 0;
    }else
        $columncount++;
}

$dynamicList .= '</tr></table>';


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
    <link rel="shortcut icon" href="images/icon.ico" >
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

<div class = "content1">

    <div class="slide">



        <link href="../themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
        <script src="../themes/1/js-image-slider.js" type="text/javascript"></script>
        <link href="../generic.css" rel="stylesheet" type="text/css" />


        <div id="sliderFrame">
            <div id="slider">
                <a>
                    <img src="../style/logo.jpg" alt="Welcome to Keannas Flower Shop!" />
                </a>
                <?php
                echo $slide
                ?>
            </div>
            <div id="htmlcaption" style="display: none;">

            </div>
        </div>








        <div class="welcome">
            <font face="Monotype Corsiva" size="5" color="black" ><b> <center>Welcome <?php echo $fname ?>! </center></b></font>
            <font face="Monotype Corsiva" size="3" color="black" >
               <div align="center"><td width="10%" valign="top" align="center"><p><img src="userimages/<?php echo $userid; ?>.jpg" width="100" style="border:#000000 2px solid;" height="100" alt="<?php echo $fname; ?>" /><br />

                    <a href="userimages/<?php echo $userid; ?>.jpg" target="_blank"></a></p>
                </td></div>
                <p><?php echo "<b>Full Name:&nbsp;</b>".$fname; ?><br />
                <br />
                <?php echo "<b>Birthdate:&nbsp;</b>".$bdate; ?><br />
                <br />
                <?php echo "<b>Email:&nbsp;</b>" .$email; ?> <br />
                <br />
                <?php echo "<b>Contact:&nbsp;</b>" .$contact; ?> <br />
                <br />
                <?php echo "<b>Address:&nbsp;</b>" .$address; ?> <br /></p></font>
        </div>
    </div>
    </br>
<div class="content3">
    <div class="featured">
        <font face="Monotype Corsiva" size="7" color="black" ><b> <center>Featured Products</center></b></font>
        <?php
        echo $dynamicList;
?>
    </div>
</div>
    <div class = "footer">

    </div>



</div>

<br>







</body>

</html>