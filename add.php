<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$title = mysqli_real_escape_string($mysqli, $_POST['title']);
	$artist = mysqli_real_escape_string($mysqli, $_POST['artist']);
	$album = mysqli_real_escape_string($mysqli, $_POST['album']);
	$genre = mysqli_real_escape_string($mysqli, $_POST['genre']);
	$format = mysqli_real_escape_string($mysqli, $_POST['format']);
	$label = mysqli_real_escape_string($mysqli, $_POST['label']);
	$producer = mysqli_real_escape_string($mysqli, $_POST['producer']);
	$rating = mysqli_real_escape_string($mysqli, $_POST['rating']);
	$date = mysqli_real_escape_string($mysqli, $_POST['date']);
	$run = mysqli_real_escape_string($mysqli, $_POST['run']);
		
	// checking empty fields
	if(empty($title) || empty($artist) || empty($album) || empty($genre) || empty($format) || empty($label) || empty($producer) || empty($rating) || empty($date) || empty($run)) {
				
		if(empty($title)) {
			echo "<font color='red'>Title field is empty.</font><br/>";
		}
		
		if(empty($artist)) {
			echo "<font color='red'>Artist field is empty.</font><br/>";
		}
		
		if(empty($album)) {
			echo "<font color='red'>Album field is empty.</font><br/>";
		}
		
		if(empty($genre)) {
			echo "<font color='red'>Genre field is empty.</font><br/>";
		}
		
		if(empty($format)) {
			echo "<font color='red'>Format field is empty.</font><br/>";
		}
		
		if(empty($label)) {
			echo "<font color='red'>Label field is empty.</font><br/>";
		}
		
		if(empty($producer)) {
			echo "<font color='red'>Producer field is empty.</font><br/>";
		}
		
		if(empty($rating)) {
			echo "<font color='red'>Rating field is empty.</font><br/>";
		}
		
		if(empty($date)) {
			echo "<font color='red'>Date field is empty.</font><br/>";
		}
		
		if(empty($run)) {
			echo "<font color='red'>Run field is empty.</font><br/>";
		}
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO music(title, artist, album, genre, format, label, producer, rating, date, run) VALUES('$title','$artist','$album','$genre','$format','$label','$producer','$rating','$date','$run')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
