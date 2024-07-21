<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker And Sharing</title>
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
include('includes/dbconnection.php');
include_once('includes/header.php');
// Fetch category names
$userId = $_SESSION['ETASuid'];
$tdate =   date('Y-m-d');
$chartType = $_GET['period'];
if ($chartType === 'today') {
$query = "SELECT expensetbl.ExpenseCost,expensetbl.ExpenseDate,expensetbl.ExpenseItem,categoriestbl.CategoryName, DATE_FORMAT(categoriestbl.CreatedAt, '%h:%i %p') AS CreatedTime FROM expensetbl JOIN categoriestbl ON expensetbl.UserID = categoriestbl.UserID AND expensetbl.ExpenseDate >= '$tdate' AND expensetbl.ExpenseDate < DATE_ADD('$tdate', INTERVAL 1 DAY) AND expensetbl.CategoryID = categoriestbl.CategoryID WHERE expensetbl.UserID = $userId GROUP BY expensetbl.ExpenseID,expensetbl.ExpenseCost,expensetbl.ExpenseDate,expensetbl.ExpenseItem,categoriestbl.CategoryName,categoriestbl.CreatedAt";
} elseif ($chartType === 'yesterday') {
//$ydate=date('Y-m-d',strtotime("-1 days"));

$query ="SELECT expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem,categoriestbl.CategoryName, DATE_FORMAT(categoriestbl.CreatedAt, '%h:%i %p') AS CreatedTime FROM expensetbl JOIN categoriestbl ON expensetbl.UserID = categoriestbl.UserID AND expensetbl.ExpenseDate >= DATE_ADD('$tdate', INTERVAL -1 DAY) AND expensetbl.ExpenseDate < '$tdate' AND expensetbl.CategoryID = categoriestbl.CategoryID WHERE expensetbl.UserID = $userId GROUP BY expensetbl.ExpenseID,expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem,categoriestbl.CategoryName, categoriestbl.CreatedAt";
} elseif ($chartType === 'week') {
   $query = "SELECT expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem, categoriestbl.CategoryName, DATE_FORMAT(categoriestbl.CreatedAt, '%h:%i %p') AS CreatedTime FROM expensetbl JOIN categoriestbl ON expensetbl.UserID = categoriestbl.UserID AND expensetbl.ExpenseDate >= DATE_ADD(CURDATE(), INTERVAL -6 DAY) -- Last 7 days
   AND expensetbl.ExpenseDate < CURDATE() + INTERVAL 1 DAY -- Up to today
   AND expensetbl.CategoryID = categoriestbl.CategoryID WHERE expensetbl.UserID = $userId GROUP BY expensetbl.ExpenseID,expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem, categoriestbl.CategoryName, categoriestbl.CreatedAt";
} elseif ($chartType === 'month') {
  $query = "SELECT
    expensetbl.ExpenseCost,
    expensetbl.ExpenseDate,
    expensetbl.ExpenseItem,
    GROUP_CONCAT(DISTINCT sub.CategoryName) AS CategoryName,
    GROUP_CONCAT(DISTINCT DATE_FORMAT(sub.CreatedAt, '%h:%i %p')) AS CreatedTime
FROM
    expensetbl
JOIN (
    SELECT ExpenseID, CreatedAt, GROUP_CONCAT(DISTINCT CategoryName) AS CategoryName
    FROM categoriestbl
    GROUP BY ExpenseID, CreatedAt
) sub ON expensetbl.ExpenseID = sub.ExpenseID
WHERE
    expensetbl.ExpenseDate >= CURDATE() - INTERVAL 30 DAY
    AND expensetbl.ExpenseDate < CURDATE() + INTERVAL 1 DAY
    AND expensetbl.UserID = $userId
GROUP BY
    expensetbl.ExpenseID, expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem;
";
} elseif ($chartType === 'year'){
   $query = "SELECT
    expensetbl.ExpenseCost,
    expensetbl.ExpenseDate,
    expensetbl.ExpenseItem,
    GROUP_CONCAT(DISTINCT sub.CategoryName) AS CategoryName,
    GROUP_CONCAT(DISTINCT DATE_FORMAT(sub.CreatedAt, '%h:%i %p')) AS CreatedTime
FROM
    expensetbl
JOIN (
    SELECT ExpenseID, CreatedAt, GROUP_CONCAT(DISTINCT CategoryName) AS CategoryName
    FROM categoriestbl
    GROUP BY ExpenseID, CreatedAt
) sub ON expensetbl.ExpenseID = sub.ExpenseID
WHERE
    YEAR(expensetbl.ExpenseDate) = YEAR(CURDATE()) -- Filter for the current year
    AND expensetbl.UserID = $userId
GROUP BY
    expensetbl.ExpenseID, expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem;
";
} else{
   $query = "SELECT
    expensetbl.ExpenseCost,
    expensetbl.ExpenseDate,
    expensetbl.ExpenseItem,
    GROUP_CONCAT(DISTINCT sub.CategoryName) AS CategoryName,
    GROUP_CONCAT(DISTINCT DATE_FORMAT(sub.CreatedAt, '%h:%i %p')) AS CreatedTime
FROM
    expensetbl
JOIN (
    SELECT ExpenseID, CreatedAt, GROUP_CONCAT(DISTINCT CategoryName) AS CategoryName
    FROM categoriestbl
    GROUP BY ExpenseID, CreatedAt
) sub ON expensetbl.ExpenseID = sub.ExpenseID
WHERE
    expensetbl.UserID = $userId
GROUP BY
    expensetbl.ExpenseID, expensetbl.ExpenseCost, expensetbl.ExpenseDate, expensetbl.ExpenseItem;
";

}
$result = mysqli_query($con, $query);
if ($result) {
    ?>
    <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Category Wise Expense</li>
            </ol>
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Wise Expense Details</h1>
            </div>
        </div><!--/.row-->
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0" style="width:60%" >
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Category Name</th>
                <th>Expense Item</th>
                <th>Expense Cost</th>
                <th>Expense Date</th>
                <th>Created At</th>
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
                    <td><?php echo $row['ExpenseItem']; ?></td>
                    <td><?php echo $ttlsl=$row['ExpenseCost']; ?></td>
                    <td><?php echo $row['ExpenseDate']; ?></td>
                    <td><?php echo $row['CreatedTime']; ?></td>
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
                $cnt=$cnt+1;
                ?>
            <?php }?>
                <tr>
                  <th colspan="3" style="text-align:center">Grand Total</th>     
                  <td><?php echo $totalsexp;?></td>
                 </tr>  
        </tbody>
    </table>
            </div>
        </div>
    
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
