<?php error_reporting(0); ?>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
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
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE music SET title='$title',artist='$artist',album='$album',genre='$genre',format='$format',label='$label',producer='$producer',rating='$rating',date='$date',run='$run' WHERE id=$id");
		$result = mysqli_query($mysqli, "ALTER TABLE music DROP COLUMN id");
		$result = mysqli_query($mysqli, "ALTER TABLE music ADD id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)");
		
		echo "<font color='green'>Data updated successfully.";
		echo "<br/><a href='update.php'>View Result</a>";
		
		$id = $_GET['id'];

        //selecting data associated with this particular id
        $result = mysqli_query($mysqli, "SELECT * FROM music WHERE id=$id");

        while($res = mysqli_fetch_array($result))
        {
            $title = $res['title'];
            $artist = $res['artist'];
            $album = $res['album'];
            $genre = $res['genre'];
            $format = $res['format'];
            $label = $res['label'];
            $producer = $res['producer'];
            $rating = $res['rating'];
            $date = $res['date'];
            $run = $res['run'];
        }
	}
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>

</body>
</html>
