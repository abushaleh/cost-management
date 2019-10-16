<?php
require 'db.php';

if (isset($_GET['month'])) {
    $month = $_GET['month'];
    $query = "SELECT * FROM tbl_cost WHERE  MONTH(cost_date) = MONTH(CURRENT_DATE()) LIKE '%-$month-%' ";
    $stmt = $connection->prepare($query);
    $stmt->execute();
}
?>

<?php include 'header.php';?>

<div>
    <form action="" method="get">
        <input type="date" name="month" placeholder="Search keyword..." />
        <input type="submit" name="submit" value="Search" />
    </form>
</div>
<div>
    <table border="1">
        <thead>
            <tr>
                <th>cost_name</th>
                <th>cost_details</th>
                <th>cost_amount</th>
                <th>cost_date</th>
                <th>cat_id</th>
            </tr>
        </thead>
        <?php
foreach ($stmt as $value) {
    ?>
        <tr>
            <td><?php echo $value['cost_name']; ?></td>
            <td><?php echo $value['cost_details']; ?></td>
            <td><?php echo $value['cost_amount']; ?></td>
            <td><?php echo $value['cost_date']; ?></td>
            <td><?php echo $value['cat_id']; ?></td>
        </tr>
        <?php }?>
    </table>
</div>

<?php include 'footer.php';?>