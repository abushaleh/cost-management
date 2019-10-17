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

$sql = 'SELECT * from tbl_cat';
$stmt = $connection->prepare($sql);
$stmt->execute();
$catagories = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_GET['search'])) {
    $cat_id = $_GET['cat_id'];
    $sql = "SELECT * from tbl_cost WHERE cat_id=:cat_id && month(cost_date)=:month && year(cost_date)=:year";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':cat_id' => $cat_id, ':month' => $month, ':year' => $year]);
    $values = $stmt->fetchAll(PDO::FETCH_OBJ);

    // print_r($values);
    // exit();
}
?>

<?php include 'header.php';?>

<a href="allCategory.php">Search All Category</a> <br><br>

<div>
  <form action="" method="get">
    <select name="cat_id">
      <option>-- select category --</option>
      <?php foreach ($catagories as $category): ?>
        <option value="<?=$category->cat_id;?>"> <?=$category->cat_name;?></option>
      <?php endforeach;?>
    </select>
    <input type="submit" name="search" value="Search" />
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
        <td><?=$value->cost_name;?></td>
        <td><?=$value->cost_details;?></td>
        <td><?=$value->cost_amount;?></td>
        <td><?=$value->cost_date;?></td>
      </tr>
    <?php }?>
  </table>
</div>

<?php include 'footer.php';?>