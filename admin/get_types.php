<?php 
include_once('includes/config.php');

$sql = mysqli_query($con, "SELECT * FROM `type`");
while ($row = mysqli_fetch_array($sql)) {
    echo "<option value='{$row['id']}'>{$row['typeName']}</option>";
}
?>
