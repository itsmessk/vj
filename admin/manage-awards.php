<?php
session_start();
include_once('includes/config.php');

// Code for deletion
if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = mysqli_query($con, "delete from awards where id = '$id'");
    echo "<script>alert('Award deleted successfully');</script>";
    echo "<script>window.location.href='manage-awards.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Awards</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('includes/header.php');?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php');?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Awards</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Awards</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Awards List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = mysqli_query($con, "select * from awards");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo $row['title'];?></td>
                                        <td><?php echo date('d M Y', strtotime($row['award_date']));?></td>
                                        <td><?php echo $row['category'];?></td>
                                        <td><img src="uploads/<?php echo $row['image'];?>" width="100"></td>
                                        <td>
                                            <a href="edit-award.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="manage-awards.php?del=<?php echo $row['id'];?>" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Do you really want to delete?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('includes/footer.php');?>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/simple-datatables@latest"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>