<?php
session_start();
require_once('new-connection.php');


if(isset($_POST['action']) && $_POST['action'] == 'post-wall')
{

	wall_post();
}
if(isset($_POST['action']) && $_POST['action'] == 'post-comment')
{
	wall_comment();
}

function wall_post()
{
	// var_dump($_POST);
	// var_dump($_SESSION);
	$user_id = escape_this_string($_SESSION['user_id']);
	$wall_post = escape_this_string($_POST['post']);
	if(isset($_POST['post']))
	{
		$query = "INSERT INTO messages (messages, created_at, updated_at, user_id)
		VALUES ('$wall_post', NOW(),NOW(), '$user_id')";
		
		$add_post = run_mysql_query($query);
	
	}

	header('location: main.php');
}

function wall_comment()
{

	$users_id = escape_this_string($_SESSION['user_id']);
	$comment_post = escape_this_string($_POST['post']);
	$message_id = escape_this_string($_POST['message_id']);
	if(isset($_POST['post-comment']))
	{
	$query = "INSERT INTO comments (comment, created_at, updated_at, message_id, user_id)
			VALUES ('$comment_post', NOW(), NOW(), '$message_id', '$users_id')";
	// echo $query;	
	$add_comment = run_mysql_query($query);		
	}		
	header('location: main.php');
}


?>