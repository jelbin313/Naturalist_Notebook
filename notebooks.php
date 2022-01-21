<?php include("header.php"); ?>

<h1 class="heading">Notebooks</h1>

<!--form handling for adding a notebook-->
<?php
	//check if add notebook button was pressed
	if(isset($_POST['add_notebook'])) {

		//query to return notebooks with current user id and notebook name 
		$sql = "SELECT * FROM notebooks WHERE user_id = " . $_SESSION['user_id'] . " AND notebook_name = '" . mysqli_real_escape_string($dbc, $_POST['notebook_name']) . "';";
		$result = mysqli_query($dbc, $sql);

		//check if the user already has a notebook with that name
		if(mysqli_num_rows($result) == 0) {
			//if not, insert that notebook into the database
			$sql = "INSERT INTO notebooks VALUES (NULL, '" . mysqli_real_escape_string($dbc, $_POST['notebook_name']) . "', " . $_SESSION['user_id'] . ");";
			mysqli_query($dbc, $sql);
		}

		else {
			echo '<h3 class="heading">You already have a notebook with that name</h3>';
		}
	}
?>

<!--form handling for deleting a notebook-->
<?php
	//check if delete notebook button was pressed
	if(isset($_POST['delete_notebook'])) {
		//delete that notebook from database
		$sql = "DELETE FROM notebooks WHERE notebook_id = '" . $_POST['notebook_id'] . "';";
		mysqli_query($dbc, $sql);

	}
?>

<!--display all the notebooks in the database associate with current user-->
<div class="notebooks_grid">
	<?php
		//query to return all notebooks with user id of current user
		$sql = "SELECT notebook_name, notebook_id FROM notebooks WHERE user_id = " . $_SESSION['user_id'] . ";";
		$result = mysqli_query($dbc, $sql);
		$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

		for($i = 0; $i < count($result); $i++) {
			echo'<div>
					<table class="notebooks_table center">
					<form action="observations.php" method="post">
						<input type="hidden" name="notebook_id" value="' . $result[$i]['notebook_id'] . '">
						<tr>
							<td><img src="Notebook.png" height="200px" width="200px"></td>
						</tr>
						<tr>
							<td><input class="center" type="submit" name="notebook_observations" value="' . $result[$i]['notebook_name'] . '"></td>
						</tr>
					</form>
					<form action="notebooks.php" method="post">
						<input type="hidden" name="notebook_id" value="' . $result[$i]['notebook_id'] . '">
						<tr>
							<td><input class="center" type="submit" name="delete_notebook" value="Delete"></td>
						</tr>
					</form>
					</table>
				</div>';
		}
	?>

	<div>
		<form action="notebooks.php" method="post">
			<table class="notebooks_table center">
				<tr>
					<th colspan="2"><h2>Add Notebook</h2></th>
				</tr>
				<tr>
					<td><label>Notebook Name:</label></td>
					<td><input type="text" name="notebook_name" required></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="add_notebook"></td>
				</tr>
			</table>
		</form>
	</div>';
</div>
<?php include("footer.php"); ?>