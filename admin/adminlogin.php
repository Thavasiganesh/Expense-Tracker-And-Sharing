<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select * from userstbl where Password='$password';");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
    	$_SESSION['ETASaid']=$ret['UserID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expense Tracker And Sharing</title>
	<link rel="stylesheet" href="assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
	<link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
	<!-- <link href="assets/bootstrap-5.3.2-dist/css/styles.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-5.3.2-dist/css/styles1.css">
</head>
<body>
    <div class="row">
			<h2 align="center">Expense Tracker And Sharing</h2>
	<hr />
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" align="center" >
			<div class="login-panel panel panel-default">
				<div class="panel-heading" align="center">Log in</div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" id="" name="login">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
							</div>
							<a href="forgot_password.php">Forgot Password?</a>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required="true">
							</div>
							<div class="checkbox">
								<button type="submit" value="login" name="login" class="btn btn-primary">login</button><span>
								<a href="register.php" class="btn btn-primary">Register</a></span>
							</div>
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	<script src="	assets/bootstrap-5.3.2-dist/css/bootstrap.min.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/jquery-1.11.1.min.js"></script>
</body>

</html>