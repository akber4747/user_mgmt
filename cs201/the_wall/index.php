<?php
session_start();
require_once('new-connection.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login page</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class='container'>	
	<div class='row'>
		<h1>WALL</h1>
		<div class='col-sm-6'>
			<h3>Register Here to Access the Wall</h3>
			<?php
			if (isset($_SESSION['error']))
			{
				foreach ($_SESSION['error'] as $name => $value) 
				{
					echo "<p>". $value . "</p>";
				}
				unset($_SESSION['error']);
			}
		?>
			<form action='process.php' method='post' class='form-vertical'>
				<div class='form-group'>
					<input type="hidden" name='action' value='register'>
				</div>
				<div class='form-group'>
					<input type="text" name='first_name' placeholder='first name'>
				</div>
				<div class='form-group'>
					<input type="text" name='last_name' placeholder='last name'>
				</div>
				<div class='form-group'>
				<input type="text" name='email' placeholder='email'>
				</div>
				<div class='form-group'>
					<input type="password" name='password' placeholder='password'>
				</div>
				<div class='form-group'>
					<input type="password" name='password_confirmation' placeholder='confirm password'>
				</div>
				<div class='form-group fancy-button'>
					<input type="submit" name='submit' value='Register'>
				</div>
			</form>
		</div>	
		<div class='col-sm-6'>
			<h3>Login Here to Access the Wall</h3>
			<form action='process.php' method='post' class='form-vertical'>
				<div class='form-group'>
					<input type="hidden" name='action' value='login'>
				</div>
				<div class='form-group'>
					<input type="email" name='email' placeholder='email'>
				</div>
				<div class='form-group'>
					<input type="password" name='password' placeholder='password'>
				</div>
				<div class='form-group fancy-button'>
					<input type="submit" name='submit' value='Login'>
			</div>
			</form>
		</div>	
	<div class='row'>
</div>	
</body>
</html>