<?php include("header.php"); ?>

<?php
	//handle the signup form
	if(isset($_POST['signup'])) {
		//return sql rows that have that username
		$sql = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($dbc, $_POST['username']) . "'";
		$result = mysqli_query($dbc, $sql);

		//check to check that username does not exist in database
		if(mysqli_num_rows($result) == 0) {
			//sql query
			$sql = "INSERT INTO users VALUES ('NULL', '" . $_POST['email'] . "', '" . mysqli_real_escape_string($dbc, $_POST['username']) . "', '" . SHA1($_POST['password']) . "')";

			//run the sql query
			mysqli_query($dbc, $sql);

			if(isset($_SESSION['username'])) {
				header("Location: home.php");
			}

			else {
				//send user to login page
				header("Location: login.php");
			}
		}

		//if the username exists, inform user
		else {
			echo '<h3 class="heading">That username is already taken.</h3>';
		}
	}
?>

<form action="signup.php" method="post">
	<table id="signup" class="center">
		<tr>
			<th colspan="2"><h1>Sign Up</h1></th>
		</tr>
		<tr>
			<td><label>Email:</label></td>
			<td><input type="email" name="email" required></td>
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
			<td colspan="2"><input type="submit" name='signup'></td>
		</tr>
	</table>
</form>
<?php include("footer.php"); ?>