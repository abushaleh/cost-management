<?php

require 'db.php';

$sql = 'SELECT * from tbl_cat';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$catagories = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {

    $cost_name = $_POST['cost_name'];
    $cost_details = $_POST['cost_details'];
    $cost_amount = $_POST['cost_amount'];
    $cat_id = $_POST['cat_id'];
    $cost_date = $_POST['cost_date'];

    $sql = 'INSERT INTO tbl_cost (`cost_name`, `cost_details`, `cost_amount`, `cat_id`,`cost_date`)
                        VALUES (:cost_name, :cost_details, :cost_amount, :cat_id, :cost_date)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cost_name', $cost_name);
    $stmt->bindParam(':cost_details', $cost_details);
    $stmt->bindParam(':cost_amount', $cost_amount);
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':cost_date', $cost_date);
    if ($stmt->execute()) {
        echo "Data Successfully inserted.....";
    } else {
        echo "Failled....";
    }
}
?>

<?php include 'header.php';?>

    <form action="" method="post" ">
        <div>
            <label for="">cost_name:</label>
            <input type=" text" name="cost_name">
        </div>
        <div>
            <label for="">cost_details:</label>
            <input type="text" name="cost_details">
        </div>
        <div>
            <label for="">cost_amount :</label>
            <input type="text" name="cost_amount">
        </div>
        <div>
            <label for="">Category value:</label>
            <select name="cat_id">
                <option value="">--Select One--</option>
                <?php foreach ($catagories as $category): ?>
                    <option value="<?=$category->cat_id;?>"> <?=$category->cat_name;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <label for="">Date:</label>
            <input type="date" name="cost_date">
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

<?php include 'footer.php';?>