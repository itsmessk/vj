<?php
session_start();
include_once 'includes/config.php';
?>
<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}
function f3() {
    window.print();
}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Jewellery Shop Management System - Track Order</title>
<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .button-group {
        text-align: center;
        margin-top: 20px;
    }

    .button-group input {
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
        font-size: 16px;
    }

    .button-group input:hover {
        background-color: #0056b3;
    }

    .button-group input:active {
        background-color: #003f7f;
    }

    .tracking-header {
        background-color: #007bff;
        color: white;
        padding: 10px 0;
        font-size: 18px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .remark-status {
        font-size: 14px;
    }

</style>
</head>
<body>

<div class="container">
    <?php
    $orderid = intval($_GET['oid']);
    $ret = mysqli_query($con, "SELECT tbltracking.OrderCanclledByUser, tbltracking.remark, tbltracking.status AS bstatus, tbltracking.StatusDate 
                                FROM tbltracking WHERE tbltracking.OrderId = '$orderid'");
    $cnt = 1;
    ?>

    <div class="tracking-header">
        <h2>Tracking History of Order #<?php echo $orderid; ?></h2>
    </div>

    <table>
        <tr>
            <th>#</th>
            <th>Remark</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        <?php  
        while ($row = mysqli_fetch_array($ret)) { 
            $cancelledby = $row['OrderCanclledByUser'];
        ?>
        <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo $row['remark']; ?></td>
            <td class="remark-status"><?php echo $row['bstatus']; 
            if ($cancelledby == 1) {
                echo " (by user)";
            } else {
                echo " (by shop)";
            }
            ?></td>
            <td><?php echo $row['StatusDate']; ?></td>
        </tr>
        <?php $cnt++; } ?>
    </table>

    <div class="button-group">
        <input type="button" value="Close" onClick="return f2();" />
        <input type="button" value="Print" onClick="return f3();" />
    </div>
</div>

</body>
</html>
