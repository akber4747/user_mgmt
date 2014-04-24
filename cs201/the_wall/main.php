<?php
session_start();
require_once('new-connection.php');

$wall_post_query = "SELECT first_name, last_name, messages, users.created_at, users.updated_at, messages.id
					FROM  messages 
					JOIN users ON users.id = messages.user_id 
					ORDER BY messages.created_at DESC";
				

$wall_posts = fetch_all($wall_post_query);



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Wall</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class = 'container'>
		<h1>Welcome to THE GREAT WALL OF DOJO</h1>
		<form action='process.php' method='post'>
			<input type="hidden" name='action' value='logout'>
			<input type="submit" value='LOGOUT!'>
		</form>
		<div class='row'>
			<div class='col-sm-12'>
				<form action ='wall-process.php' method='post' class='form-vertical'>
					<input type="hidden" name='action' value='post-wall'>
					<textarea class='wall-post' name='post'> </textarea><br>
					<input type="submit" name="post-message" value='Post a message to the wall'>
				</form>

				<?php
					if (isset($wall_posts) && !empty($wall_posts))
					{

						foreach ($wall_posts as $wall_post) 
						{
							$comment_query = "SELECT first_name, last_name, comments.created_at, comments.comment
							FROM comments 
							JOIN users ON users.id = comments.user_id
							JOIN messages ON messages.id = comments.message_id
							WHERE comments.message_id = {$wall_post['id']}
							ORDER BY comments.created_at DESC";

							$comments_posts = fetch_all($comment_query);

							echo '<p style = "font-size: 22px;">'. $wall_post['messages'].'</p><br>';
							echo '<p>('. $wall_post['first_name'].' '.$wall_post['last_name'].' <span style= "color: blue;">'.$wall_post['created_at'].'</span>'.')</p>';
							foreach ($comments_posts as $comment_post)
							{

								echo '<p>'. $comment_post['comment'].' (posted by '.$comment_post['first_name'].') </p>';
							}

							echo "<form action='wall-process.php' method='post' class='comment'><input type='hidden' name='action' value='post-comment'><input type='hidden' name='message_id' value='{$wall_post['id']}'><textarea class='comment-post' name='post'>  </textarea><br><input type='submit' name='post-comment' value='Post a comment to the message'></form>";
							

						}
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>