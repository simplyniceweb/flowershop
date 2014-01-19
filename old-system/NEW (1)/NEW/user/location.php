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

<div class = "content1">
<div class = "footer">

</div>





</div>

<br>






<div class = "">

</div>
</body>

</html>