<?php
session_start();
?>
<html>
<head>
    <link rel="shortcut icon" href="../images/icon.ico" >
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css" />
</head>


<body>

<div class = "loginstyle">
    <br><br>
    <form name="login" action="admin_login.php" onsubmit="return login()" method="post">
        <center><table border="0" cellpadding="5" cellspacing="3">

            <?php


            if (isset($_POST["manager"]) && isset($_POST["password"])) {

                $manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["manager"]);
                $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]);
                include "../storescripts/connect_to_mysql.php";
                $sql = mysql_query("SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1");
                $existCount = mysql_num_rows($sql);
                if ($existCount == 1) {
                    while($row = mysql_fetch_array($sql)){
                        $adminID = $row["adminID"];
                    }
                    $_SESSION["adminID"] = $adminID;
                    $_SESSION["manager"] = $manager;
                    $_SESSION["password"] = $password;
                    header("location: index.php");
                    exit();
                } else {

                    echo  '<strong>Incorrect Username/Password Combination</strong><br>';
                    echo  "The password and Username you entered don't match<br>Please try again.<br>";
                    echo '
    <a href="admin_login.php"><img src="../style/refresh.png"></a>';
                    exit();
                }
            }
            ?><th colspan="3"><h2>Authorized Personnel Only!</th>
            <tr><td><b>User Name: </td><td colspan="2"><input type="text" name="manager" size="20"></td>
            <tr><td><b>Password: </td><td colspan="2"><input type="password" name="password" size="20"></td>
            <tr><td><?php $nbsp; ?></td><td colspan="2" align="right"><input type="submit" name="button" value="Log In"></td></tr>
            <table></center>
    </form>



</div>

<br>






<div class = "">

</div>
</body>


</html>