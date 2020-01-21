<?php
//connect to database
$mysqli = mysqli_connect("localhost", "root", "", "test");

$display_block = "<h1>Buy our air!</h1>
<p>Are you tired of the trees? Well so are we! However clean fresh air is still a problem, so we are selling you clean and fresh air from the mountains of China where no man lives to create the amazing view of an empty landscape.</p>";

//show categories first
$get_cats_sql = "SELECT id, cat_title, cat_desc FROM store_categories ORDER BY cat_title";
$get_cats_res =  mysqli_query($mysqli, $get_cats_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_cats_res) < 1) {
   $display_block = "<p><em>Sorry, no categories to browse.</em></p>";
} else {
   while ($cats = mysqli_fetch_array($get_cats_res)) {
        $cat_id  = $cats['id'];
        $cat_title = strtoupper(stripslashes($cats['cat_title']));
        $cat_desc = stripslashes($cats['cat_desc']);

        $display_block .= "<p><strong><a href=\"".$_SERVER['PHP_SELF']."?cat_id=".$cat_id."\">".$cat_title."</a></strong><br>".$cat_desc."</p>";

        if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat_id)) {

          //create safe value for use
  			  $safe_cat_id = mysqli_real_escape_string($mysqli, $_GET['cat_id']);

			   //get items
			   $get_items_sql = "SELECT id, item_title, item_price FROM store_items WHERE cat_id = '".$safe_cat_id."' ORDER BY item_title";
			   $get_items_res = mysqli_query($mysqli, $get_items_sql) or die(mysqli_error($mysqli));

			   if (mysqli_num_rows($get_items_res) < 1) {
               $display_block = "<p><em>Sorry, no items in this category.</em></p>";
            } else {
               $display_block .= "<ul>";

               while ($items = mysqli_fetch_array($get_items_res)) {
                  $item_id  = $items['id'];
                  $item_title = stripslashes($items['item_title']);
                  $item_price = $items['item_price'];

                  $display_block .= "<li><a href=\"showitem.php?item_id=".$item_id."\">".$item_title."</a> (\$".$item_price.")</li>";
                }

				    $display_block .= "</ul>";
			    }

          //free results
          mysqli_free_result($get_items_res);
		   }
	 }
}
//free results
mysqli_free_result($get_cats_res);

//close connection to MySQL
mysqli_close($mysqli);
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
  </style>
  <html>
  <head>	
      <title>CIST 2550 Final</title>
  </head>
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
              <?php echo $display_block; ?>
        </body>
  
