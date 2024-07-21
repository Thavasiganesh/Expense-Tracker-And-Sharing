<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['ETASuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$userid=$_SESSION['ETASuid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select UserID from userstbl where UserID='$userid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update userstbl set Password='$newpassword' where UserID='$userid'");
$msg= "Your password successully changed"; 
} else {

$msg="Your current password is wrong";
}



}

  
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expense Tracker And Sharing|| Change Password</title>
	<link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
	<link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>
</head>
<body>
	<?php include_once('includes/header.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Change Password</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Change Password</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['ETASuid'];
$ret=mysqli_query($con,"select * from userstbl where UserID='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
							<form role="form" method="post" action="" name="changepassword" onsubmit="return checkpass();">
								<div class="form-group">
									<label>Current Password</label>
									<input type="password" name="currentpassword" class=" form-control" required= "true" value="">
								</div>
								<div class="form-group">
									<label>New Password</label>
									<input type="password" name="newpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirmpassword" class="form-control" value="" required="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Change</button>
								</div>
								
								
								</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="assets/bootstrap-5.3.2-dist/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/chart.min.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
	<script src="assets/bootstrap-5.3.2-dist/js/custom.js"></script>
	<script>
    $(document).ready(function(){
        $('[data-toggle="collapse"]').on('click', function () {
            $($(this).data('target')).toggleClass('show');
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php }  ?>