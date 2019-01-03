<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
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
$key = isset($_GET['key']) ? $_GET['key'] : '';
$key_exist = $process->isKeyExist($key);
if ($key_exist == false) {
	# code...
	echo "<div class='alert alert-danger text-center'>Invalid Token Given</div><br>
    <a href='forgotpassword.php'>Click Here To Reset Your Password Again</a>";
exit();

}
if (isset($_POST['password'])) {
    # code...
    $username_data = $_POST['key_data'];
    
    $username = $process->getUserNameFromKey($username_data);
    
    $password = md5($_POST['password']);
    
    //kj1vcz3y
    $check_user = $process->updateCredentcials($username, $password);

    if ($check_user == "true") {
        # code...
		$_SESSION['user'] = $username;
		echo $_SESSION['user'];
        header("Location:index.php");
        
    # code...
            $key = $username_data;
            $process = $process->updateKey($key);

    }
}

if ($process->checkeyStatus($key)) {
    # code...
    echo "<div class='alert alert-danger text-center'>Token Session Expired</div><br>
    <a href='forgotpassword.php'>Click Here To Update Again</a>";
    exit();
}


?>
<body style="background:gray">
<section style="padding: 200px 0px 80px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
    <div class="container-fluid">
    	<div class="row">
        <div class="col-md-12">
			<div class="col-md-4"></div>
        <div class="col-md-4 border-color" style="background-color:white;border-radius: 20px">
        <h2 class="text-center">Reset Password</h2>
          <form id="signupForm1" action="resetPassword.php" method="POST" style="padding:20px">
          <input type="hidden" value = "<?php echo $key = isset($_GET['key']) ? $_GET['key'] : '' ?>" name="key_data">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control"  name= "password" id="password" placeholder="Enter Password" >
            </div>
            <div class="form-group">
                <label for="confirm_password">Re-Enter Your Password</label>
                <input type="password" name= "confirm_password" class="form-control" id="confirm_password" placeholder="Re Enter Your Password" >
            </div>
           
            <button type="submit" class="btn btn-primary1">Submit</button>
        </form>
        <script type="text/javascript" src="jquery-1.11.1.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
        <script>
            $.validator.setDefaults( {
			submitHandler: function () {
				form.submit();
			}
		} );
       $( document ).ready( function () {
            $( "#signupForm1" ).validate( {
                onfocusout: function(element) {
                    // "eager" validation
                    this.element(element);  
                },
				rules: {
					
					password: {
						required: true,
						minlength: 6
					},
					confirm_password: {
						required: true,
						minlength: 6,
						equalTo: "#password"
					},
					
				},
				messages: {
					
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
					},
					
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".form-group" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
        })
        </script>
		</div>
		<div class="col-md-4"></div>
        </div>
        </div>
    </div>
</section>
</body>
</html>