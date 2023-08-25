<?php
session_start();
require('cryptologin.php');

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);// récupère le username et enlève les antislash
	$username = mysqli_real_escape_string($conn, $username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	$query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows==1){
		$_SESSION['username'] = $username;
		header("location: index.php");
		exit;
	}else{
		$message = "User Name or Password is incorrect.";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styles.css"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
	</head>
	<body>
		<div class='header'>
			<div class='header-wrapper'>
				 <div class='header-wrapper-logo' >
					<h3 class='header-logo'> Crypto Currency <span class='yellow-logo'>Tracker</span></h3>
				</div>
			</div>
		</div>
		<div class="loginPage flex">
			<div class="container flex">
				<div class="hero-bckg"> 
					<img class="hero-bckg-img" src="/assets/bitcoin-1920.jpg"/>
					<!-- <div class="hero-bckg-text">
						<h2>Explore top crypto's like Bitcoin, Etherum and many others.
					</div> -->
					<div class="footer-login flex">
						<p class="footer-login-text">Don't have an account?</p>
						<button class="btn">
							<a href="register.php">Register</a>
						</button>
					</div>
				</div>
				<div class="form-login">
					<div class="form-login-header"> 
						<h3 class="box-text">Welcome to</br><span class='blue-logo'> Crypto Currency</span> <span class='yellow-logo'>Tracker</span></h3>
					</div>
					<form class="box" action="" method="post" name="login">
						<h2 class="box-title">Log In</h2>
						<input type="text" class="box-input" name="username" placeholder="Username">
						<input type="password" class="box-input" name="password" placeholder="Password">
						<input type="submit" value="Connexion" name="submit" class="box-button">
						<?php if (! empty($message)) { ?>
							<p class="errorMessage"><?php echo $message; ?></p>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>