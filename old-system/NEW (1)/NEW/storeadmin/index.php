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
         <li><a href="packageEdit.php?packID='.$packID.'"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>



<?php
$sql = mysql_query("SELECT * FROM user");
$userCount = mysql_num_rows($sql);
?>
<?php
$sql = mysql_query("SELECT * FROM products");
$productCount = mysql_num_rows($sql);
?>
<?php
$sql = mysql_query("SELECT * FROM reservation ORDER BY date_added DESC");
$orderCount = mysql_num_rows($sql)
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




        <div id="pageContent">
            <div align="left" style="margin-left:24px;">
                <h2>Hello <?php echo $manager ?>!</h2>
                <table>
                    <tr>
                        <td><strong>Total Order :</strong> <?php echo $orderCount ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Product :</strong> <?php echo $productCount ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total User :</strong> <?php echo $userCount ?></td>
                    </tr>










                </table>


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