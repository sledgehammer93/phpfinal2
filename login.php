<?php

	//config file
	require_once "config.php";
	
	//Define Variables
	$username = $password = "";
	$username_err = $password_err = "";
	
	//Processing
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//Check for empty username
		if(empty(trim($_POST["username"]))) {
			$username_err = "Please enter username!";
		}
		
		else{
			$username = trim($_POST["username"]);
		}
		
		//Check for empty password
		
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter password!";
		}
		else{
			$password = trim($_POST["password"]);
		}
		
		// Validate Credentials
		if(empty($username_err) && empty($password_err)){
			//Select Statement
			$sql = "SELECT id, username, password FROM users WHERE username = ?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				//bind variables
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				//set parameters
				$param_username = $username;
				
				//Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					//Store result
					
					mysqli_stmt_store_result($stmt);
					
					//Check user name and then verify password
					if(mysqli_stmt_num_rows($stmt) == 1){
						//Bind Results
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($password, $hashed_password)){
								//Password Correct, start a session
								session_start();
								//store session data
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;
								
								//Redirect user to welcome page
								header("location: welcome.php");
						}
						
						else{
							$password_err = "The password you entered was not valid.";
						}
					}
				}
				else{
					//Username Error
					$username_err = "No Account Found with that username.";
				}
				}
				else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
			
			//Close Statment
			mysqli_stmt_close($stmt);
		}
		
		mysqli_close($link);
	}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
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
	<h2>Login</h2>
	<p>Please fill in your information to login!</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
			<label>Username</label>
			<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
			<span class="help-block"><?php echo $username_err; ?>"</span>
		</div>
		
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
			<label>Password</label>
			<input type="password" name="password" class="form-control">
			<span class="help-block"><?php echo $password_err; ?>
			</span>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary"
			value="Login">
		</div>
		<p>Don't have an account? <a href="RegiForm2.php">Sign up here!</a>.</p>
		</form>
	</div>
</body>
</html>
	
	
