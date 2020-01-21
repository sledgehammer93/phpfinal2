<?php
define("ADAY", (60*60*24));
if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
	$nowArray = getdate();
	$month = $nowArray['mon'];
	$year = $nowArray['year'];
} else {
	$month = $_POST['month'];
	$year = $_POST['year'];
}

$start = mktime (12, 0, 0, $month, 1, $year);
$firstDayArray = getdate($start);
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "Calendar: ".$firstDayArray['month']." ".$firstDayArray['year']; ?></title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
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
      background: rgb(190, 190, 190);
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
      background: rgb(190, 190, 190);
      height: 10vh;
    }
    header, footer, article, nav {
      padding: 1em;
    }
    p {color:black;}
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: row;
      margin: 0;
    }
    header, footer, article, nav {
      padding: 1em;
    }
    p {color:black;}
</style>
    <nav class="col-1"><img src="NorthGeorgiaTech.jpg" alt"ngtc" style="width:250px;height:125px;"></img>
      <ul>
        <li><a href="home.php">Home</a></li>
             <li><a href="cart.php">Cart</a></li>
             <li><a href="contactus.html">Contact Us</a>
              <li><a href="showcalendar_withevent.php">Show calendar</a></li>
                 <li><a href="login.php">Account</a></li>
  
      </ul>
  
    </nav>
    <div class="col-2">
        <header></header>
<body>
  <h1>Select a Month/Year Combination</h1>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="month">
    <?php
    $months = Array("January", "February", "March", "April", "May",  "June", "July", "August", "September", "October", "November", "December");
    for ($x=1; $x <= count($months); $x++) {
    	echo"<option value=\"$x\"";
  	    if ($x == $month) {
   	      echo " selected";
  	    }
	    echo ">".$months[$x-1]."</option>";
    }
    ?>
    </select>
    <select name="year">
    <?php
    for ($x=1990; $x<=2020; $x++) {
    	echo "<option";
    	if ($x == $year) {
    		echo " selected";
    	}
    	echo ">$x</option>";
    }
    ?>
    </select>
    <button type="submit" name="submit" value="submit">Go!</button>
    </form>
    <br>
    <?php
    $days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    echo "<table><tr>\n";
    foreach ($days as $day) {
	  echo "<th>".$day."</th>\n";
    }
    for ($count=0; $count < (6*7); $count++) {
	  $dayArray = getdate($start);
	  if (($count % 7) == 0) {
        if ($dayArray['mon'] != $month) {
			break;
		} else {
			echo "</tr><tr>\n";
		}
      }
      if ($count < $firstDayArray['wday'] || $dayArray['mon'] != $month) {
	    echo "<td>&nbsp;</td>\n";
	  } else {
		 $event_title = "";
         $mysqli = mysqli_connect("localhost", "root", "", "test");
		 $chkEvent_sql = "SELECT event_title FROM calendar_events WHERE
						  month(event_start) = '".$month."' AND
						  dayofmonth(event_start) = '".$dayArray['mday']."'
						  AND year(event_start) = '".$year."' ORDER BY event_start";
		 $chkEvent_res = mysqli_query($mysqli, $chkEvent_sql)
						 or die(mysqli_error($mysqli));

		 if (mysqli_num_rows($chkEvent_res) > 0) {
			  while ($ev = mysqli_fetch_array($chkEvent_res)) {
				   $event_title .= stripslashes($ev['event_title'])."<br>";
			  }
		 } else {
			  $event_title = "";
		 }

		 echo "<td><a href=\"javascript:eventWindow('event.php?m=".$month.
		 "&amp;d=".$dayArray['mday']."&amp;y=$year');\">".$dayArray['mday']."</a>
		 <br>".$event_title."</td>\n";

		 unset($event_title);

		 $start += ADAY;
	  }
    }
    echo "</tr></table>";

    //close connection to MySQL
    mysqli_close($mysqli);
    ?>

  <script type="text/javascript">
  function eventWindow(url) {
      event_popupWin = window.open(url, 'event', 'resizable=yes, scrollbars=yes, toolbar=no,width=400,height=400');
     event_popupWin.opener = self;
  }
  </script>

</body>
</html>
