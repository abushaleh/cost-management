<?php
require 'db.php';
$month = date('m');
$year = date('Y');

$query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id WHERE month(cost_date)=:month && year(cost_date)=:year GROUP BY cat_name";
$stmt = $connection->prepare($query);
$stmt->execute([':month' => $month, ':year' => $year]);
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

// print_r($data);
// exit();
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
            <td><?php echo $value->cat_name; ?></td>
            <td><?php echo $value->column_sum; ?></td>
        </tr>
        <?php }?>
    </table>
</div>

<?php include 'footer.php';?>