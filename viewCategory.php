<?php
require 'db.php';

$query = "Select * From tbl_cat";
$stmt = $connection->prepare($query);
$stmt->execute();
$cats = $stmt->fetchAll();

?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($cats as $cat) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $cat['cat_name'] ?></td>
            </tr>
        <?php } ?>

    </tbody>
</table>
<div>
    <h4><a href="index.php">Home </a></h4>
    <h4><a href="addcategory.php">Create Category</a></h4>
</div>