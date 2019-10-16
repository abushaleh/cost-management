<?php
require 'db.php';

$query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id GROUP BY cat_name";
$stmt = $connection->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll();
// print_r($data);
// exit();

if(isset($_GET['jsondata'])){
    $a = $b = array();
    foreach($data as $d){
        $a[] = $d['cat_name'];
        $b[] = $d['column_sum'];
    }
    echo json_encode(array('cat'=>$a,'cost'=>$b));
    exit();
}

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

<div style="max-width: 500px;">
    <canvas id="myChart"></canvas>
</div>

<?php include 'footer.php';?>