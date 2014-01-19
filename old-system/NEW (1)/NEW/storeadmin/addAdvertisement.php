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
$advertisementList = "";
$sql = mysql_query("SELECT * FROM advertisement ORDER BY date_added DESC");
$advCount = mysql_num_rows($sql); // count the output amount
if ($advCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $adID = $row["adID"];
        $advertisementName = $row["advertisementName"];
        $advertisementDesc = $row["advertisementDesc"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $advertisementList .= '<table width="100%" cellspacing="0" cellpadding="6" bordercolor="#FFFFFF" frame="below" rules="none">
          <tr>


          <td width="20%" align="center">Advertisement ID:' . $adID. '  </td><td width="20%"><strong>'.$advertisementName.'</strong>  </td><td width="15%">Php'.$advertisementDesc.'</td><td width="20%">Added '.$date_added.'</td><td width="10%" align="right"><a href="advertisement.php?adID='.$adID.'"><b><img src="../style/edit.png"  width="40" height="40"  /></a></td><td width="20%" align="right"> <a href="advertisement.php?deleteid='.$adID.'"><b><img src="../style/delete.png"  width="40" height="40"  /></a></td>
          <div style="border:#FFFFFF 1px solid"></div></a></td>
          </tr>
      </table>';
    }
} else {
    $advertisementList = "You have no products listed in your store yet";
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
                <h3>
                    &darr; Add New Advertisement Form &darr;
                </h3>
                <form action="advertisement.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
                    <table width="90%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                            <td width="20%" align="right">Advertisement Name</td>
                            <td width="80%"><label>
                                <input name="advertisementName" type="text" id="product_name" size="64" />
                            </label></td>
                        </tr>


                        <tr>
                            <td align="right">Advertisement Details:&nbsp;</td>
                            <td><textarea name="advertisementDesc" id="details" cols="64" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td align="right">Advertisement Image:&nbsp;</td>
                            <td><label>
                                <input type="file" name="fileField" id="fileField" />
                            </label></td>
                        </tr>
                        <tr>
                            <td align="right">&nbsp;</td>
                            <td><label>
                                <div align="right">
                                    <input type="submit" name="button" id="button" value="Add This Item Now" />
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