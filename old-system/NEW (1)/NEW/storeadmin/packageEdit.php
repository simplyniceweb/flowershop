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
if (isset($_POST['packagename'])) {

    $packID = mysql_real_escape_string($_POST['thisID']);
    $packagename = mysql_real_escape_string($_POST['packagename']);
    $packagedesc = mysql_real_escape_string($_POST['packagedesc']);

    $sql = mysql_query("UPDATE packages SET packagename='$packagename', packagedesc='$packagedesc' WHERE packID='$packID'");
    if ($_FILES['fileField']['tmp_name'] != "") {

        $newname = "$packID.jpg";
        move_uploaded_file($_FILES['fileField']['tmp_name'], "../package_images/$newname");
    }
    header("location: Package.php");
    exit();
}
?>
<?php
if (isset($_GET['packID'])) {
    $targetID = $_GET['packID'];
    $sql = mysql_query("SELECT * FROM packages WHERE packID='$targetID' LIMIT 1");
    $packCount = mysql_num_rows($sql);
    if ($packCount > 0) {
        while($row = mysql_fetch_array($sql)){

            $packagename1 = $row["packagename"];
            $packagedesc1 = $row["packagedesc"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
        echo "Sorry dude that crap dont exist.";
        exit();
    }
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




        <div id="pageContent">
            <div align="left" style="margin-left:24px;">
                <h2><?php echo $packagename1; ?></h2>
            </div>
            <hr />

            <h3>
                &darr; Add New Package Form &darr;
            </h3>
            <form action="packageEdit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
                <table width="90%" border="0" cellspacing="0" cellpadding="6">
                    <tr>
                        <td width="19%" valign="right" align="right"><p><img src="../package_images/<?php echo $targetID; ?>.jpg" width="250" style="border:#FFFFFF 1px solid;" height="250" alt="<?php echo $packagename; ?>" /><br />

                    </tr>
                    <tr>
                        <td width="20%" align="right">Package Name:&nbsp;</td>
                        <td width="80%"><label>
                            <input name="packagename" type="text" id="product_name" size="64" value="<?php echo $packagename1; ?>" />
                        </label></td>
                    </tr>
                    <tr>
                        <td align="right">Package Details:&nbsp;</td>
                        <td><textarea name="packagedesc" id="details" cols="64" rows="5"><?php echo $packagedesc1; ?></textarea></td>
                    </tr>

                    <tr>
                        <td align="right">Package Image:&nbsp;</td>
                        <td><label>
                            <input type="file" name="fileField" id="fileField" />
                        </label></td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td><label>
                            <div align="right">
                                <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                                <input type="submit" name="button" id="button" value="Make Changes" />
                            </div>
                        </label></td>
                    </tr>
                    <tr align="right">
                        <td>&nbsp;</td>
                        <td><label></label></td>
                    </tr>
                </table>
            </form>


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