<?php

require 'db.php';
$month = date('m');
$year = date('Y');
// echo $month;
// exit();
$query = "Select cost_date, SUM(cost_amount) as expance From tbl_cost Where month(cost_date) = '$month' && year(cost_date) = '$year' GROUP BY cost_date ";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll();

$cost_date = array();
$expance = array();
foreach ($results as $result) {
    //array_push($categories, $value->cat_name);
    //array_push($categories, $value->column_sum);
    $cost_date[] = $result['cost_date'];
    $expance[] = $result['expance'];
}

if (isset($_POST['search'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];

    $query = "Select cost_date, SUM(cost_amount) as expance From tbl_cost Where month(cost_date) = '$month' && year(cost_date) = '$year' GROUP BY cost_date ";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    //print_r($results);
    //exit();
    $cost_date = array();
    $expance = array();
    foreach ($results as $result) {
        //array_push($categories, $value->cat_name);
        //array_push($categories, $value->column_sum);
        $cost_date[] = $result['cost_date'];
        $expance[] = $result['expance'];
    }
}

?>

<?php include 'header.php'; ?>

<div>
    <h4><a href="index.php">Home </a></h4>
</div>

<form action="" method="post">
    <div>
        <label>Month</label>
        <input type="number" name="month">
    </div>
    <div>
        <label>Year</label>
        <input type="number" name="year" placeholder="2019">
    </div>
    <div>
        <input type="submit" name="search" value="Search">
    </div>
</form>

<div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Cost Date</th>
                <th>Cost Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($results as $result) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['cost_date']; ?></td>
                    <td><?php echo $result['expance']; ?></td>
                </tr>

            <?php }  ?>
        </tbody>
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
            labels: <?php echo json_encode($cost_date) ?>, //[a,b,c,d]
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($expance) ?>, // [5,8,6,45]
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