<?php

require 'db.php';

$sql = 'select * FROM tbl_cost INNER JOIN tbl_cat ON tbl_cost.cat_id = tbl_cat.cat_id';
$state = $connection->prepare($sql);
$state->execute();
$costs = $state->fetchAll();

?>

<?php include 'header.php';?>

<div>
  <a href="month.php">Month</a>
  <a href="year.php">Year</a>
</div>
<br>
<table>

  <tr>
    <th>Cost Name</th>
    <th>Cost Details</th>
    <th>Amount</th>
    <th>Category</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
  <?php foreach ($costs as $cost): ?>
    <tr>
      <td><?php echo $cost['cost_name']; ?></td>
      <td><?php echo $cost['cost_details']; ?></td>
      <td><?php echo $cost['cost_amount']; ?></td>
      <td>
        <a href="category.php?id=<?php $cost['id'];?>">
          <?php echo $cost['cat_name']; ?>
        </a>
      </td>
      <td>
        <a href="single-date.php?cost_date=<?php echo $cost['cost_date']; ?>">
          <?php echo $cost['cost_date']; ?>
        </a>
      </td>
      <td>
        <a href="update.php?id=<?php echo $cost['cost_id']; ?>" name="update">Update | </a>
        <a href="delete.php?id=<?php echo $cost['cost_id']; ?>" name="delete">Delete</a>
      </td>
    </tr>

  <?php endforeach;?>

</table>
<br><br>
<a href="create.php">Add a Cost</a>

<?php include 'footer.php';?>