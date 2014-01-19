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
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete Package with ID of ' . $_GET['deleteid'] . '? <a href="package.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="package.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    // remove item from system and delete its picture
    // delete from database
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysql_query("DELETE FROM package WHERE packID='$id_to_delete' LIMIT 1") or die (mysql_error());
    // unlink the image from server
    // Remove The Pic -------------------------------------------
    $pictodelete = ("../package_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
        unlink($pictodelete);
    }
    header("location: Package.php");
    exit();
}
?>
<?php
// Parse the form data and add inventory item to the system
if (isset($_POST['packagename'])) {

    $packagename = mysql_real_escape_string($_POST['packagename']);
    $packagedesc = mysql_real_escape_string($_POST['packagedesc']);

    $sql = mysql_query("SELECT packID FROM packages WHERE packagename='$packagename' LIMIT 1");
    $packtMatch = mysql_num_rows($sql); // count the output amount
    if ($packMatch > 0) {
        echo 'Sorry you tried to place a duplicate "Advertisement" into the system, <a href="Package.php">click here</a>';
        exit();
    }
    // Add this product into the database now
    $sql = mysql_query("INSERT INTO packages (packagename,packagedesc,date_added)
        VALUES('$packagename','$packagedesc',now())") or die (mysql_error());
    $packID = mysql_insert_id();
    // Place image in the folder
    $newname = "$packID.jpg";
    move_uploaded_file( $_FILES['fileField']['tmp_name'], "../package_images/$newname");
    header("location: Package.php");
    exit();
}
?>

<?php
$packagelist = "";
$sql = mysql_query("SELECT * FROM packages ORDER BY date_added DESC");
$packCount = mysql_num_rows($sql); // count the output amount
if ($packCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $packID = $row["packID"];
        $packagename = $row["packagename"];
        $packagedesc = $row["packagedesc"];
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $packagelist .= '<table width="100%" cellspacing="0" cellpadding="6" bordercolor="#FFFFFF" frame="below" rules="none">
          <tr>


          <td width="20%" align="center">Package ID:' . $packID. '  </td><td width="20%"><strong>'.$packagename.'</strong>  </td><td width="15%">'.$packagedesc.'</td><td width="20%">Added '.$date_added.'</td><td width="10%" align="right"><a href="packageEdit.php?packID='.$packID.'"><b><img src="../style/edit.png"  width="40" height="40"  /></a></td><td width="20%" align="right"> <a href="Package.php?deleteid='.$packID.'"><b><img src="../style/delete.png"  width="40" height="40"  /></a></td>
          <div style="border:#FFFFFF 1px solid"></div></a></td>
          </tr>
      </table>';
    }
} else {
    $packagelist = "You have no advertisement listed in your store yet";
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
    $category = "You have no Advertisement listed in your store yet";
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
                <div align="right" style="margin-right:32px;"><a href="addPack.php">+ Add New Package</a><br>

                </div>
                <div align="left" style="margin-left:24px;">
                    <h2>Package list</h2>

                    <?php echo $packagelist; ?>
                </div>



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