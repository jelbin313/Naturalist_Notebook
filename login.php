<?php include("header.php"); ?>

<!--login form handling-->
<?php
	if(isset($_POST['login'])) {

		//sql query to find the user and fetch their ID and password
		$sql = "SELECT user_id, username, pass FROM users WHERE username = '". mysqli_real_escape_string($dbc, $_POST['username']) ."';";
		$result = mysqli_query($dbc, $sql);
		$result = mysqli_fetch_assoc($result);

		//check to make sure username exists
		if(isset($result['user_id'])) {
			//check to make sure password is right
			if(SHA1($_POST['password']) == $result['pass']) {

				//set the session variables
				$_SESSION['user_id'] = $result['user_id'];
				$_SESSION['username'] = $result['username'];

				header("Location: notebooks.php");
			}

			//if session did not get set up, inform user
			else {
				echo '<h3 class="heading">The password is incorrect.</h3>';
			}
		}

		else {
			echo '<h3 class="heading">That username does not exist.</h3>';
		}
	}
?>

<form action="login.php" method="post">
	<table id="login" class="center">
		<tr>
			<th colspan="2"><h1>Login</h1></th>
		</tr>
		<tr>
			<td><label>Username:</label></td>
			<td><input type="text" name="username" required></td>
		</tr>
		<tr>
			<td><label>Password:</label></td>
			<td><input type="password" name="password" required></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="login"></td>
		</tr>
	</table>
</form>
<?php include("footer.php"); ?>