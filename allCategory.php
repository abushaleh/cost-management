<?php
require 'db.php';

$query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cat INNER JOIN tbl_cost GROUP BY cat_name ";
$stmt = $connection->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll();

?>

<?php include 'header.php';?>


<div>
    <table border="1">
        <thead>
            <tr>
                <th>cat_name</th>
                <th>Amount</th>
            </tr>
        </thead>
        <?php
foreach ($data as $value) {
    ?>
        <tr>
            <td><?php echo $value['cat_name']; ?></td>
            <td><?php echo $value['column_sum']; ?></td>
        </tr>
        <?php }?>
    </table>
</div>

<?php include 'footer.php';?>