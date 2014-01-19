<?php
session_start();
include "storescripts/connect_to_mysql.php";
$columncount = 0;
$dynamicList = '<table width="744" border="0" cellpadding="6"><tr>';
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 10");
while($row = mysql_fetch_array($sql)){
    $pid = $row["pid"];
    $product_name = $row["product_name"];
    $price = $row["price"];
    $dynamicList .= '
    <td width="200" align="center"><a href="user/product.php?pid=' . $pid . '"><img src="inventory_images/' . $pid . '.jpg" alt="' . $product_name . '" width="235" height="220" border="2" ></a>
<br>' . $product_name . '<br>
  Php' . $price . '<br>
  <a href="user/product.php?pid=' . $pid . '">View Product Details</a></td>';

    if($columncount == 3){
        $dynamicList .= '</tr><tr>';
        $columncount = 0;
    }else
        $columncount++;
}

$dynamicList .= '</tr></table>';


?>
<?php
include "storescripts/connect_to_mysql.php";
$slide = "";
$sql = mysql_query("SELECT * FROM advertisement ORDER BY date_added DESC LIMIT 10");
while($row = mysql_fetch_array($sql)){
    $adID = $row["adID"];
    $advertisementName = $row["advertisementName"];
    $advertisementDesc = $row["advertisementDesc"];
    $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
    $slide .= ' <img src="advertisement_slide/'.$adID.'.jpg" alt="" height="400px" width="600px" />';

    if($columncount == 3){
        $dynamicList .= '</tr><tr>';
        $columncount = 0;
    }else
        $columncount++;
}

$slide .= '</tr></table>';


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
    <li><a href='Package.php'><span>Packages</span></a>
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

<div class="slide">




        <link href="themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
        <script src="themes/1/js-image-slider.js" type="text/javascript"></script>



    <div id="sliderFrame">
        <div id="slider">
            <a>
                <img src="style/logo.jpg" alt="Welcome to Keannas Flower Shop!" />
            </a>
            <?php
            echo $slide
?>
        </div>
        <div id="htmlcaption" style="display: none;">

        </div>
    </div>















    <div class="welcome">
<font face="Monotype Corsiva" size="10" color="black" ><b> <center>Welcome!</center></b></font>
<font face="Monotype Corsiva" size="3" color="black" ><center>Keanna's Flower Shop offers a wide variety of blossoms in fashion. We can make your gloomy event into a pleasant occasion through unique design of flowers, balloons and giveaways. We accept events such as: Weddings, Parties, Decorating, Orchid Plants, Burials, Gourmet Baskets and many more.</center></font>
</div>
</div>
</br>
    <div class="content3">
<div class="featured" >
<font face="Monotype Corsiva" size="7" color="black" ><b> <center>Featured Products</center></b></font>


    <?php
    echo $dynamicList;
    ?>
</div></div>
<div class = "footer">

</div>



</div>

<br>







</body>

</html>