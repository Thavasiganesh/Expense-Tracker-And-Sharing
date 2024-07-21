<?php
include('includes/dbconnection.php');

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $userid = $_SESSION['ETASuid'];

    $query = mysqli_query($con, "SELECT * FROM expensetbl WHERE UserID='$userid' AND ExpenseCategory='$category'");
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if ($result) {
        foreach ($result as $expense) {
            echo '<p>' . $expense['ExpenseName'] . ' - $' . $expense['ExpenseCost'] . '</p>';
        }
    } else {
        echo '<p>No expenses found for this category.</p>';
    }
}
?>
