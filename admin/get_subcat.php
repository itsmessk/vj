<?php
include_once('includes/config.php');

if (!empty($_POST['cat_id'])) {
    $category_id = intval($_POST['cat_id']);
    $query = mysqli_query($con, "SELECT id, subcategoryName FROM subcategory WHERE categoryid = $category_id");

    echo "<option value=''>Select Subcategory</option>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='{$row['id']}'>{$row['subcategoryName']}</option>";
    }
}
?>
