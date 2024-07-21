<?php
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker And Sharing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="assets/bootstrap-5.3.2-dist/css/sidebar.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Expense Tracker And Sharing</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
                </li>

                <!-- Expenses Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="expensesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <em class="fa fa-navicon">&nbsp;</em> Expenses
                    </a>
                    <div class="dropdown-menu" aria-labelledby="expensesDropdown">
                        <a class="dropdown-item" href="add_expense.php"><span class="fa fa-arrow-right">&nbsp;</span> Add Expense</a>
                        <a class="dropdown-item" href="manage_expense.php"><span class="fa fa-arrow-right">&nbsp;</span> Manage Expense</a>
                        <a class="dropdown-item" href="share_expense.php"><span class="fa fa-arrow-right">&nbsp;</span> Share Expense</a>
                    </div>
                </li>

                <!-- Expense Report Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="expenseReportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <em class="fa fa-navicon">&nbsp;</em> Expense Report
                    </a>
                    <div class="dropdown-menu" aria-labelledby="expenseReportDropdown">
                        <a class="dropdown-item" href="expense_datewise_reports.php"><span class="fa fa-arrow-right">&nbsp;</span> Daywise</a>
                        <a class="dropdown-item" href="expense_monthwise_reports.php"><span class="fa fa-arrow-right">&nbsp;</span> Monthwise</a>
                        <a class="dropdown-item" href="expense_yearwise_reports.php"><span class="fa fa-arrow-right">&nbsp;</span> Yearwise</a>
                        <a class="dropdown-item" id="category"><span class="fa fa-arrow-right">&nbsp;</span> Categorywise</a>
                        <a class="dropdown-item" href="chart.html"><span class="fa fa-arrow-right">&nbsp;</span> Chartwise</a>
                    </div>
                </li>

                <!-- Add your other navigation links here -->
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change_password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Add this modal at the end of your HTML body -->
<div class="modal fade" id="categoryWiseModal" tabindex="-1" role="dialog" aria-labelledby="categoryWiseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #212529; color: white;">
                <h5 class="modal-title" id="categoryWiseModalLabel">Select Period for Categorywise Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryWiseForm" action="get_category_names.php" method="GET">
                    <div class="form-group">
                        <label for="periodSelect">Select Period:</label>
                        <select class="form-control" id="periodSelect" name="period">
                            <option value="today">Today's Expenses</option>
                            <option value="yesterday">Yesterday's Expenses</option>
                            <option value="week">Week Expenses</option>
                            <option value="month">Month Expenses</option>
                            <option value="year">Year Expenses</option>
                            <option value="Total">Total Expenses</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <script>
    $(document).ready(function() {
         
        // Handle click event on "Categorywise" dropdown item
        $('#category').on('click', function() {
            $('#categoryWiseModal').modal('show');
        });
    });
</script>

</body>
</html>