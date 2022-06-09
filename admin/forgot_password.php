<?php
session_start();
error_reporting(0);
include('db_conn.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['phone'];
    $email=$_POST['email'];

        $query=mysqli_query($conn,"select id from a_regi where  email='$email' and phone='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['phone']=$contactno;
      $_SESSION['email']=$email;
     header('location:reset-password.php');
    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>
<!doctype html>
<html lang="en">
 
<head>
    
    <title>Real Estate Management System || Fogot Password</title>
    <link rel="stylesheet" href="style.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color:;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- forgot password  -->
    <!-- ============================================================== -->
    <div class="cont">
        <div class="card">
            <div class="card-header text-center"><h2 style="color: blue">NGARA HOMES</h2><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form role="form" method="post" action="">
                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                    <div class="form-group">
                        <input class="control" type="email" name="email" required="true" placeholder="Your Email" >

                    </div>
                     <div class="form-group">
                        <input class="control" type="type" name="phone" required="true" maxlength="10" pattern="[0-9]+" placeholder="Mobile Number">
                        
                    </div>
                    <div class="sub"><button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Reset</button></div>
                </form>
            </div>
            <div class="card-footer text-center">
                <span><a href="Regi/log.php">Sign In</a></span>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end forgot password  -->
    <!-- ============================================================== -->
</body>

 
</html>