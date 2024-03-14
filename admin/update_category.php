 <?php  
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if(isset($_POST['save'])) {

    // Sanitize the input data to prevent SQL injection
    $catid = $_POST['ID'];
    $catname = $_POST['CategoryName'];
    $createdat = $_POST['CreatedAt'];

    // Your SQL UPDATE statement to update the record in the database
    $query = "UPDATE categorytbl SET CategoryName = '$catname', CreatedAt = '$createdat' WHERE ID = $catid";

    // Execute the query
    if(mysqli_query($con, $query)) {
        // If the update is successful, send a success response
       echo "<script>alert('Category has been updated');</script>";
       echo "<script>window.location.href='manage_category.php'</script>";
    } else {
        // If there's an error with the query execution, send an error response
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
} else {
    // If the necessary POST data is not set, send a bad request response
    http_response_code(400);
    echo "Bad Request: Missing required parameters";
} ?>