<?php
include('includes/dbconnection.php');
// Assuming you have a database connection established

if (isset($_GET['q'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['q']);

    // Adjust the SQL query based on your database schema
    $sql = "SELECT UserID, FullName FROM userstbl WHERE FullName LIKE '%$search_query%'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($users);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
