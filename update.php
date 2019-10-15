<?php

require 'db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM tbl_cost WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id]);
$costs = $statement->fetch(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    $cost_name = $_POST['cost_name'];
    $cost_details = $_POST['cost_details'];
    $cost_amount = $_POST['cost_amount'];
    $cost_date = $_POST['cost_date'];
    $cat_id = $_POST['cat_id'];

    $sql = 'UPDATE tbl_cost SET cost_name=:cost_name, cost_details=:cost_details,cost_amount=:cost_amount, cost_date=:cost_date, cat_id=:cat_id WHERE id=:id';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':cost_name' => $cost_name, ':cost_details' => $cost_details, ':cost_amount' => $cost_amount, ':cost_date' => $cost_date, ':cat_id' => $cat_id])) {
        header("Location: /cost-namagement");
    } else {
        echo "Data update failed!!";
    }
}

?>

<?php require 'header.php';?>

      <?php if (!empty($message)): ?>
        <div class="alert alert-success">
          <?=$message;?>
        </div>
      <?php endif;?>
      <form method="post">

      </form>


<?php require 'footer.php';?>