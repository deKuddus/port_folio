<?php
include "../library/Session.php";
Session::checkLogin();
include "../helper/Format.php";
include "../config/config.php";
include "../library/Database.php";
$format = new  Format();
$db = new Database();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

        <?php 
 
         if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userName = $format->validation($_POST['username']);
                $userpassword = $format->validation(md5($_POST['password']));

                $userName = mysqli_real_escape_string($db->link, $userName);
                $userpassword = mysqli_real_escape_string($db->link, $userpassword);


                $query = "SELECT * FROM user_login WHERE  name = '$userName' AND password = '$userpassword'";
                $result = $db->select($query);
                if ($result != false) {
                    $value = mysqli_fetch_array($result);

                    $row = mysqli_num_rows($result);
                    if ($row ) {
                        Session::set("Login", true);
                        Session::set("name", $value['name']);
                        Session::set("userID", $value['id']);
                        echo "<script>window.location='index.php';</script>";
                    } else {
                        echo "<slpan style = 'color:red';font-size:18px> Data not found!!</span>";
                    }

                }
                else{
                        echo "<slpan style = 'color:red';font-size:18px> user name or password not found!!</span>";
                    }
                }
        ?>

        

		<form action="login.php" method="post">
			<h1>User Login</h1>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Login" />
			</div>
		</form><!-- form -->
        <div class="button">
            <a href="forgotpassword.php">Forgot password !!</a>
        </div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>




            
