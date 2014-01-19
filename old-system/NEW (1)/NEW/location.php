<?php
session_start();
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

<div class = "content2">
<center><strong>How to locate Keanna's Flower Shop</center><br>
<div>
<center><iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=215556998466327430384.0004c9d1d0ffcb32a32b1&amp;ie=UTF8&amp;t=m&amp;iwloc=0004c9d20de3c4299ca17&amp;ll=14.566048,121.012688&amp;spn=0,0&amp;output=embed"></iframe><br /><small>View <a href="https://maps.google.com/maps/ms?msa=0&amp;msid=215556998466327430384.0004c9d1d0ffcb32a32b1&amp;ie=UTF8&amp;t=m&amp;iwloc=0004c9d20de3c4299ca17&amp;ll=14.566048,121.012688&amp;spn=0,0&amp;source=embed" style="color:#0000FF;text-align:left">Keanna's Flower Shop</a> in a larger map</small>
</center></div>



</div>

<br>






<div class = "">

</div>
</body>

</html>