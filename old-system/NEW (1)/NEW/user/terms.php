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
<div class="terms">
    Terms and Conditions

    Satisfaction guarantee
    •	In case that the product presented is damage, we will replace it with a freebie.
    •	In case that a wrong product is delivered, once confirmed, we will replace it with a freebie.
    Ordering
    •	A customer must register an account first before being able to access the ordering function of the website.
    •	For a product to be queued for processing, a customer should first settle at least 50% of the total amount of the ordered products.
    •	A customer must pay 50% of the total amount of the ordered products on or before 3days after placing the order, else, the order will be considered null.
    Delivery
    •	For regular customers, as long as a customer had already deposited an amount to Keanna’s Flower Shop, the ordered product will be delivered even if you haven’t settled the total amount of the ordered product yet. Remaining balance will be followed up.
    •	For first timers, a customer must first have to pay at least 50% of the total amount of their order for it to be delivered but before you could receive the product, you must settle the remaining fee by either Cash on Delivery (COD) or depositing the remaining balance to our bank account or by g-cash or smart money.
    Delivery fees:
    o	Inside Makati Area – free delivery
    o	Outside Makati Area – depends on the transportation cost

    Cancellation and Refund
    •	As long as a customer still haven’t paid at least 50% of the total amount of their order, they could still cancel it and if so a customer had already paid an amount, only 50% of the total amount they had paid will be given back to them.
    Rescheduling of delivery
    •	As long as the product ordered is not arranged, the customer could still reschedule the delivery date of their order. They will be informed if their project is ready for arrangement and is queued to deliver.
    Payments
    •	The website will not receive the money, hence, payments are carried through g-cash, smart money or bank deposits.
    Affiliated Banks:
    o	Landbank
    o	BDO



</div>






</div>

<br>






<div class = "">

</div>
</body>

</html>