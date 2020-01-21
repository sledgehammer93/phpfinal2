<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
