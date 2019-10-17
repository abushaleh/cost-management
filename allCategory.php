<?php
require 'db.php';
$month = date('m');
$year = date('Y');

$query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id WHERE month(cost_date)=:month && year(cost_date)=:year GROUP BY cat_name";
$stmt = $connection->prepare($query);
$stmt->execute([':month' => $month, ':year' => $year]);
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];

    $query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id WHERE month(cost_date)=:month && year(cost_date)=:year GROUP BY cat_name";
    $stmt = $connection->prepare($query);
    $stmt->execute([':month' => $month, ':year' => $year]);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

}

if (isset($_GET['jsondata'])) {
    $a = $b = array();
    foreach ($data as $d) {
        $a[] = $d['cat_name'];
        $b[] = $d['column_sum'];
    }
    echo json_encode(array('cat' => $a, 'cost' => $b));
    exit();
}

?>

<?php include 'header.php';?>

<h1>Search for any month expences</h1>
<div>
  <form action="" method="post">
        <div>
            <label for="">Month:</label>
            <input type="text" name="month">
        </div>
        <div>
            <label for="">Year:</label>
            <input type="text" name="year">
        </div>
        <div>
            <input type="submit" name="submit" value="Search">
        </div>
  </form>
</div>

<h1>Current month expences</h1>
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

<div style="max-width: 500px;">
    <canvas id="myChart"></canvas>
</div>

<?php include 'footer.php';?>