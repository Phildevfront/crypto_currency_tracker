<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css"/>
</head>
<body>
<?php
require('cryptologin.php');
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username); 
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	//requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (username, email, password)
              VALUES ('$username', '$email', '".hash('sha256', $password)."')";
	// Exécute la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
       		<h3>You are successfully registered.</h3>
            <p>Click here for you <a href='login.php'>connect</a></p>
			</div>";
    }
}else{
?>
<form class="box" action="" method="post">
    <h1 class="box-title">Register</h1>
	<input type="text" class="box-input" name="username" placeholder="username" required />
    <input type="text" class="box-input" name="email" placeholder="Email" required />
    <input type="password" class="box-input" name="password" placeholder="password" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Already registered? <a href="login.php">Log in here</a></p>
</form>
<?php } ?>
</body>
</html>