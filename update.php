<?php

require 'db.php';

$cost_id = $_GET['id'];
$sql = 'select * FROM tbl_cost INNER JOIN tbl_cat ON tbl_cost.cat_id = tbl_cat.cat_id WHERE cost_id=:cost_id';
$statement = $connection->prepare($sql);
$statement->execute([':cost_id' => $cost_id]);
$cost = $statement->fetch(PDO::FETCH_OBJ);

$sql = 'SELECT * from tbl_cat';
$stmt = $connection->prepare($sql);
$stmt->execute();
$catagories = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {

    $cost_name = $_POST['cost_name'];
    $cost_details = $_POST['cost_details'];
    $cost_amount = $_POST['cost_amount'];
    $cat_id = $_POST['cat_id'];
    $cost_date = $_POST['cost_date'];

    $sql = 'UPDATE tbl_cost SET cost_name=:cost_name, cost_details=:cost_details,cost_amount=:cost_amount, cost_date=:cost_date, cat_id=:cat_id  WHERE  cost_id=:cost_id';

    $stmt = $connection->prepare($sql);

    $stmt->bindParam(':cost_name', $cost_name);
    $stmt->bindParam(':cost_details', $cost_details);
    $stmt->bindParam(':cost_amount', $cost_amount);
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':cost_date', $cost_date);
    $stmt->bindParam(':cost_id', $cost_id);

    if ($stmt->execute()) {
        header("Location: /cost-management/");
    } else {
        echo "Data update failed!!";
    }

    // [':cost_name' => $cost_name, ':cost_details' => $cost_details, ':cost_amount' => $cost_amount, ':cost_date' => $cost_date, ':cat_id' => $cat_id, ':cost_id' => $cost_id])
    // $sql = 'INSERT INTO tbl_cost (`cost_name`, `cost_details`, `cost_amount`, `cat_id`,`cost_date`)
    //                     VALUES (:cost_name, :cost_details, :cost_amount, :cat_id, :cost_date)';
    // $stmt = $connection->prepare($sql);
    // $stmt->bindParam(':cost_name', $cost_name);
    // $stmt->bindParam(':cost_details', $cost_details);
    // $stmt->bindParam(':cost_amount', $cost_amount);
    // $stmt->bindParam(':cat_id', $cat_id);
    // $stmt->bindParam(':cost_date', $cost_date);
    // if ($stmt->execute()) {
    //     header("Location: /cost-management");
    //     //echo "Data Successfully inserted.....";
    // } else {
    //     echo "Data update failed Failled....";
    // }
}

?>

<?php require 'header.php';?>

<form action="" method="post" ">
        <div>
            <label for="">cost_name:</label>
            <input value="<?=$cost->cost_name;?>" type="text" name="cost_name">
        </div>
        <div>
            <label for="">cost_details:</label>
            <input value="<?=$cost->cost_details;?>" type="text" name="cost_details">
        </div>
        <div>
            <label for="">cost_amount :</label>
            <input value="<?=$cost->cost_amount;?>" type="text" name="cost_amount">
        </div>
        <div>
            <label for="">Category value:</label>
            <select name="cat_id">
                <option value="<?=$cost->cat_id;?><"<?=$cost->cat_name;?></option>
                <?php foreach ($catagories as $category): ?>
                    <option value="<?=$category->cat_id;?>"> <?=$category->cat_name;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <label for="">Date:</label>
            <input value="<?=$cost->cost_date;?>" type="date" name="cost_date">
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
        </div>
</form>

<?php require 'footer.php';?>