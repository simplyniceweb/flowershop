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
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete CATEGORY with ID of ' . $_GET['deleteid'] . '? <a href="manageCat.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="manageCat.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    // remove item from system and delete its picture
    // delete from database
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysql_query("DELETE FROM category WHERE catid='$id_to_delete' LIMIT 1") or die (mysql_error());
    $pictodelete = ("$catname.jpg");
    if (file_exists($pictodelete)) {
        unlink($pictodelete);
    }


    header("location: manageCat.php");
    exit();
}
?>
<?php

if (isset($_POST['catname'])) {

    $catname = mysql_real_escape_string($_POST['catname']);
    $catdesc = mysql_real_escape_string($_POST['catdesc']);

    $sql = mysql_query("SELECT catid FROM category WHERE catname='$catname' LIMIT 1");
    $categoryMatch = mysql_num_rows($sql);
    if ($categoryMatch > 0) {
        echo 'Sorry you tried to place a duplicate "Category Name" into the system, <a href="addCat.php">click here</a>';
        exit();
    }
    else {

        $sql = mysql_query("INSERT INTO category (catname,catdesc)
        VALUES('$catname','$catdesc')") or die (mysql_error());
        $catid = mysql_insert_id();
        // Place image in the folder
        $fileadmin = "manage$catname.php";
        $fileuser = "$catname.php";
        $fileuserlogged = "$catname.php";
        move_uploaded_file( $_FILES['fileFieldAdmin']['tmp_name'], "$fileadmin");
        move_uploaded_file( $_FILES['fileFieldUser']['tmp_name'], "../$fileuser");
        move_uploaded_file( $_FILES['fileFieldUserlogged']['tmp_name'], "../user/$fileuserlogged");


        header("location: manageCat.php");


        exit();

    }
}
?>

<?php
$category = "";
$sql = mysql_query("SELECT * FROM category ORDER BY catname ASC");
$categoryCount = mysql_num_rows($sql);
if ($categoryCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $catid = $row["catid"];
        $catname = $row["catname"];
        $catdesc = $row["catdesc"];
        $category .= '<table width="100%" cellspacing="0" cellpadding="6">
          <tr>
          <td width="1%" valign="bottom"><a href="manage'.$catname.'.php">'.$catname.'</a></td><td width="50%" align="right"><a href="manageCatEdit.php?catid='.$catid.'"><b><img src="../style/edit.png"  width="40" height="40"  /></a> <a href="manageCat.php?deleteid='.$catid.'"><b><img src="../style/delete.png"  width="40" height="40"  /></a></td>
        </tr>
      </table>';
    }
} else {
    $category = "You have no category listed in your store yet";
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
                <div align="left" style="margin-left:24px;"><div align="right" style="margin-right:32px;"><a href="addcat.php">+ Add New Category</a></div>
                    <h2>Choose category to manage: </h2>
                    <?php echo $category; ?>
                    <p><a href="inventory_list.php">View All Products</a> </p>
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