<?php
error_reporting(0);
include('../includes/dbconnection.php');
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
                        <em class="fa fa-list">&nbsp;</em> Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="expensesDropdown">
                        <a class="dropdown-item" href="add_category.php"><span class="fa fa-arrow-right">&nbsp;</span> Add </a>
                        <a class="dropdown-item" href="manage_category.php"><span class="fa fa-arrow-right">&nbsp;</span> Manage </a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="reg_users.php"><em class="fa fa-user">&nbsp;</em> Reg Users </a>
                </li>
                <!-- Expense Report Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="expenseReportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <em class="fa fa-navicon">&nbsp;</em> Reports
                    </a>
                    <div class="dropdown-menu" aria-labelledby="expenseReportDropdown">
                        <a class="dropdown-item" href="user_expenses.php"><span class="fa fa-arrow-right">&nbsp;</span> User Expenses</a>
                        <a class="dropdown-item" href="reg_users_report.php"><span class="fa fa-arrow-right">&nbsp;</span> Registered Users</a>
                        <a class="dropdown-item" href="chart.html"><span class="fa fa-arrow-right">&nbsp;</span> Chart Report Category</a>
                    </div>
                </li>

                <!-- Add your other navigation links here -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a>
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
<script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>