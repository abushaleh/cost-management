<?php

require 'db.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "Select cost_date, SUM(cost_amount) as expance From tbl_cost GROUP BY cost_date ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
?>

<?php include 'header.php';?>

<div>
    <form action="" method="get">
        <input type="date" name="search" placeholder="Search keyword..." />
        <input type="submit" name="submit" value="Search" />
    </form>
</div>
<div>
    <table>
        <thead>
            <tr>
                <th>cost_date</th>
                <th>cost_amount</th>
            </tr>
        </thead>
        <?php
foreach ($stmt as $value) {
    ?>
            <tr>
                <td><?php echo $value['cost_date']; ?></td>
                <td><?php echo $value['expance']; ?></td>
            </tr>

        <?php }?>
    </table>
</div>

<?php include 'footer.php';?>