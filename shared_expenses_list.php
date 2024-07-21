<?php
session_start();
include('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['ETASuid'])) {
    header("Location: login.php");
    exit();
}

// Retrieve shared expenses for the user
$uid = $_SESSION['ETASuid'];
$sharedExpensesQuery = "SELECT * FROM sharedexpensestbl WHERE PaidByUserID='$uid'";
$sharedExpensesResult = mysqli_query($con, $sharedExpensesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shared Expenses List</title>
    <!-- Include Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/9.1.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.1.2/firebase-messaging.js"></script>
    <!-- Firebase initialization script -->
    <script>
        import { initializeApp } from "firebase/app";
        import { getMessaging } from "firebase/messaging";

        // Initialize Firebase
        const app = initializeApp({
            // Your Firebase configuration
        });

        // Initialize Firebase Messaging
        const messaging = getMessaging(app);
        
        // Request permission for push notifications and retrieve the device token
        messaging.requestPermission()
            .then(() => messaging.getToken())
            .then((token) => console.log('Device token:', token))
            .catch((error) => console.error('Unable to get permission or token:', error));

        // Listen for token refresh events
        messaging.onTokenRefresh(() => {
            messaging.getToken().then((refreshedToken) => console.log('Token refreshed:', refreshedToken));
        });
    </script>
</head>
<body>
    <h2>Shared Expenses List</h2>

    <?php
    if (mysqli_num_rows($sharedExpensesResult) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ExpenseID</th><th>PaidByUserID</th><th>SharedWithUserID</th><th>Amount</th><th>Description</th><th>CreatedAt</th></tr>";
        
        while ($row = mysqli_fetch_assoc($sharedExpensesResult)) {
            echo "<tr>";
            echo "<td>" . $row['ExpenseID'] . "</td>";
            echo "<td>" . $row['PaidByUserID'] . "</td>";
            echo "<td>" . $row['SharedWithUserID'] . "</td>";
            echo "<td>" . $row['Amount'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['CreatedAt'] . "</td>";
            echo "</tr>";
            
            // Get the mobile number of the user to whom the expense is shared
            $sharedWithUserID = $row['SharedWithUserID'];
            $getUserMobileQuery = "SELECT MobileNumber FROM userstbl WHERE UserID='$sharedWithUserID'";
            $userMobileResult = mysqli_query($con, $getUserMobileQuery);

            if ($userMobileResult && $userMobile = mysqli_fetch_assoc($userMobileResult)) {
                $toPhoneNumber = $userMobile['MobileNumber'];

                // Your SMS gateway email address (replace with the appropriate carrier's gateway)
                $smsGatewayEmail = '9543395034@airtelmobile.com';

                // Your SMS message
                $smsMessage = "You have a new expense shared with you: " . $row['Description'];

                // Compose the email address for the SMS gateway
                $smsGateway = $toPhoneNumber . '@' . $smsGatewayEmail;

                // Send SMS using email-to-SMS gateway
                mail($smsGateway, '', $smsMessage);
            }
        }

        echo "</table>";
    } else {
        echo "No shared expenses found.";
    }
    ?>
</body>
</html>