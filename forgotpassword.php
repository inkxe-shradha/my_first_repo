<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>
     <style>
    .btn-primary1 {
    color: #fff;
    background-color: #28419b;
    border-color: #28419b;
    }
    .btn-primary1:not(:disabled):not(.disabled).active, .btn-primary1:not(:disabled):not(.disabled):active, .show>.btn-primary1.dropdown-toggle {
    color: #fff;
    background-color: #323681;
    border-color: #323681;
    }
    .btn.focus, .btn:focus, .btn:hover {
        color: #fff;
        text-decoration: none;
        background: #323681;
    }
    .border-color
    {
        border:2px solid #323681;
    }
    </style>
</head>
<?php #endregion
require "controller.php";
$process = new Controller();

?>
<body style="background:gray">
 <section style="padding: 200px 0px 80px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
    <div class="container-fluid">
    	<div class="row">
        <div class="col-md-12">
            <div class="col-md-4"></div>
        <div class="col-md-4  border-color" style="background-color:white;border-radius: 20px">
        <h2 class="text-justify">Frogot Password</h2>
        <?php if (isset($_POST['email'])) {
            $username = $_POST['email'];

            $check_user = $process->checkUserCredentialsByEmail($username);
            function randomPassword()
            {
                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 6; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                return implode($pass); //turn the array into a string
            }
            function randomKey()
            {
                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 100; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                return implode($pass); //turn the array into a string
            }
           
            if ($check_user == "true") {
                $to = "$username";
                $subject = "Reset Password";
                $pass_key = randomkey();
                $message = "<a href='http://localhost/index/Login%20Panel(27-12-2018)/resetPassword.php?key=".$pass_key."'>Click Here To Redirect Rest Password Page </a>";
                $headers = "From: Inkxe < shradhasuman2.com >\n";
                $_SESSION['username'] =  $username;
                $headers .= 'X-Mailer: PHP/' . phpversion();
                $headers .= "X-Priority: 1\n"; // Urgent message!
                $headers .= "Return-Path: mail@testsite.com\n"; // Return path for errors
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
               
                if (@mail($to, $subject, $message, $headers)) {
                    # code...       
                    $check_user = $process->insertKey($username,$pass_key);
                    if ($check_user) {
                        # code...
                        $randompassgenerate = $pass_key;
                        header("Location:resetPassword.php?key=$randompassgenerate");
                        //header("Location:login.php?passwordupdate=true");
                    }
                    else {
                        header('Location:forgotpassword.php');
                    }
                   
                }
                else {
                    echo "Oh Nooooo";
                }
            } else {
        # code...
            echo "<div class='alert alert-danger'>Your entered mail id is not registered..</div>";
            }
        }
        ?>
          <form action="forgotpassword.php" method="POST" style="padding:20px">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"  name= "email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
            
            <button type="submit" class="btn btn-primary1" style="margin:5px">Submit</button>
        </form>
        
        </div>
        <div class="col-md-4"></div>
        </div>
        </div>
    </div>
</section>
</body>
</html>