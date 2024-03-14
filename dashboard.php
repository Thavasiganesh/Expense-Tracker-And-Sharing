<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['ETASuid'])==0) {
 header('location:logout.php');
  } else
  {
  	 
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Expense Tracker And Sharing - Dashboard</title>
	<link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
	 <link href="assets/bootstrap-5.3.2-dist/css/styles.css" rel="stylesheet">
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
	<?php include_once('includes/header.php'); ?>
		<div class="container-fluid">
		<div class="row">
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main container ">

			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		 
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Today Expense
$userid=$_SESSION['ETASuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(ExpenseCost)  as todaysexpense from expensetbl where (ExpenseDate)='$tdate' && (UserID='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_expense=$result['todaysexpense'];
 ?> 

						<h4>Today's Expense</h4>
						<div class="easypiechart" id="easypiechart-blue"  data-chart-type="today" data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_today_expense;?>" ><span class="percent"><?php if($sum_today_expense==""){
echo "0";
} else {
echo $sum_today_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yestreday Expense
$userid=$_SESSION['ETASuid'];
$ydate=date('Y-m-d',strtotime("-1 days"));
$query1=mysqli_query($con,"select sum(ExpenseCost)  as yesterdayexpense from expensetbl where (ExpenseDate)='$ydate' && (UserID='$userid');");
$result1=mysqli_fetch_array($query1);
$sum_yesterday_expense=$result1['yesterdayexpense'];
 ?> 
					<div class="panel-body easypiechart-panel">
						<h4>Yesterday's Expense</h4>
						<div class="easypiechart" id="easypiechart-orange"  data-chart-type="yesterday" data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_yesterday_expense;?>" ><span class="percent"><?php if($sum_yesterday_expense==""){
echo "0";
} else {
echo $sum_yesterday_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Weekly Expense
$userid=$_SESSION['ETASuid'];
 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
$crrntdte=date("Y-m-d");
$query2=mysqli_query($con,"select sum(ExpenseCost)  as weeklyexpense from expensetbl where ((ExpenseDate) between '$pastdate' and '$crrntdte') && (UserID='$userid');");
$result2=mysqli_fetch_array($query2);
$sum_weekly_expense=$result2['weeklyexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 7day's Expense</h4>
						<div class="easypiechart" id="easypiechart-teal"  data-chart-type="week" data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_weekly_expense;?>"><span class="percent"><?php if($sum_weekly_expense==""){
echo "0";
} else {
echo $sum_weekly_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Expense
$userid=$_SESSION['ETASuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(ExpenseCost)  as monthlyexpense from expensetbl where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserID='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_expense=$result3['monthlyexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Expenses</h4>
						<div class="easypiechart" id="easypiechart-red"  data-chart-type="month"data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_monthly_expense;?>" ><span class="percent"><?php if($sum_monthly_expense==""){
echo "0";
} else {
echo $sum_monthly_expense;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		</div><!--/.row-->
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Expense
$userid=$_SESSION['ETASuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(ExpenseCost)  as yearlyexpense from expensetbl where (year(ExpenseDate)='$cyear') && (UserID='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_expense=$result4['yearlyexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Expenses</h4>
						<div class="easypiechart" id="easypiechart-red"  data-chart-type="year"data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_yearly_expense;?>" ><span class="percent"><?php if($sum_yearly_expense==""){
echo "0";
} else {
echo $sum_yearly_expense;
}

	?></span></div>


					</div>
				
				</div>

			</div>

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Expense
$userid=$_SESSION['ETASuid'];
$query5=mysqli_query($con,"select sum(ExpenseCost)  as totalexpense from expensetbl where UserID='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_expense=$result5['totalexpense'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Expenses</h4>
						<div class="easypiechart" id="easypiechart-red"  data-chart-type="total"data-userid="<?php echo $userid; ?>" data-percent="<?php echo $sum_total_expense;?>" ><span class="percent"><?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}

	?></span></div>


					</div>
				
				</div>

			</div>


		</div>

		</div>
	
</div>

  </div>

	 </div> 
	  <!-- /.container-fluid -->
	</div>	
	<!--/.row-->
	</div>	<!--/.main-->
	<?php include_once('includes/footer.php');?> 
	
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

<!-- script>
  // Use noConflict mode and encapsulate your code within a function
  jQuery.noConflict();
     (function ($) {
    $(document).ready(function () {
    	var userId = $(this).data('userid');
//     	function loadCategoryExpenses() {
//     var selectedCategory = $('#categorySelect').val();
//     $.ajax({
//         type: 'POST',
//         url: 'get_category_expenses.php',
//         data: { userId: userId, category: selectedCategory },
//         success: function (response) {
//             $('#categoryExpensesBody').html(response);
//         },
//         error: function (error) {
//             console.error('Error fetching category-wise expenses:', error);
//         }
//     });
// }
      $('#calendar').datepicker({});


!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
	$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})
       $('.easypiechart').on('click', function () {
        var userId = $(this).data('userid');
        var chartType = $(this).data('chart-type');
        showCategoryInfo(userId, chartType);
      });
    });
function showCategoryInfo(userId, chartType) {

    // Get the selected date (you may need to adjust this based on your date picker implementation)
    // Fetch category information and populate the modal
    $.ajax({
        type: 'GET',
        url: 'get_category_names.php',
        data: { userId: userId, chartType: chartType},
        success: function (response) {
            $('#categoryInfoBody').html(response);
            $('#categoryInfoModal').modal('show');
        },
        error: function (error) {
            console.error('Error fetching category information:', error);
        }
    });
}

})(jQuery);

		</script> -->
<!-- Bootstrap Datepicker -->
	<script>
window.onload = function () {
    var chart1 = document.getElementById("#line-chart").getContext("2d");
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
			
<!-- Popper.js -->
<!-- Bootstrap JS -->
</body>
</html>
<?php } ?>