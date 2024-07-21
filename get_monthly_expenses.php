<?php
session_start();
error_reporting(E_ALL);
include 'includes/dbconnection.php'; // Include your database connection script

// Replace 'userID' with the actual user ID (you can get this from your system)
$userID = $_SESSION['ETASuid']; // Example user ID

// Fetch monthly expenses made by the user
$sql = "SELECT MONTH(ExpenseDate) AS month, SUM(ExpenseCost) AS total_cost
        FROM expensetbl
        WHERE UserID = '$userID'
        GROUP BY MONTH(ExpenseDate)
";

$result = $con->query($sql);

if ($result) {
    $data = array_fill(1, 12, 0); // Initialize array with zeroes for all months
    while ($row = $result->fetch_assoc()) {
        $month = $row['month'];
        $data[$month] = $row['total_cost'];
    }
    // Convert data to JSON and return
    echo json_encode($data);
} else {
    // Handle query execution error
    echo "Error: " . $con->error;
}

// Close database connection
$con->close();
?>
