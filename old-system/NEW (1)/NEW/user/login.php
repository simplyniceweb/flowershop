<?php
session_start();

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
         <li><a href="../'.$catname.'.php"><span>'.$catname.'</span></a></li>

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
         <li><a href="../packages.php?packID='.$packID.'"><span>'.$packagename.'</span></a></li>

    ';
    }
} else {
    $package2 = "You have no category listed in your store yet";
}

?>
<?php

if (isset($_POST["myusername"]) && isset($_POST["mypassword"])) {


    $myusername = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["myusername"]);
    $mypassword = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["mypassword"]);
    include "../storescripts/connect_to_mysql.php";
    $sql = mysql_query("SELECT userid FROM user WHERE username='$myusername' AND password='$mypassword' LIMIT 1");
    $existCount = mysql_num_rows($sql);
    if ($existCount == 1) {
        while($row = mysql_fetch_array($sql)){
            $userID = $row["id"];
        }
        $_SESSION["id"] = $userID;
        $_SESSION["myusername"] = $myusername;
        $_SESSION["mypassword"] = $mypassword;
        header("location: index.php");


        exit();
    } else {

        echo  '<strong>Incorrect Username/Password Combination</strong><br>';
        echo  "The password and Username you entered don't match<br>Please try again.<br>";
        echo '
    <a href="login.php"><img src="../style/refresh.png"></a>';
        exit();
    }
}
?><?php
include "../storescripts/connect_to_mysql.php";
if (isset($_POST['username'])) {

    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $contact = mysql_real_escape_string($_POST['contact']);
    $address = mysql_real_escape_string($_POST['address']);
    $email = mysql_real_escape_string($_POST['email']);
    $fname = mysql_real_escape_string($_POST['fname']);
    $bdate = mysql_real_escape_string($_POST['bdate']);



    $sql = mysql_query("SELECT userid FROM user WHERE username='$username' LIMIT 1");
    $userMatch = mysql_num_rows($sql);
    if ($userMatch > 0) {
        echo "Sorry the username is in use, <a href='javascript:history.go(-1)'>Go back...</a>";
        exit();
    }
    else {
        $sql = mysql_query("INSERT INTO user (username, password, fname, address, bdate, email, contact, date_added)
        VALUES('$username','$password','$fname','$address','$bdate','$email','$contact',now())") or die (mysql_error());
        echo  '<strong>Please log in to continue...</strong><br>';
        echo'';


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
        <li><a href='../index.php'><span>Home</span></a></li>
        <li class='has-sub'><a href='../allproducts.php'><span>Product</span></a>
            <ul>
                <?php echo $category2; ?>
            </ul>
        </li>
        <li><a href='../Package.php'><span>Packages</span></a>
            <ul>
                <?php echo $package2; ?>

            </ul>

        </li>
        <li class='has-sub'><a href='#'><span>Company</span></a>
            <ul>
                <li><a href='../about.php'><span>About</span></a></li>
                <li><a href='../location.php'><span>Location</span></a></li>
                <li class='last'><a href='../terms.php'><span>Terms and Conditions</span></a></li>
            </ul>
        </li>
        <li><a href='../contact.php'><span>Contact</span></a></li>
        <li class='has-sub last'><a href='#'><span>Log-in</span></a>
            <ul>
                <li><a href='signup.php'><span>Sign-up</span></a></li>
                <li class='last'><a href='login.php'><span>Log in</span></a></li>
            </ul>
        </li>
    </ul>
</div>

</br>

<div class = "loginstyle">
<br><br>
<form name="login" action="login.php" onsubmit="return login()" method="post">
<center><table border="0" cellpadding="5" cellspacing="3">

   <th colspan="3"><h2>Log In here!</th>
<tr><td><b>User Name: </td><td colspan="2"><input type="text" name="myusername" size="20"></td>
<tr><td><b>Password: </td><td colspan="2"><input type="password" name="mypassword" size="20"></td>
<tr><td><?php $nbsp; ?></td><td colspan="2" align="right"><input type="submit" name="button" value="Log In"><a href="signup.php"><input type="button" value="Register"></a></td></tr>
<table></center>
</form>



</div>

<br>






<div class = "">

</div>
</body>


<script type="text/javascript">
    function login()
    {
        var x=document.forms["login"]["myusername"].value;
        var y=document.forms["login"]["mypassword"].value;
        if ((x==null || x=="") && (y==null || y==""))
        {
            alert("All Field must be filled out");
            return false;
        }


        if (x==null || x=="")
        {
            alert("Please enter your username!");
            return false;
        }

        if (y==null || y=="")
        {
            alert("Please enter password!");
            return false;
        }

    }



</script>
</html>