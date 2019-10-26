<?php
require 'db.php';
$month = date('m');
$year = date('Y');

$query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id WHERE month(cost_date)=:month && year(cost_date)=:year GROUP BY cat_name";
$stmt = $connection->prepare($query);
$stmt->execute([':month' => $month, ':year' => $year]);
$data = $stmt->fetchAll(PDO::FETCH_OBJ);

$categories = array();
$amount = array();
foreach ($data as $value) {
    //array_push($categories, $value->cat_name);
    //array_push($categories, $value->column_sum);
    $categories[] = $value->cat_name;
    $amount[] = $value->column_sum;
}
// $a = $b = array();
// foreach ($data as $d) {
//     $a[] = $d->cat_name;
//     $b[] = $d->column_sum;
// }

// print_r($a);
// exit();


//$firstname = array_column($data, 'cat_name');
//print_r($data);
//exit();
if (isset($_POST['submit'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];

    $query = "SELECT cat_name,SUM(cost_amount) as column_sum FROM tbl_cost inner join tbl_cat on tbl_cost.cat_id=tbl_cat.cat_id WHERE month(cost_date)=:month && year(cost_date)=:year GROUP BY cat_name";
    $stmt = $connection->prepare($query);
    $stmt->execute([':month' => $month, ':year' => $year]);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    $categories = array();
    $amount = array();
    foreach ($data as $value) {
        //array_push($categories, $value->cat_name);
        //array_push($categories, $value->column_sum);
        $categories[] = $value->cat_name;
        $amount[] = $value->column_sum;
    }
}

// if (isset($_GET['jsondata'])) {
//     $a = $b = array();
//     foreach ($data as $d) {
//         $a[] = $d['cat_name'];
//         $b[] = $d['column_sum'];
//     }
//     echo json_encode(array('cat' => $a, 'cost' => $b));
//     exit();
// }

?>

<?php include 'header.php'; ?>
<h4><a href="index.php">Home </a></h4>

<h4>Search month</h4>
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

<h5>Current month expences</h5>
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
        <?php } ?>
    </table>
</div>

<div style="max-width: 500px;">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<?php include 'footer.php'; ?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($categories) ?>, //[a,b,c,d]
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($amount) ?>, // [5,8,6,45]
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>