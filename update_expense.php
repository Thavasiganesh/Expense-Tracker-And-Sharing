 <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
// Check if the necessary POST data is set
if(isset($_POST['save'])) {

    // Sanitize the input data to prevent SQL injection
    $expenseId = intval($_POST['expenseId']);
    $expenseItem = $_POST['expenseItem'];
    $expenseCost = $_POST['expenseCost'];
    $expenseDate = $_POST['expenseDate'];

    // Your SQL UPDATE statement to update the record in the database
    $query = "UPDATE expensetbl SET ExpenseItem = '$expenseItem', ExpenseCost = '$expenseCost', ExpenseDate = '$expenseDate' WHERE ExpenseID = $expenseId";

    // Execute the query
    if(mysqli_query($con, $query)) {
        // If the update is successful, send a success response
       echo "<script>alert('Expense has been updated');</script>";
       echo "<script>window.location.href='manage_expense.php'</script>";
    } else {
        // If there's an error with the query execution, send an error response
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
} else {
    // If the necessary POST data is not set, send a bad request response
    http_response_code(400);
    echo "Bad Request: Missing required parameters";
}
?>
