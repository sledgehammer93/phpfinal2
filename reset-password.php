<?php
//START

session_start();

//Check if User is Logged In

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: login.php");
	exit;
}

//Include config file
require_once "config.php";

//define variables
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

//Processing form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Validate new password
	if(empty(trim($_POST["new_password"]))){
		$new_password_err = "Please enter the new password!";
		
	}
	elseif(strlen(trim($_POST["new_password"])) < 6){
		$new_password_err = "Password must have atleast 6 characters.";
	}
	else{
		$new_password = trim($_POST["new_password"]);
	}
	
	// Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Please confirm the password!";
	}
	else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($new_password_err) && ($new_password != $confirm_password)) {
			$confirm_password_err = "Password did not match!";
		}
	}
	
	//Check Input Errors
	
	if(empty($new_password_err) && empty($confirm_password_err)){
		//prepare an update statement
		$sql = "UPDATE user SET password = ? WHERE id = ?";
		
		if($stmt = mysqli_prepare($link, $sql)){
			//BIND THE DEMON CODE or you know the statement
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
			
			//Set Param
			$param_password = password_hash($new_password, PASSWORD_DEFAULT);
			$param_id = $_SESSION["id"];
			
			//EXECUTE THE CODE
			if(mysqli_stmt_execute($stmt)){
				//Should have updated, DESTROY THE SESSION, go back to the login
				
				session_destroy();
				header("location: login.php");
				exit();
			}
			else{
				echo "Oops! Something went wrong. Please try again later!";
			}
		}
		
		//Close Statement
		mysqli_stmt_close($stmt);
	}
	//Connection bye-bye
	mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
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
	<div class="wrapper">
		<h2>Reset Password</h2>
		<p>Please fill out this form to reset your password</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
			<label>New Password</label>
			<input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
			<span class="help-block"><?php echo $new_password_err; ?></span>
		</div>
		<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password" class="form-control">
			<span class="help-block"><?php echo $confirm_password_err; ?></span>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<a class="btn btn-link" href="welcome.php">Cancel</a>
		</div>
		</form>
	</div>
</body>
</html>
		
