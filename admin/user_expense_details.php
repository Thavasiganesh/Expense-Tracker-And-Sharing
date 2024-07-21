<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Expense Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
     <link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
<?php
session_start();
error_reporting(E_ALL);
// Include your database connection file here
include('../includes/dbconnection.php');
include_once('header.php');
$userId = $_GET['userid'];
$name = $_GET['username'];
$query = "SELECT
    categoriestbl.CategoryName,
    SUM(expensetbl.ExpenseCost) AS TotalExpenseCost
FROM
    expensetbl
JOIN categoriestbl ON expensetbl.ExpenseID = categoriestbl.ExpenseID
WHERE
    expensetbl.UserID = $userId
GROUP BY
    categoriestbl.CategoryName;";
$result = mysqli_query($con, $query);
if ($result) {
    ?>
<div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">CategoryWise Expense Report</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">CategoryWise Expense Report Of <?php echo $name ?></div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Category</th>
                <th>Expense Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cnt=1;
            $totalsexp=0; 
            while ($row = mysqli_fetch_assoc($result) ) {
                ?>
                <tr>
                    <td><?php echo $cnt;?></td>
                    <td><?php echo $row['CategoryName']; ?></td>
                    <td><?php echo $ttlsl=$row['TotalExpenseCost']; ?></td>
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
                $cnt=$cnt+1;
                ?>
            <?php }?>
                <tr>
                  <th colspan="2" style="text-align:center">Grand Total</th>     
                  <td><?php echo $totalsexp;?></td>
                 </tr>  
        </tbody>
    </table>
    <?php
} else {
    echo "alert('Error fetching category names')";
}
?>
<?php include_once('includes/footer.php');?>    
  <script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
<!-- Chart.js -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
<!-- EasyPieChart -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
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
