<?php
require 'db.php';

if (isset($_GET['multiple'])) {
    $multiple = $_GET['multiple'];
    $query = "SELECT * FROM tbl_cost WHERE YEAR(cost_date) = '2019' AND MONTH(cost_date) = '12' ";
    $stmt = $connection->prepare($query);
    $stmt->execute();

}
?>

<?php include 'header.php';?>

<div>
    <form action="" method="get">
        <input type="date" name="multiple" placeholder="Search keyword..." />
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
                <th>cat_name</th>
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
            <td><?php echo $value['cat_name']; ?></td>
        </tr>
        <?php }?>
    </table>
</div>

<?php include 'footer.php';?>