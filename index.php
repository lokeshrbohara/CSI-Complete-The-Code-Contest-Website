<?php

include_once "config.php";

$msg="";

session_start();
if (isset($_SESSION['email'])) {
    header('Location: contest.php');
    exit();
}
	
if(isset($_POST["submit"]))
    {

        $email=$con->real_escape_string($_POST["email"]);
        $password=$con->real_escape_string($_POST["password"]);

        if ($email == "")
			$msg = "<div class=\"alert alert-danger\">Email ID is empty, try again.</div>";
		else if ($password == "")
			$msg = "<div class=\"alert alert-danger\">Password is empty, try again.</div>";
		else {
			$sql = $con->query("SELECT id, passwordhash FROM users WHERE email='$email'");
			if ($sql->num_rows > 0) {
                $data = $sql->fetch_array();
                if ($password == $data['passwordhash']) {
                   
						$_SESSION['id']=$data['id'];
						$_SESSION['email']=$email;
						header('Location: contest.php');
						exit();
	                   
                    
                } else
	                $msg = "<div class=\"alert alert-danger\">Email ID or Password is Wrong</div>";
			} else {
				$msg = "<div class=\"alert alert-danger\">Email ID or Password is Wrong</div>";
			}
		}

    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">

    <title>Login</title>
</head>
<body>
        <div class="container-login100" style="background-image: url('images/background.jpg');">
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <form class="login100-form flex-sb flex-w" method="post" action="index.php">
                    <span class="login100-form-title">Complete the Code</span>
                    

					<div class="p-t-31 p-b-9" style="width:100%;">
						<span class="txt1">
							<?php if ($msg != "") echo $msg  ?>
						</span>
						
					</div>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Email Id
                        </span>
                    </div>

                    <div class="wrap-input100">
						<input class="input100" name="email" type="email" placeholder="Email Id">
                    </div>
                    
                    
					<div class="p-t-13 p-b-9 m-t-17">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100">
						<input class="input100" name="password" type="password" placeholder="Password" >
					</div>

					<div class="container-login100-form-btn m-t-17">
						<input class="login100-form-btn a1" type="submit" name="submit" value="Log In">
					</div>

					
				</form>
            </div>
        </div>

</body>
</html>