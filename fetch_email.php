<?php
// Include your database connection file
include('includes/dbconnection.php');

// Check if the userID is set in the POST request
if(isset($_POST['userID'])) {
    // Sanitize the userID to prevent SQL injection
    $userID = mysqli_real_escape_string($con, $_POST['userID']);

    // Query to fetch the email of the selected user
    $query = "SELECT Email FROM userstbl WHERE UserID = '$userID'";

    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if($result) {
        // Fetch the email from the result set
        $row = mysqli_fetch_assoc($result);
        $email = $row['Email'];

        // Return the email as response
        echo $email;
    } else {
        // If query fails, return an error message
        echo "Error: Unable to fetch email.";
    }
} else {
    // If userID is not set in the POST request, return an error message
    echo "Error: userID not provided.";
}

// Close the database connection
mysqli_close($con);
?>
