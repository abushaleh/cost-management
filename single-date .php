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

// if (isset($_GET['search'])) {
//     $search = $_GET['search'];
//     $query = "Select cost_name, cost_details, SUM(cost_amount) as cost_amount, cat_id From tbl_cost where cost_date = '$search' GROUP BY cost_date ";
//     $costs = $connection->prepare($query);
//     $costs->execute();
// }
// $sql = 'select * FROM tbl_cost INNER JOIN tbl_cat ON tbl_cost.cat_id = tbl_cat.cat_id WHERE cost_id=:cost_id';
// $statement = $connection->prepare($sql);
// $statement->execute([':cost_id' => $cost_id]);
// $cost = $statement->fetch(PDO::FETCH_OBJ);

// $costs = [];
// if (isset($_GET['search'])) {
//     $search = $_GET['search'];
//     $query = "Select * From tbl_cost Where cost_date Like '%$search%' ";
//     $stmt = $connection->prepare($query);
//     $stmt->execute();
//     $costs = $stmt->fetchAll();
// }

// $data = array();
// foreach ($costs as $value) {
//     $data[$value['cost_id']]['cost_name'] = $value['cost_name'];
//     $data[$value['cost_id']]['cost_amount'] = $value['cost_amount'];
// }
// echo json_encode($data);

// $dataPoints = array(
//     array("label" => "Chrome", "y" => 64.02),
//     array("label" => "Firefox", "y" => 12.55),
//     array("label" => "IE", "y" => 8.47),
//     array("label" => "Safari", "y" => 6.08),
//     array("label" => "Edge", "y" => 4.29),
//     array("label" => "Others", "y" => 4.59),
// )
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


<!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script>
    window.onload = function() {


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Everyday expence"
            },
            // subtitles: [{
            // 	text: "November 2017"
            // }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{cost_name} ({cost_amount})",
                dataPoints: <?php //echo json_encode($data, JSON_NUMERIC_CHECK);
?>
            }]
        });
        chart.render();

    }
</script>



<?php include 'footer.php';?> -->