<?php
session_start();
require_once('new-connection.php');
if(isset($_POST['action']) && $_POST['action'] == 'register')
{
	register($_POST);
}
if(isset($_POST['action']) && $_POST['action'] == 'login')
{		
	login();

}
if(isset($_POST['action']) && $_POST['action'] == 'logout')
{
	logout();
}
//RECEIVED REGISTER FORM, RECEIVED LOGIN FORM, AND RECEIVED LOGOUT FORM AT THE TOP (the 'if(isset)'...) THE BULK OF THE WORK (I.E. FUNCTIONS) WILL BE BELOW
	//(n order to connect to our database we have to open a connection with the database and pass in our credentials. While the script is running we can use the $connection variable to run queries on our database. In this example we just want to make sure that we are able to connect to the database The code below is all it takes to hook up a mysql database to a php file.  Notice that the variable called $connection is the return value of a function called mysqli_connect.  This function takes four arguments: a host, a user, a password and a database.   We define those four values on the lines above by making constants.  Constants are like variables, but they cannot change; hence they are constant.  If all of the values put into the function are correct, the php file we are using this code in will now be able to run queries using the mysql database we selected.  )

//REGISTER FUNCTION
		//check for validation errors (either do here, or in another function below)
		// if no errors, do--> (escape strings, INSERT IN DATABASE, REDIRECT TO MAIN.PHP)
	//register validation function

//WALL-POST FUNCTION

//POST-COMMENT FUNCTION
// var_dump($post);
// die();

function register($post)
{
	register_validation($post);

	if (!isset($_SESSION['error']))
	{
		//variables for the query
		$first_name = escape_this_string($post['first_name']);
		$last_name = escape_this_string($post['last_name']);
		$email = escape_this_string($post['email']);
		$password = escape_this_string($post['password']);
		// query
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) 
			VALUES ('$first_name','$last_name','$email','$password', NOW(), NOW())"; 
		
		$user_id = run_mysql_query($query);
		//store $user_id into SESSION
		$_SESSION['user_id'] = $user_id;	
		
		header('location: index.php');
		exit();
	}
	else
	{
		header('location: index.php');
		exit();
	}
};


function register_validation($post)
{
	foreach($_POST as $name => $value)
	{
		if(empty($value))
		{
			$_SESSION['error'][$name] = "You can't leave ". $name." section blank!";
		}
		else
		{
			switch ($name) 
			{
				case 'first_name':
				case 'last_name':
					if(preg_match('/\d/', $value))
					{
						$_SESSION['error'][$name] = "You can't enter numbers in your first or last name!";
					}
					break;
				
				case 'email':
					if(!filter_var($value, FILTER_VALIDATE_EMAIL))
					{
						$_SESSION['error'][$name] = "Please enter a valid email address in this field";
					}
					break;
				case 'password':
					$password = $value;
					if (strlen($value) < 3)
					{
						$_SESSION['error'][$name] = "Please enter a password of more than 3 characters";
					}	
					break;
				case 'password_confirmation':
					if($password != $value)
					{
						$_SESSION['error'][$name] = "Please make sure that your passwords match";
					}
					break;	
			}
		}
	}
};

// register_validation($post);


//LOGIN FUNCTION
		//check if email or password are emtpy, otherwise
			// Retreive info from DB (SELECT query)
			// check for validation errors (either do here or function below)
	//login validation function
function login()
{
	$email = escape_this_string($_POST['email']);
	$password = escape_this_string($_POST['password']);
	if(empty($_POST['email']) || empty($_POST['password']))
	{	
		$_SESSION['error']['message'] = "You cannot leave the Email or Password field blank";
	}
	else
	{
		$query= "SELECT id, password FROM users
				WHERE email = '$email' AND password = '$password'";
		$user = fetch_record($query);
		login_validation($user);
	}
	// header('location: main.php');
	// exit();
};


function login_validation($user)
{
	if(empty($user))
	{
		$_SESSION['error']['message'] = 'We could not find this user in our database';
	}

	else
	{
		$_SESSION['user_id'] = $user['id'];
		header('location: main.php');
		exit();
	}
};

function logout()
{
	session_destroy();
	header('location: index.php');
}




















// session_destroy();
?>