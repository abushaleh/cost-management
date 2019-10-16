<?php

require 'db.php';
$costs = [];
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "Select * From tbl_cost Where cost_date Like '%$search%' ";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $costs = $stmt->fetchAll();
}

$data = array();
foreach ($costs as $value) {
    $data[$value['cost_id']]['cost_name'] = $value['cost_name'];
    $data[$value['cost_id']]['cost_amount'] = $value['cost_amount'];
}
echo json_encode($data);

$dataPoints = array(
    array("label" => "Chrome", "y" => 64.02),
    array("label" => "Firefox", "y" => 12.55),
    array("label" => "IE", "y" => 8.47),
    array("label" => "Safari", "y" => 6.08),
    array("label" => "Edge", "y" => 4.29),
    array("label" => "Others", "y" => 4.59),
)
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
                <th>cost_name</th>
                <th>cost_details</th>
                <th>cost_amount</th>
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
                <td><?php echo $cost['cat_id']; ?></td>

            </tr>

        <?php }?>
    </table>
</div>


<div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
		dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>



<?php include 'footer.php';?>