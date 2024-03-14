<?php  
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['ETASaid']==0)) {
    header('location:logout.php');
} else {
    if(isset($_GET['delcat'])) {
        $row=intval($_GET['delcat']);
        $query=mysqli_query($con,"delete from categorytbl where ID='$row'");
        if($query) {
            echo "<script>alert('Record successfully deleted');</script>";
            echo "<script>window.location.href='manage_category.php'</script>";
        } else {
             echo "<script>alert('Something went wrong. Please try again.";
        }
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker And Sharing || Manage Category</title>
   <link href="assets/bootstrap-5.3.2-dist/css/datepicker3.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php include_once('header.php'); ?>   
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">Expense</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manage Expense</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Category Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret=mysqli_query($con,"select * from Categorytbl");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row['CategoryName'];?></td>
                                                <td><?php echo $row['CreatedAt'];?></td>
                                                <td>
                                                    <a href="#" class="edit-link">Edit</a>
                                                    <a href="manage_category.php?delcat=<?php echo $row['ID']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td colspan="5">
                                                    <form action="update_category.php" method="POST">
                                                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                                                        <input type="text" name="CategoryName" value="<?php echo $row['CategoryName']; ?>">
                                                        <input type="text" name="CreatedAt" value="<?php echo $row['CreatedAt']; ?>">
                                                        <button type="submit" name="save">Save</button>
                                                        <button type="button" class="cancel-edit">Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php 
                                            $cnt=$cnt+1;
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel-->
            </div><!-- /.col-->
            <?php include_once('../includes/footer.php');?>
        </div><!-- /.row -->
    </div><!--/.main-->
    <script src="assets/bootstrap-5.3.2-dist/js/jQuery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart.min.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/chart-data.js"></script>
<!-- Chart.js -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart.js"></script>
<!-- EasyPieChart -->
<script src="assets/bootstrap-5.3.2-dist/js/easypiechart-data.js"></script>
<script src="assets/bootstrap-5.3.2-dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            // Function to handle entering editing mode
            $('.edit-link').click(function(e){
                e.preventDefault();
                $(this).closest('tr').next().show(); // Show the editing mode form
            });

            // Function to handle exiting editing mode (Cancel)
            $('.cancel-edit').click(function(e){
                e.preventDefault();
                $(this).closest('tr').hide(); // Hide the editing mode form
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
