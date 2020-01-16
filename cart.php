 <?php
 session_start();
 //connect to database
 $mysqli = mysqli_connect("localhost", "root", "", "test");
 $display_block = "<h1>Your Shopping Cart</h1>";
 //check for cart items based on user session id
 $get_cart_sql = "SELECT st.id, si.item_title, si.item_price,
 st.sel_item_qty, st.sel_item_size, st.sel_item_color FROM
 store_shoppertrack AS st LEFT JOIN store_items AS si ON
 si.id = st.sel_item_id WHERE session_id =
 '".$_COOKIE['PHPSESSID']."'";
 $get_cart_res = mysqli_query($mysqli, $get_cart_sql)
 or die(mysqli_error($mysqli));
 if (mysqli_num_rows($get_cart_res) < 1) {
 //print message
 $display_block .= "<p>You have no items in your cart.
 Please <a href=\"home.php\">continue to shop</a>!</p>";
 } else {
 //get info and build cart display
 $display_block .= <<<END_OF_TEXT
 <table>
 <tr>
 <th>Title</th>
 <th>Price</th>
 <th>Qty</th>
 <th>Total Price</th>
 <th>Action</th>
 </tr>
 END_OF_TEXT;
 while ($cart_info = mysqli_fetch_array($get_cart_res)) {
 $id = $cart_info['id'];
 $item_title = stripslashes($cart_info['item_title']);
 $item_price = $cart_info['item_price'];
 $item_qty = $cart_info['sel_item_qty'];
 $total_price = sprintf("%.02f", $item_price * $item_qty);
 
 $display_block .= <<<END_OF_TEXT
 <tr>
 <td>$item_title <br></td>
 <td>\$ $item_price <br></td>
 <td>$item_qty <br></td>
 <td>\$ $total_price</td>
 <td><a href="removefromcart.php?id=$id">remove</a></td>
 </tr>
 END_OF_TEXT;
 }
 $display_block .= "</table>";
 }
 //free result
 mysqli_free_result($get_cart_res);
 //close connection to MySQL
 mysqli_close($mysqli);
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
      background: rgb(190, 190, 190);
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
      background: rgb(190, 190, 190);
      height: 20vh;
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
    <nav class="col-1">Navigation
      <ul>
        <li><a href="home.php">Home</a></li>
             <li><a href="signin.php">Sign-in</a></li>
             <li><a href="createaccount.php">Create Account</a></li>
             <li><a href="cart.php">Cart</a></li>
             <li><a href="contactus.html">Contact Us</a></li>
  
      </ul>
  
    </nav>
    <div class="col-2">
        <header><img src="NorthGeorgiaTech.jpg" alt"ngtc" style="width:250px;height:125px;">CIST 2352 Final Project</header>
        <style type="text/css">
 table {
 border: 1px solid black;
 border-collapse: collapse;
 }
 th {
 border: 1px solid black;
 padding: 6px;
 font-weight: bold;
 background: #ccc;
 text-align: center;
 }
 td {
 border: 1px solid black;
 padding: 6px;
 vertical-align: top;
 text-align: center;
 }
 </style>
 </head>
 <body>
 <?php echo $display_block; ?>
 </body>
 </html>
