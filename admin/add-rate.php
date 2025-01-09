<?php 
session_start();
include_once('includes/config.php');

// For Adding Gold and Silver Rate
if(isset($_POST['submit']))
{
    // Validate and sanitize input
    $gold_rate = filter_var($_POST['gold_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $silver_rate = filter_var($_POST['silver_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $createdby = $_SESSION['aid'];

    // Prepare the query using prepared statements to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO rates(gold_rate, silver_rate, created_by) VALUES(?, ?, ?)");
    $stmt->bind_param("ddi", $gold_rate, $silver_rate, $createdby);
    
    if($stmt->execute()) {
        echo "<script>alert('Rates added successfully');</script>";
        echo "<script>window.location.href='manage-rates.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Gold and Silver Rates</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('includes/header.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Gold and Silver Rates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Rates</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-2">Gold Rate</div>
                                    <div class="col-4">
                                    <input type="number" 
       step="0.01" 
       min="0" 
       placeholder="Enter Gold Rate" 
       name="gold_rate" 
       class="form-control" 
       required>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 1%;">
                                    <div class="col-2">Silver Rate</div>
                                    <div class="col-4">
                                    <input type="number" 
       step="0.01" 
       min="0" 
       placeholder="Enter Silver Rate" 
       name="silver_rate" 
       class="form-control" 
       required>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 1%;">
                                    <div class="col-2">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
function validateForm() {
    var goldRate = document.getElementsByName('gold_rate')[0].value;
    var silverRate = document.getElementsByName('silver_rate')[0].value;
    
    if(isNaN(goldRate) || isNaN(silverRate)) {
        alert('Please enter valid numbers');
        return false;
    }
    return true;
}
</script>
</body>
</html>
