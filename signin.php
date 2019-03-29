
<?php require_once("includes/config.php"); 
require_once("includes/classes/formSanitizer.php");
require_once("includes/classes/Contants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if(isset($_POST["submitButton"]))
	{
		$username = formSanitizer::sanitizeFormUsername($_POST["username"]);
		$password = formSanitizer::sanitizeFormPassword($_POST["password"]);

		$wasSuccessful = $account->login($username,$password);
		if($wasSuccessful)
		{
			$_SESSION["userLoggedIn"] = $username; 
			header("Location:index.php");
		}
	}

function getInputValue($name)
	{
		if(isset($_POST[$name]))
		{
			echo $_POST[$name];
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Video Player</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/commonAction.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<div class = "signInContainer">
		
		<div class = "column">

			<div class = "header">
				<img src="assets/images/icons/logo.png" title = 'logo' alt="Site logo">
				<h3>Sign In</h3>
				<span>to continue to video player</span>
 
			</div>

			<div class = "loginForm">
				<form action = "signin.php" method="POST">
					<?php echo $account->getError(Constants::$logginFailed); ?>
					<input type="text" name="username" placeholder="username" value = "<?php getInputValue('username')?>" required autocomplete="off">
					<input type="password" name="password" placeholder="Password" required>
					<input type="submit" name="submitButton" value="SUBMIT">
				</form>
			</div>

			<a class="signInMessage" href="signup.php">Need an acount?Sign Up Here</a>
			

		</div>

	</div>

</body>
</html>