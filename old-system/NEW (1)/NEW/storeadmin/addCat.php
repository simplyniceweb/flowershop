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
    $category = "You have no category listed in your store yet";
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





        exit();

    }
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

    </div>
    </br>

    <div class = "content2">




                <div id="pageContent"><br />
                    <div align="right" style="margin-right:32px;"><a href="inventory_list.php">+ Add New Inventory Item</a></div>
                    <div align="left" style="margin-left:24px;">

                    </div>
                    <hr />

                    <h3>
                        &darr; Add New Category Form &darr;
                    </h3>
                    <form action="manageCat.php" enctype="multipart/form-data" name="addcat" id="myForm" method="post">
                        <table width="90%" border="0" cellspacing="0" cellpadding="6">
                            <tr>
                                <td width="20%" align="right">Category Name:</td>
                                <td width="80%"><label>
                                    <input name="catname" type="text" size="50" />
                                </label></td>
                            </tr>
                            <tr>
                                <td align="right">Category Description:&nbsp;</td>
                                <td><label>
                                    <textarea name="catdesc" cols="64" rows="5"></textarea>
                                </label></td>
                            </tr>
                            <tr>
                                <td align="right">Webpage Admin file(A):&nbsp;</td>
                                <td><label>
                                    <input type="file" name="fileFieldAdmin"  />
                                </label></td>
                            </tr>
                            <tr>
                            <td align="right">Not Loggedin User file(B):&nbsp;</td>
                            <td><label>
                                <input type="file" name="fileFieldUser" />
                            </label></td>
                        </tr>
                            <tr>
                                <td align="right">Loggedin User file(C):&nbsp;</td>
                                <td><label>
                                    <input type="file" name="fileFieldUserlogged"  />
                                </label></td>
                            </tr>



                            <tr>
                                <td align="right">&nbsp;</td>
                                <td><label>
                                    <div align="right">
                                        <input type="submit" name="button" id="button" value="Add This Category Now" />
                                    </div>
                                </label></td>
                            </tr>
                            <tr align="right">
                                <td>&nbsp;</td>
                                <td><label></label></td>
                            </tr>
                        </table>
                    </form>
                    <br />
                    <br />
                </div>



            <br />
            <br />
            <br />





    </div>

    <br>






    <div class = "">

    </div></div>
</body>

</html>