<?php

require 'db.php';

$cost_date = $_GET['cost_date'];
$query = "Select cost_name, cost_details, cost_amount, cost_date, cat_id From tbl_cost where cost_date = '$cost_date' ";
$costs = $connection->prepare($query);
$costs->execute();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "Select cost_name, cost_details, cost_amount, cost_date, cat_id From tbl_cost where cost_date = '$search' ";
    $costs = $connection->prepare($query);
    $costs->execute();
}

?>

<?php include 'header.php';?>

<div>
    <form action="" method="get">
        <input value="<?php echo $cost_date; ?>" type="date" name="search" placeholder="Search keyword..." />
        <input type="submit" name="submit" value="Search" />
    </form>
</div>
<div>
    <table>
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
foreach ($costs as $cost) {
    ?>
            <tr>
                <td><?php echo $cost['cost_name']; ?></td>
                <td><?php echo $cost['cost_details']; ?></td>
                <td><?php echo $cost['cost_amount']; ?></td>
                <td><?php echo $cost['cost_date']; ?></td>
                <td><?php echo $cost['cat_id']; ?></td>

            </tr>

        <?php }?>
    </table>
</div>


<?php include 'footer.php';?> -->