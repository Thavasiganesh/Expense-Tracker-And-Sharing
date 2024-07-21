<?php
session_start();
error_reporting(E_ALL);
include('../includes/dbconnection.php');
if (strlen($_SESSION['ETASaid']) == 0) {
    header('location:logout.php');
    exit(); // Ensure script stops execution after redirection
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker And Sharing || User Expense Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
    <link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php');?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">CategoryWise User Expense Report</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">CategoryWise User Expense Report</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form role="form" method="post" action="" name="user_expenses_form">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input class="form-control" type="date"  id="fromdate" name="fromdate" required="true">
                                </div>
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input class="form-control" type="date"  id="todate" name="todate" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Users</label>
                                    <select class="form-control" id="users" required name="users">
                                        <option selected disabled>Select user</option>
                                        <?php
                                        $query = mysqli_query($con, "SELECT FullName,UserID FROM userstbl");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $username = $row['FullName'];
                                            $userid = $row['UserID'];
                                            echo "<option value='$userid' data-custom-value='$username' >$username</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group has-success">
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <?php
                            if (isset($_POST['submit'])) {
                                $userId = mysqli_real_escape_string($con, $_POST['users']);
                                $userName = mysqli_real_escape_string($con, $_POST['users']);
                                $fromDate = $_POST['fromdate'];
                                $toDate = $_POST['todate'];

                                $query = "SELECT
                                    categoriestbl.CategoryName,
                                    SUM(expensetbl.ExpenseCost) AS TotalExpenseCost
                                FROM
                                    expensetbl
                                JOIN categoriestbl ON expensetbl.ExpenseID = categoriestbl.ExpenseID
                                WHERE
                                    expensetbl.UserID = $userId
                                    AND expensetbl.ExpenseDate BETWEEN '$fromDate' AND '$toDate'
                                GROUP BY
                                    categoriestbl.CategoryName";

                                $result = mysqli_query($con, $query);

                                if ($result) {
                            ?>
                            		<div class="panel-heading">CategoryWise Expense Report</div>
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
                                            $cnt = 1;
                                            $totalsexp = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['CategoryName']; ?></td>
                                                    <td><?php echo $row['TotalExpenseCost']; ?></td>
                                                </tr>
                                            <?php
                                                $totalsexp += $row['TotalExpenseCost'];
                                                $cnt++;
                                            }
                                            ?>
                                            <tr>
                                                <th colspan="2" style="text-align:center">Grand Total</th>
                                                <td><?php echo $totalsexp; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                            <?php
                                } else {
                                    echo "Error fetching category names";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('../includes/footer.php');?>
        </div><!-- /.row -->
    </div><!--/.main-->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
    <script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
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
<?php } ?>
