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
$admin_list = "";
$sql = mysql_query("SELECT * FROM admin");
$managerCount = mysql_num_rows($sql);
if ($managerCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $adminID = $row["id"];
        $username = $row["username"];
        $admin_list .= '<table width="100%" cellspacing="0" cellpadding="6">
          <tr>
          <td width="5%" valign="bottom">'.$adminID.'</td><td width="10%">'.$username.'</td>
        </tr>
      </table>';
    }
} else {
    $admin_list = "You are the only admin here!";
}
?>
<?php
$user_list = "";
$sql = mysql_query("SELECT * FROM user");
$userCount = mysql_num_rows($sql);
if ($userCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $userid = $row["userid"];
        $username = $row["username"];
        $password = $row["password"];
        $fname = $row["fname"];
        $email = $row["email"];
        $user_list .= '<table width="100%" cellspacing="0" cellpadding="6">
          <tr>
          <td width="10%">'.$userid.'</td><td width="10%">'.$username.'</td><td width="10%">'.$password.'</td><td width="10%">'.$fname.'</td><td width="10%">'.$email.'</td><td width="10%" align="right"> <a href="manageuser.php?deleteid='.$userid.'"><b><img src="../style/delete.png"  width="40" height="40"  /></a></td>
        </tr>
      </table>';
    }
} else {
    $user_list = "We have no members!";
}
?>



<?php
if (isset($_GET['deleteid'])) {
    echo 'Do you really want to delete user with ID of ' . $_GET['deleteid'] . '? <a href="manageuser.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="manageuser.php">No</a>';
    exit();
}
if (isset($_GET['yesdelete'])) {
    // remove item from system and delete its picture
    // delete from database
    $id_to_delete = $_GET['yesdelete'];
    $sql = mysql_query("DELETE FROM user WHERE userid='$id_to_delete' LIMIT 1") or die (mysql_error());
    // unlink the image from server
    // Remove The Pic -------------------------------------------

    header("location: manageuser.php");
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
                <h2>ADMIN: </h2>
                <table width="100%" cellspacing="0" cellpadding="6">
                    <tr>
                        <td width="5%" valign="bottom"><u> ID</td><td width="10%"><u> Username</td>
                    </tr>
                </table>
                <?php echo $admin_list; ?>
                <h2>USER: </h2>
                <table width="100%" cellspacing="0" cellpadding="6">
                    <tr>
                        <td width="10%" valign="bottom"><u> UserID</td><td width="10%"><u> Username</td><td width="10%"><u> Password</td><td width="10%"><u> Fullname</td><td width="10%"><u> Email</td><td width="10%"></td>
                    </tr>
                </table>
                <?php echo $user_list; ?>


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