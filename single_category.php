<?php
require 'db.php';

$cat_id = $_GET['cat_id'];
$month = date('m');
$year = date('Y');
// echo $month;
// exit();

$sql = 'SELECT * from tbl_cost WHERE cat_id=:cat_id && month(cost_date)=:month && year(cost_date)=:year';
$stmt = $connection->prepare($sql);
$stmt->execute([':cat_id' => $cat_id, ':month' => $month, ':year' => $year]);
$values = $stmt->fetchAll(PDO::FETCH_OBJ);

$cost_date = array();
$cost_amount = array();
foreach ($values as $value) {
  //array_push($categories, $value->cat_name);
  //array_push($categories, $value->column_sum);
  $cost_date[] = $value->cost_date;
  $cost_amount[] = $value->cost_amount;
}

$sql = 'SELECT * from tbl_cat';
$stmt = $connection->prepare($sql);
$stmt->execute();
$catagories = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['submit'])) {
  $cat_id = $_GET['cat_id'];
  $sql = "SELECT * from tbl_cost WHERE cat_id=:cat_id && month(cost_date)=:month && year(cost_date)=:year";
  $stmt = $connection->prepare($sql);
  $stmt->execute([':cat_id' => $cat_id, ':month' => $month, ':year' => $year]);
  $values = $stmt->fetchAll(PDO::FETCH_OBJ);

  // print_r($values);
  // exit();
  $cost_date = array();
  $cost_amount = array();
  foreach ($values as $value) {
    //array_push($categories, $value->cat_name);
    //array_push($categories, $value->column_sum);
    $cost_date[] = $value->cost_date;
    $cost_amount[] = $value->cost_amount;
  }
}
?>

<?php include 'header.php'; ?>

<h4><a href="index.php">Home </a></h4>
<a href="allCategory.php">Search All Category</a> <br><br>


<div>
  <form action="" method="get">
    <select name="cat_id">
      <option>-- select category --</option>
      <?php foreach ($catagories as $category) : ?>
        <option value="<?= $category->cat_id; ?>"> <?= $category->cat_name; ?></option>
      <?php endforeach; ?>
    </select>
    <input type="submit" name="submit" value="Search" />
  </form>
</div>
<br><br>
<div>
  <table border="1">
    <thead>
      <tr>
        <th>cost_name</th>
        <th>cost_details</th>
        <th>cost_amount</th>
        <th>cost_date</th>
      </tr>
    </thead>
    <?php
    foreach ($values as $value) {
      ?>
      <tr>
        <td><?= $value->cost_name; ?></td>
        <td><?= $value->cost_details; ?></td>
        <td><?= $value->cost_amount; ?></td>
        <td><?= $value->cost_date; ?></td>
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
      labels: <?php echo json_encode($cost_date) ?>, //[a,b,c,d]
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