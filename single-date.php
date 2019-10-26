<?php

require 'db.php';

@$cost_date = $_GET['cost_date'];

// $date = explode('-', $cost_date);
// $month = $date[0];
// $day   = $date[1];
// $year  = $date[2];
//echo $date[0];
//print_r($date);
//exit();
$query = "Select * From tbl_cost where  cost_date = '$cost_date'";
$costs = $connection->prepare($query);
$costs->execute();
$results = $costs->fetchAll();

$cost_name = array();
$cost_amount = array();
foreach ($results as $result) {
    $cost_name[] = $result['cost_name'];
    $cost_amount[] = $result['cost_amount'];
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "Select cost_name, cost_details, cost_amount, cost_date, cat_id From tbl_cost where cost_date = '$search' ";
    $costs = $connection->prepare($query);
    $costs->execute();
    $results = $costs->fetchAll();

    $cost_name = array();
    $cost_amount = array();
    foreach ($results as $result) {
        $cost_name[] = $result['cost_name'];
        $cost_amount[] = $result['cost_amount'];
    }
}

?>

<?php include 'header.php'; ?>
<h4><a href="index.php">Home </a></h4>
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
                <!-- <th>cat_id</th> -->
            </tr>
        </thead>
        <?php
        foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo $result['cost_name']; ?></td>
                <td><?php echo $result['cost_details']; ?></td>
                <td><?php echo $result['cost_amount']; ?></td>
                <td><?php echo $result['cost_date']; ?></td>
                <td><?php //echo $result['cat_id']; 
                        ?></td>

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
            labels: <?php echo json_encode($cost_name) ?>, //[a,b,c,d]
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($cost_amount) ?>, // [5,8,6,45]
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