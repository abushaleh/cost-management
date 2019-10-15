<?php

require 'db.php';

if (!empty('submit')) {

    $sql = "INSERT INTO tbl_cat (cat_name) VALUES (:cat_name)";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':cat_name', $_POST['cat_name']);

    $stmt->execute();
    if ($sql) {
        echo "Category Data insert successful.";
    } else {
        echo "Category Data insert fail.";
    }

}

?>

<?php include 'header.php';?>

		<form action="" method="post">
			<label>Category Value:</label>
			<input type="text" name="cat_name"><br><br>
			<input type="submit" name="submit" value="Submit">
		</form>
		<a href="viewCategory.php">View Category</a>

<?php include "footer.php";?>