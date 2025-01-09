<?php
include_once('includes/config.php');

if (!empty($_POST['type_id'])) {
    $type_id = intval($_POST['type_id']);
    $query = mysqli_query($con, "SELECT id, categoryName FROM category WHERE type_id = $type_id");

    echo "<option value=''>Select Category</option>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='{$row['id']}'>{$row['categoryName']}</option>";
    }
}
?>
