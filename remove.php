 
<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM music WHERE id=$id");
$result = mysqli_query($mysqli, "ALTER TABLE music DROP COLUMN id");
$result = mysqli_query($mysqli, "ALTER TABLE music ADD id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)");

//redirecting to the display page (index.php in our case)
header("Location:delete.php");
?>
