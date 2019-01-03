<?php #endregion
require "controller.php";
if($_SESSION['user'] == null)
{
  header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
<!-- active<span class="sr-only">(current)</span> -->
                <a class="nav-link" href="profile.php">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
            
           
        </ul>
       
    </div>
</nav>
    </header>
    <?php 
    
    
    $process = new Controller();
    ?>
    <section style="padding-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($_GET['message']) && $_GET['message']== true) {
                        # code...
                        echo "<div class='alert alert-success'>Profile Updated Successfully</div>";
                    } ?>
                    <?php 

                    $get_user_data = $process->getUserdataByMail($_SESSION['user']);

                    if (mysqli_num_rows($get_user_data) > 0) {
                                # code...
                        while ($row = $get_user_data->fetch_assoc()) {
                                    # code..
                           
                  ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Profile Information</div>
                        <div class="panel-body">
                           <div class="col-md-2 ">
                             <h4>Name</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                          
                            <div class="col-md-3">
                             <h4><?php echo $row['fname']." ". $row['lname'];?></h4>
                           </div>
                          <div class="col-md-2 ">
                             <h4>Email</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row['email'] ; ?></h4>
                           </div>
                          <div class="col-md-2 ">
                             <h4>Address</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row['address']; ?></h4>
                           </div>
                           <div class="col-md-2 ">
                             <h4>Phone</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row['phone_number']; ?></h4>
                           </div>
                          <?php 
                            $check_country = $process->getCountry($row['city']);
                             while ($row_data = $check_country->fetch_assoc()) {
                                 # code...
                            ?>
                           <div class="col-md-2 ">
                             <h4>Country</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row_data['country_name']; ?></h4>
                           </div>
                           <div class="col-md-2 ">
                             <h4>State</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row_data['state_name']; ?></h4>
                           </div>
                          <div class="col-md-2 ">
                             <h4>City</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row_data['cityname']; ?></h4>
                           </div>
                           <?php
                             }
                           ?>
                            <div class="col-md-2 ">
                             <h4>Zipcode</h4>
                           </div>
                           <div class="col-md-1"><h4>:</h4></div>
                            <div class="col-md-3">
                             <h4><?php echo $row['zipcode']; ?></h4>
                           </div>
                           
                        </div>
                        </div>
                        <div class="panel panel-primary">
                        <div class="panel-heading">Store Information</div>
                        <div class="panel-body">
                             <!-- <div class="col-md-6 ">
                             <h4>Store Id:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['store_id']; ?></h4>
                           </div> -->
                           <div class="col-md-6 ">
                             <h4>Store Name:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['store_name']; ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Store Description:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['store_description']; ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Supplier Url:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['supplier_url']; ?></h4>
                           </div>

                            <div class="col-md-6 ">
                             <h4>Subscription Price:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['subscription_price']; ?></h4>
                           </div>

                            <div class="col-md-6 ">
                             <h4>One Time Set-Up Cost:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['onetime_setup_cost']; ?></h4>
                           </div>

                            

                            <div class="col-md-6 ">
                             <h4>Total Price:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['total_price']; ?></h4>
                           </div>

                        
                          
                        </div>
                    </div>
                         <div class="panel panel-primary">
                        <div class="panel-heading"> Transation Details</div>
                        <div class="panel-body">
                            <div class="col-md-6 ">
                              <h4>Subscription Id:</h4>
                            </div>
                             <div class="col-md-6">
                             <h4><?php echo $row['transaction_id']; ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Plan Name:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php 
                             $plan_name = $process->getPlanName($row['selected_plan'],$row['email']);
                             while ($plan_row = $plan_name->fetch_assoc()) {
                                 # code...
                                    echo $plan_row['plan_name'];
                             }
                              ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Payment Option:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php if ($row['subscription_mode'] == 'Y')
                             {
                                 echo "Yearly";
                             }
                             else{
                                 echo "Monthly";
                             }
                             ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Payment Date:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php $oldDate = $row['created_date'];

                                $newDate = date("d-m-Y", strtotime($oldDate));
                                echo $newDate; ?></h4>
                           </div>
                           <div class="col-md-6 ">
                             <h4>Transation Status:</h4>
                           </div>
                            <div class="col-md-6">
                             <h4><?php echo $row['status']; ?></h4>
                           </div>
                        </div>
                    </div>
                    <?php

                }
            }
            ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>