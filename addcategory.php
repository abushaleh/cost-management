<?php

require 'db.php';

if (!empty($_POST['cat_value'])) {

    $cat = 'category';

    $sql = "INSERT INTO tbl_cat (cat_name,cat_value) VALUES (:cat_name,:cat_value)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':cat_name', $cat);
    $stmt->bindParam(':cat_value', $_POST['cat_value']);

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
		<input type="text" name="cat_value"><br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="viewCategory.php">View Category</a>

<?php include "footer.php";?>