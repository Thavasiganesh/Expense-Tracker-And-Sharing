<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ETASuid']==0)) {
  header('location:logout.php');
  } else{

  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Expense Tracker And Sharing || Yearwise Expense Report</title>
	<link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
	<link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Yearwise Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Yearwise Expense Report</div>
					<div class="panel-body">
						<div class="col-md-12">
					


							<form role="form" method="post" action="expense_yearwise_reports_detailed.php" name="bwdatesreport">
						    <div class="form-group">
						        <label>From Year</label>
						        <select id="fromyear" name="fromyear">
						        <?php
						        // Get the current year
						        $currentYear = date("Y");
						        
						        // Define the range of years you want to display (e.g., 10 years in the past and 10 years in the future)
						        $startYear = $currentYear - 100;
						        $endYear = $currentYear;
						        
						        // Generate options for each year in the range
						        for ($year = $startYear; $year <= $endYear; $year++) {
						            if ($year == 2000) {
						                echo "<option value='$year' selected>$year</option>";
						            } else {
						                echo "<option value='$year'>$year</option>";
						            }
						        }
						        ?>
						    </select>
						    </div>
						    <div class="form-group">
						        <label>To Year</label>
						         <select id="toyear" name="toyear">
						        <?php
						        // Get the current year
						        $currentYear = date("Y");
						        
						        // Define the range of years you want to display (e.g., 10 years in the past and 10 years in the future)
						        $startYear = $currentYear - 100;
						        $endYear = $currentYear;
						        
						        // Generate options for each year in the range
						        for ($year = $startYear; $year <= $endYear; $year++) {
						            if ($year == 2000) {
						                echo "<option value='$year' selected>$year</option>";
						            } else {
						                echo "<option value='$year'>$year</option>";
						            }
       							 }
						        ?>
						    </select>
						    </div>

						    <div class="form-group has-success">
						        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
						    </div>
						</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
<!-- Chart.js -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
<!-- EasyPieChart -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
	function formatDate(input) {
	    const date = new Date(input.value);
	    const year = date.getFullYear();
	    const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Adding padding for month
    const day = date.getDate().toString().padStart(2, '0'); // Adding padding for day
    const formattedDate = `${year}-${month}-${day}`;
	    input.value = formattedDate;
	}
	</script>
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
