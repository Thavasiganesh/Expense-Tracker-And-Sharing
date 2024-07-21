<?php
include '../includes/dbconnection.php'; // Include your database connection script

$sql = "SELECT c.CategoryName, SUM(e.ExpenseCost) AS TotalExpense
        FROM categoriestbl c
        LEFT JOIN expensetbl e ON c.CategoryID = e.CategoryID
        GROUP BY c.CategoryID";

$result = $con->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['CategoryName']] = $row['TotalExpense'];
}

// Convert data to JSON and return
echo json_encode($data);

// Close database connection
$con->close();
?>
