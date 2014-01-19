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
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php
if (isset($_GET['status'])) {
    $targetID = $_GET['status'];
    $sql = mysql_query("SELECT * FROM reservation WHERE status='$targetID' LIMIT 1");
    $orderCount = mysql_num_rows($sql);
    if ($orderCount > 0) {
        while($row = mysql_fetch_array($sql)){

            $resid=$row["resid"];
            $senderusername = $row["senderusername"];
            $senderfname = $row["senderfname"];
            $senderemail = $row["senderemail"];
            $receivername = $row["receivername"];
            $receivercontact = $row["receivercontact"];
            $receiveradd = $row["receiveradd"];
            $timetodeliver = $row["timetodeliver"];
            $datetodeliver = $row["datetodeliver"];
            $pid = $row["pid"];
            $product_name = $row["product_name"];
            $productdesc = $row["productdesc"];
            $cardmessage = $row["cardmessage"];
            $status = $row["status"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));


        }
    }


    else {
        echo "Sorry dude that crap dont exist.";
        exit();
    }
}

?>
<?php
$resid1=$_REQUEST['resid'];

// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['resid'])) {
    // Connect to the MySQL database
    include "../storescripts/connect_to_mysql.php";
    $resid = preg_replace('#[^0-9]#i', '', $_GET['resid']);
    // Use this var to check to see if this ID exists, if yes then get the product
    // details, if no then exit this script and give message why
    $sql = mysql_query("SELECT * FROM reservation WHERE resid='$resid1' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
        // get all the product details
        while($row = mysql_fetch_array($sql)){
            $product_name = $row["product_name"];
            $price = $row["price"];

            $senderfname = $row["senderfname"];
            $senderusername = $row["senderusername"];
            $senderemail=$row["senderemail"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }

    } else {
        echo "That item does not exist.";
        exit();
    }

} else {
    echo "Data to render this page is missing.";
    exit();
}
mysql_close();
?>



<?php
include "../storescripts/connect_to_mysql.php";

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
include "../storescripts/connect_to_mysql.php";

$package2 = "";
$sql = mysql_query("SELECT * FROM packages ORDER BY packagename ASC");
$packageCount = mysql_num_rows($sql);
if ($packageCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $packID = $row["packID"];
        $packagename = $row["packagename"];
        $packagedesc = $row["packagedesc"];
        $package2 .= '
         <li><a href="'.$packagename.'.php"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>
<?php
$processing="";
$delivered="";
if (isset($_GET['status'])) {
    $targetID = $_GET['status'];
    if ($targetID=='Pending') {

        header("location: billingprocess.php?resid=$resid");
    }

    if ($targetID=='Processing') {

        $processing= "You are paid!no need to worry!";
    }


    if ($targetID=='Delivered') {

        $delivered= 'You are paid..Thank you!';
    }
    if ($targetID=='Cancel') {

        header("location: orders.php");
    }









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
    <?php
    echo $processing
    ?>
    <?php
    echo $delivered
    ?><form name="form" action="payment.php" method="get">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">

        <tr>
            <td width="20%" align="right"><b>Sender's Name:&nbsp;</b></td>
            <td width="80%"><label>
                <?php echo $senderfname; ?>
            </label></td>

        </tr>
        <tr>
            <td align="right"><b>Email:&nbsp;</b></td>
            <td><label>
                <?php echo $senderemail; ?>
            </label></td>
        </tr>


        <tr>

            <td align="right"><b>Product:&nbsp;</b></td>
            <td><label>
                <?php echo $product_name; ?>
            </label></td>
        </tr>



        <tr>
            <td align="right"><b>Price:&nbsp;</b></td>
            <td><label>
                <?php echo $price; ?>
            </label></td>
        </tr>

        <tr>
            <td align="right"><b>Total Price:&nbsp;</b></td>
            <td><label>
                <?php echo $price; ?>
            </label></td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                <img src="../storescripts/form.jpg" height="150" width="400"><br>
                Reference Number: <input type="text" name="refnumber">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><label>
                <input type="hidden" name="resid" value="<?php echo $resid ?>">
                <input type="submit" name="next" value="Next Step">
            </label></td>

        </tr>















        </tr>


    </table>




</form>

</div>

<br>






<div class = "">

</div>
</body>

</html>



