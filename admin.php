<?php include("header.php"); ?>
<h1 class="heading">Admin Page</h1>

<!--form handling for add a user-->
<?php
	//handle the signup form
	if(isset($_POST['add_user'])) {
		//return sql rows that have that username
		$sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'";
		$result = mysqli_query($dbc, $sql);

		//check to check that username does not exist in database
		if(mysqli_num_rows($result) == 0) {
			//sql query
			$sql = "INSERT INTO users VALUES ('NULL', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $_POST['password'] . "')";

			//run the sql query
			mysqli_query($dbc, $sql);
		}

		//if the username exists, inform user
		else {
			echo '<h3 class="heading">That username is already taken.</h3>';
		}
	}
?>

<!--form handling for delete a user-->
<?php
	//check if delete notebook button was pressed
	if(isset($_POST['delete_user'])) {
		//in order to delete a user, we first must delete everything associated with that user
		
		//get all notebooks associated wiht that user
		$sql = "SELECT * FROM notebooks WHERE user_id = '" . $_POST['user_id'] . "'";
		$result = mysqli_query($dbc, $sql);
		$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

		//go through and delete stuff from each notebook
		for($i = 0; $i < count($result); $i++) {
			//delete observations from current notebook
			$sql = "DELETE FROM observations WHERE notebook_id = '" . $result[$i]['notebook_id'] . "';";
			mysqli_query($dbc, $sql);

			//now delete the notebook
			$sql = "DELETE FROM notebooks WHERE notebook_id = '" . $result[$i]['notebook_id'] . "';";
			mysqli_query($dbc, $sql);
		}

		//now delete the user
		$sql = "DELETE FROM users WHERE user_id = '" . $_POST['user_id'] . "';";
		mysqli_query($dbc, $sql);
	}
?>


<!--form to add a user-->
<form action="admin.php" method="post">
	<table id="add_user" class="center">
		<tr>
			<th colspan="2"><h2>Add User</h2></th>
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
			<td colspan="2"><input name="add_user" type="submit"></td>
		</tr>
	</table>
</form>

<!--display users in database-->
<table id="users_table" class="center">
	<tr>
		<th colspan="5"><h2>Users</h2></th>
	</tr>
		<th><h3>Email</h3></th>
		<th><h3>Username</h3></th>
		<th><h3>Delete User</h3></th>
	</tr>
	<?php
		//get all rows in users table (except admin)
		$sql = "SELECT * FROM users WHERE username != 'admin';";
		$result = mysqli_query($dbc, $sql);
		$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

		for ($i=0; $i < count($result); $i++) 
		{ 
			echo '<form action="admin.php" method="post">
				<input type="hidden" name="user_id" value="' . $result[$i]['user_id'] . '">
				<tr>
					<td><p>' . $result[$i]['email'] . '</p></td>
					<td><p>' . $result[$i]['username'] . '</p></td>
					<td><input type="submit" name="delete_user" value="Delete"></td>
				</tr>
			</form>';
		}
	?>
</table>
<?php include("footer.php"); ?>