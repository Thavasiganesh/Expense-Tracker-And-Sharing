<?php
session_start();
error_reporting(E_ALL);
include('../includes/dbconnection.php');
if (strlen($_SESSION['ETASuid'])==0) {
 header('location:logout.php');
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ExpenseTrackerAndSharing@gmail.com';
    $mail->Password = 'qbrs jerp pkpb kfzt'; // Replace with your actual password
    $mail->SMTPSecure = 'ssl';
    $mail->Port= 465;
    $mail->setFrom('ExpenseTrackerAndSharing@gmail.com'); 
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = "Contribute to my expense";
    $uid=$_SESSION['ETASuid'];
    $senderQuery = "SELECT FullName, MobileNumber FROM userstbl WHERE UserID = '$uid'";
    $senderResult = mysqli_query($con, $senderQuery);
    $senderRow = mysqli_fetch_assoc($senderResult);
    // Construct the email body
    $expenseItem = $_POST['expense_name'];
    $amount = $_POST['amount'];
    $description = isset($_POST['description']) ? $_POST['description'] : 'No description provided';
    $senderName = $senderRow['FullName'];
    $senderContact = $senderRow['MobileNumber'];
    $mail->Body = "
        <p>Hello Dear,</p>
        <p>I hope this email finds you well.</p>
        <p>I'm reaching out to share an expense with you, and I believe your contribution would greatly benefit our shared endeavor. Below are the details of the expense:</p>
        <ul>
            <li><strong>Expense Item:</strong> $expenseItem</li>
            <li><strong>Amount:</strong> $amount</li>
            <li><strong>Description:</strong> $description</li>
        </ul>
        To pay your share of the expense, please click on the following link:
        <a href='http://localhost/public/Expense%20Tracker%20and%20Sharing/share_expense.php'>Pay Now</a>
        <p>Your contribution towards this expense would be greatly appreciated. Please review the details provided above and let me know if you have any questions or concerns.</p>
        <p>Thank you for your attention to this matter.</p>
        <p>Best regards,<br>
        $senderName<br>
        $senderContact</p>
    ";

    // Send the email
    if ($mail->send()) {
        echo "
            <script>
                alert('Sent Successfully');
                document.location.href = '../share_expense.php';
            </script>";
    } else {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>