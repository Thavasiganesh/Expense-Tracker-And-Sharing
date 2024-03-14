<?php
session_start();
error_reporting(E_ALL);
include('../includes/dbconnection.php');
if (strlen($_SESSION['ETASaid']==0)) {
  header('location:logout.php');
  } else{ ?>
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Expense Tracker And Sharing || Add Expense</title>
  <link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
  <link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!--Custom Font-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <?php include_once('header.php');?>
    
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
      <ol class="breadcrumb">
        <li><a href="#">
          <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Registered Users</li>
      </ol>
    </div><!--/.row-->  
    <div class="row">
      <div class="col-lg-12">    
        <div class="panel panel-default">
          <div class="panel-heading">Registered Users</div>
          <div class="panel-body">
             </p>
            <div class="col-md-12">
              
              <form role="form" method="post" action="">
                <div class="form-group">
                  <label>From Date</label>
                  <input class="form-control" type="date" value="" name="fromdate" required="true">
                </div>
                <div class="form-group">
                  <label>To Date</label>
                  <input class="form-control" type="date" value="" name="todate" required="true">
                </div>
                <div class="form-group has-success">
                  <button type="submit" id="submitbtn" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
              <?php
               if (isset($_POST['submit'])) {
                $fdate=$_POST['fromdate'];
                $tdate=$_POST['todate'];
                ?>
              <div class="table-responsive">
                <div class="panel-heading">All Registered Users from <?php echo $fdate ?> to <?php echo $tdate ?></div>
                    <table class="table table-bordered mg-b-0">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ret=mysqli_query($con,"select * from userstbl where RegDate between '$fdate' and '$tdate';");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $row['FullName'];?></td>
                                    <td><?php echo $row['Email'];?></td>
                                    <td><?php echo $row['MobileNumber'];?></td>
                                    <td><?php echo $row['RegDate'];?></td>
                                </tr>
                                <?php 
                                $cnt=$cnt+1;
                            }
                          }?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once('../includes/footer.php');?>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
<!-- Chart.js -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
<!-- EasyPieChart -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script>
window.onload = function () {
    var chart1 = document.getElementById("line-chart").getContext("2d");
    window.myLine = new Chart(chart1).Line(lineChartData, {
        responsive: true,
        scaleLineColor: "rgba(0,0,0,.2)",
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleFontColor: "#c5c7cc"
    });
};

</script>
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
</body>
</html>
<?php }  ?>

