<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM music ORDER BY id ASC"); // using mysqli_query instead
?>
<style>
  * {
    box-sizing: border-box; 
  }
  body {
    display: flex;
    min-height: 100vh;
    flex-direction: row;
    margin: 0;
  }
  .col-1 {
    background: #D7E8D4;
    flex: 1;
  }
  .col-2 {
    display: flex;
    flex-direction: column;
    flex: 5;
  }
  .content {
    display: flex;
    flex-direction: row;
  }
  .content > article {
    flex: 4;
    min-height: 60vh;
  }
  header, footer {
    background: rgb(230, 230, 230);
    height: 20vh;
  }
  header, footer, article, nav {
    padding: 1em;
  }
</style>
<html>
<head>	
	<title>CIST 2550 Final</title>
</head>
  <nav class="col-1">Navigation
     <ul>
<li><a href="index.php">Table Overview</a></li>
      <li><a href="add.html">Add To Table</a></li>
          <li><a href="delete.php">Remove From Table</a></li>
         <li><a href="update.php">Edit Table</a></li>
           <li><a href="rubric.php">Rubric</a></li>
    </ul>

  </nav>
  <div class="col-2">
      <header><img src="NorthGeorgiaTech.jpg" alt"ngtc" style="width:250px;height:125px;">CIST 2550 Final Project</header>

<body>
<h1>Update Table</h1>
	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td> <font face="Arial">Title</font> </td> 
          <td> <font face="Arial">Artist</font> </td> 
          <td> <font face="Arial">Album</font> </td> 
          <td> <font face="Arial">Genre</font> </td> 
          <td> <font face="Arial">Format</font> </td> 
          <td> <font face="Arial">Label</font> </td> 
          <td> <font face="Arial">Producer</font> </td> 
          <td> <font face="Arial">Rating</font> </td> 
          <td> <font face="Arial">Release Date</font> </td> 
          <td> <font face="Arial">Run-time</font> </td>
	</tr>
	<?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['title']."</td>";
		echo "<td>".$res['artist']."</td>";
		echo "<td>".$res['album']."</td>";	
		echo "<td>".$res['genre']."</td>";
		echo "<td>".$res['format']."</td>";
		echo "<td>".$res['label']."</td>";	
		echo "<td>".$res['producer']."</td>";
		echo "<td>".$res['rating']."</td>";
		echo "<td>".$res['date']."</td>";	
		echo "<td>".$res['run']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a></td>";		
	}
	?>
	</table>
</body>
</html>


 
