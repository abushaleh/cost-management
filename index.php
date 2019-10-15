

<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=cost_management', 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $state = $connection->prepare('select * from tbl_cost');
    $state->execute();
    $users = $state->fetchAll();
} catch (PDOException $e) {
    echo "database connection fail" . $e->getMessage();
}
?>

<?php include_once 'header.php';?>
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
  <?php foreach ($users as $user): ?>
    <tr>
      <td><?php echo $user['cost_name']; ?></td>
      <td><?php echo $user['cost_details']; ?></td>
      <td><?php echo $user['cost_amount']; ?></td>
      <td>
        <a href="category.php?id=<?php $user['id'];?>">
          <?php echo $user['cat_name']; ?>
        </a>
      </td>
      <td>
        <a href="single-date.php?id=<?php $user['id'];?>">
          <?php echo $user['cost_date']; ?>
        </a>
      </td>
      <td>
        <a href="update.php?id=<?php echo $user['id']; ?>" name="update">Update | </a>
        <a href="delete.php?id=<?php echo $user['id']; ?>" name="delete">Delete</a>
      </td>
    </tr>

  <?php endforeach;?>

</table>
<br><br>
<a href="create.php">Back To Form</a>

<?php include_once 'footer.php';?>