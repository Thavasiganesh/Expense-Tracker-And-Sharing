    <?php
    error_reporting(E_ALL);
    session_start();
    include('includes/dbconnection.php');

    // Check if the user is logged in
    if (!isset($_SESSION['ETASuid'])) {
        header("Location: login.php");
        exit();
    }
      

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form submission

        $expenseID = $_POST['expense_id'];
        $paidByUserID = $_SESSION['ETASuid']; // The user who paid the expense

        // Assuming you have a form field named 'shared_with_user' as an array of user IDs
        $sharedWithUserIDs = $_POST['shared_with_user'];
        
        $amount = $_POST['amount'];
        $description = $_POST['description'];
        $paymentLink = generatePaymentLink($expenseID, $amount);
        include 'sendemail/index.php';

        // Retrieve the selected expense details to get ExpenseID
        
    }
    //ieve the user's expenses to display in the form
    $uid = $_SESSION['ETASuid'];
    $expensesQuery = "SELECT ExpenseID, ExpenseCost, ExpenseItem FROM expensetbl WHERE UserID='$uid'";
    $expensesResult = mysqli_query($con, $expensesQuery);

    // Retrieve the user's friends or family members to display in the form
    $friendsQuery = "SELECT UserID, FullName FROM userstbl WHERE UserID <> '$uid';";
    $friendsResult = mysqli_query($con, $friendsQuery);
    // Retr

    ?>


    <!-- Your HTML code remains unchanged -->


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Share Expense</title>
        <!-- Bootstrap CSS -->
        <link href="assets/bootstrap-5.3.2-dist/css/dashboard.css" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
        <!-- Custom Styles -->
        <!-- <link href="assets/bootstrap-5.3.2-dist/css/styles.css" rel="stylesheet"> -->
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Expense</li>
                </ol>
            </div>

        <div class="container">
            <h2 class="panel-heading mb-4">Share Expense</h2>
            <hr>
            <form method="post" action="sendemail/index.php" id="expenseForm">
        <div class="form-group">
            <label for="expense_name">Select Expense:</label>
            <select class="form-control" name="expense_name" id="expense_name" required>
                <option value="" selected disabled>Select an Expense</option>
                <?php foreach ($expensesResult as $row): ?>
                    <option value="<?= $row['ExpenseItem'] ?>" data-max="<?= $row['ExpenseCost'] ?>">
                        <?= $row['ExpenseItem'] . ' - ₹' . $row['ExpenseCost'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="shared_with_user">Select Friends or Family Members to Share With:</label>
            <select class="form-control" name="shared_with_user[]" id="shared_with_user" required>
                <option selected disabled>Select Friends or Family Members</option>
                <?php while ($row = mysqli_fetch_assoc($friendsResult)) : ?>
                    <option value="<?= $row['UserID'] ?>" data-fullname="<?= $row['FullName'] ?>"><?= $row['FullName'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email to send:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" step="0.01" required placeholder="Amount should be less than Expense Cost">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="4" cols="30"></textarea>
        </div>
        <button type="submit" name="send" class="btn btn-primary">Share Expense</button>
    </form>
        </div>
    </div>
        <!-- Bootstrap JS and jQuery -->
        <script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
                <script>
            $(document).ready(function() {
                $('#expense_name').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var maxAmount = selectedOption.attr('data-max');
                    $('input[name="amount"]').attr('max', maxAmount);
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                $('#shared_with_user').change(function() {
                    var userID = $(this).val();
                    // AJAX call to fetch email based on selected user
                    $.ajax({
                        url: 'fetch_email.php',
                        type: 'POST',
                        data: { userID: userID },
                        success: function(response) {
                            $('#email').val(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
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
