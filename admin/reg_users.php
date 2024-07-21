<?php  
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['ETASaid']==0)) {
    header('location:logout.php');
} else {
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker And Sharing || Registered Users</title>
   <link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php include_once('header.php'); ?>   
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">Registered Users</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Registered Users</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Registration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret=mysqli_query($con,"select * from userstbl");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['FullName'];?></td>
                                                <td><?php echo $row['Email'];?></td>
                                                <td><?php echo $row['MobileNumber'];?></td>
                                                <td><?php echo $row['RegDate'];?></td>
                                                <td>
                                                   
                                                    <a href="user_expense_details.php?userid=<?php echo $row['UserID']; ?> && username=<?php echo $row['FullName']; ?>">Expense Details</a>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cnt=$cnt+1;
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('../includes/footer.php');?>
        </div><!-- /.row -->
    </div><!--/.main-->
    <script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
<!-- Chart.js -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
<!-- EasyPieChart -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
    <script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>