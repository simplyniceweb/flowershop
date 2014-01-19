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
$sql = mysql_query("SELECT * FROM reservation");
$reserve1Count = mysql_num_rows($sql)+1;

?>

<?php

$sql = mysql_query("SELECT * FROM user WHERE username='$myusername' AND password='$mypassword' LIMIT 1");
$userCount = mysql_num_rows($sql);
if ($userCount > 0) {
    while($row = mysql_fetch_array($sql)){
        $userid = $row["userid"];
        $username = $row["username"];
        $bdate = $row["bdate"];
        $fname = $row["fname"];
        $email = $row["email"];
        $contact= $row["contact"];
        $address= $row["address"];

    }
} else {
    $user_list = "Please Login!";
}
?>



<?php
// Check to see the URL variable is set and that it exists in the database
if (isset($_POST['pid'])) {
    // Connect to the MySQL database
    include "../storescripts/connect_to_mysql.php";
    $pid = preg_replace('#[^0-9]#i', '', $_POST['pid']);
    // Use this var to check to see if this ID exists, if yes then get the product
    // details, if no then exit this script and give message why
    $sql = mysql_query("SELECT * FROM products WHERE pid='$pid' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
        // get all the product details
        while($row = mysql_fetch_array($sql)){
            $product_name = $row["product_name"];
            $price = $row["price"];
            $details = $row["details"];
            $category = $row["category"];
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));



        }

    } else {
        echo "That product does not exist.";
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
         <li><a href="packages.php?packID='.$packID.'"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>


<script type="text/javascript">
    function validateForm()
    {
        var a=document.forms["order"]["receivername"].value;
        var b=document.forms["order"]["receiverno"].value;
        var c=document.forms["order"]["date"].value;
        var d=document.forms["order"]["time"].value;
        var e=document.forms["order"]["receiveradd"].value;
        var f=document.forms["order"]["cardmessage"].value;
        if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e==""))
        {
            alert("All Field must be filled out");
            return false;
        }
        if (a==null || a=="")
        {
            alert("Receiver's name must be filled out");
            return false;
        }
        if (b==null || b=="")
        {
            alert("Receiver's number must be filled out");
            return false;
        }
        if (c==null || c=="")
        {
            alert("Please provide the date to deliver!");
            return false;
        }
        if (d==null || d=="")
        {
            alert("Please provide the time to deliver!");
            return false;
        }
        if (e==null || e=="")
        {
            alert("Receiver's address must be filled out");
            return false;
        }
        if (f==null || f=="")
        {
            alert("Card message must be filled out");
            return false;
        }

    }


    }
</script>


<html>
<head>
    <link rel="shortcut icon" href="../images/icon.ico" >
    <title>Keanna's Flower Shop</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>


<body>
<div align="center" id="mainWrapper">
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

    <div class = "reservecontent">

                <form name="order" action="processreserve.php" onsubmit="return validateForm()" method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="30">
                        <tr>
                    <td width="30%" valign="top"><h2><?php echo $myusername; ?></h2>
                        <p><?php echo "<b>Full Name:&nbsp;</b>".$fname; ?><br />
                            <br />
                            <?php echo "<b>Birthdate:&nbsp;</b>".$bdate; ?><br />
                            <br />
                            <?php echo "<b>Email:&nbsp;</b>" .$email; ?> <br />
                            <br />
                            <?php echo "<b>Contact:&nbsp;</b>" .$contact; ?> <br />
                            <br />
                            <?php echo "<b>Address:&nbsp;</b>" .$address; ?> <br />
                            <br /><hr>
                        <b> Receiver Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input name="receivername" type="text" size="35" /><br>
                        <b>Receiver No.:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="receiverno" type="text" size="30" /><br>
                        <b> Date to deliver:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input name="date" type="date" /><small>*Date must not be before.</small><br>
                        <b> Time to deliver:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input name="time" type="time" /><br>
                        <b>Receiver Address:</b> <textarea name="receiveradd" cols="50" rows="4"></textarea><br>
                        <small>If we are delivering to an office address, kindly provide us the company name and recipient's department.
                            Please include recipient's landline number if available. For more info, kindly read our<a href="Terms and conditions.php"><small> Terms and Conditions.</small></a></small><br><br>
                        <b>Card Message:</b> <textarea name="cardmessage" cols="50" rows="4"></textarea>
                        <small>EXACT MESSAGE WILL BE PRINTED ON CARD. PLEASE INCLUDE SENDER NAME IF YOU WANT THIS PRINTED.</small>

                        </p>
                        <p>
                            <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left">
                            <object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=./images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" height="32" width="32">
                                <param name="movie" value="securimage/securimage_play.swf?bgcol=#ffffff&amp;icon_file=./images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" />
                            </object>
                            &nbsp;
                            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a><br />
                            <strong>Enter Code*:</strong><br />
                            <?php echo @$_SESSION['ctform']['captcha_error'] ?>
                            <input type="text" name="ct_captcha" size="12" maxlength="16" />
                        </p>

                        <input type="checkbox" name="accept" id="terms"/>I accept the <a href="Terms and conditions.php"><small>Terms and Conditions</small></a> <br>
                        <input type="hidden" name="resid" id="resid" value="<?php echo $reserve1Count; ?>" />

                        <input type="submit" name="button" id="button" value="Reserve" /></td>




                            <td width="10%" valign="top" align="center"><p><img src="../inventory_images/<?php echo $pid; ?>.jpg" width="100" style="border:#FFFFFF 1px solid;" height="100" alt="<?php echo $product_name; ?>" /><br />

                                <a href="../inventory_images/<?php echo $pid; ?>.jpg" target="_blank"></a></p>
                            </td>
                            <td width="30%" valign="top"><h3><?php echo"<b>Product Name:&nbsp;</b>" .$product_name; ?></h3>
                                <p>

                                    <?php echo"<b>Category:&nbsp;</b>" .$category; ?> <br />
                                    <br />
                                    <?php echo"<b>Description:&nbsp;</b>" .$details; ?> <br />
                                    <br />
                                    <?php echo "<b>Price:</b> Php.&nbsp;".$price; ?><br />
                                    <br />

                                </p>



                            </td>

            </tr>


        </table>
                </form>



        <div class = "footer">

        </div>





    </div>

    <br>






    <div class = "">
    </div>
</div>
</body>

</html>

