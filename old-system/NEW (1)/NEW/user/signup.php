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

<html>
<script type="text/javascript">
    function validateForm()
    {
        var a=document.forms["reg"]["username"].value;
        var b=document.forms["reg"]["fname"].value;
        var c=document.forms["reg"]["bdate"].value;
        var d=document.forms["reg"]["email"].value;
        var e=document.forms["reg"]["contact"].value;
        var f=document.forms["reg"]["address"].value;
        var g=document.forms["reg"]["password"].value;


        if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e=="") && (f==null || f=="") && (g==null || g==""))
        {
            alert("All Field must be filled out");
            return false;
        }
        if (a==null || a=="")
        {
            alert("username must be filled out");
            return false;
        }
        if (b==null || b=="")
        {
            alert("Enter your fullname.");
            return false;
        }
        if (c==null || c=="")
        {
            alert("choose your bday.");
            return false;
        }


        if (d==null || d=="")
        {
            alert("enter your email");
            return false;
        }
        if (e==null || e=="")
        {
            alert("contact must be filled out");
            return false;
        }
        if (f==null || f=="")
    {
        alert("address must be filled out");
        return false;
    }
        if (g==null || g=="")
        {
            alert("Enter your password");
            return false;
        }
    }
</script>
<head>
    <link rel="shortcut icon" href="../images/icon.ico" >
    <title>Keanna's Flower Shop</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" />
</head>


<body>
<div align="center" id="mainWrapper">
    <div class = "banner">
    </div>


    <div id='cssmenu'>
        <ul>
            <li><a href='../index.php'><span>Home</span></a></li>
            <li class='has-sub'><a href='../allproducts.php'><span>Product</span></a>
                <ul>
                    <?php echo $category2 ?>
                </ul>
            </li>
            <li><a href='../Package.php'><span>Packages</span></a>
                <ul>
                    <?php echo $package2 ?>

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

    <div class = "signup">
        <FORM name="reg" ACTION="login.php" METHOD="POST" onsubmit="return validateForm()">
            <center><h1>Welcome to the registration page</h1>
                Please input the registration details to create an account here<br>
                <table><tr>
                    <td align="right">Username :</td><td><input name="username" type="text" size"20"></input></td>
                </tr>
                    <tr>
                        <td align="right">Full name :</td><td><input name="fname" type="text" size"20"></input></td>
                    </tr>

                    <tr>
                        <td align="right">Birthdate :</td><td><input name="bdate" type="date" size"20"></input></td>
                    </tr>
                    <tr>
                        <td align="right">E-mail :</td><td><input name="email" type="text" size"20"></input></td>
                    </tr>
                    <tr>
                        <td align="right">Contact no. :</td><td><input name="contact" type="text" size"20"></input></td>

                    </tr>
                    <tr>
                        <td align="right">Address :</td><td><textarea name="address" cols="50" rows="4"></textarea></td>
                    </tr>
                    <tr>
                        <td align="right">Password :</td><td><input name="password" type="password" size"20"></input></td>
                    </tr>
                    <tr>
                        <td align="right">Re-type password :</td><td><input name="repassword" type="password" size"20"></input></td>
                    </tr>
                </table>
                <input type="submit" value="Register me!"/></center>
        </FORM>



        <div class = "footer">

        </div>





    </div>

    <br>






    <div class = "">
    </div>
</div>
</body>

</html>