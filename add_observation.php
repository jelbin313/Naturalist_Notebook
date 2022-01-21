<?php include("header.php"); ?>

<h1 class="heading">New Observation</h1>

<!--form to add an observation-->
<form action="observations.php" method="post" enctype="multipart/form-data">
	<table id="add_observation" class="center">
		<tr>
			<td><label>Notebook:</label></td>
			<td><select name="notebook_id" required>
					<option></option>
				<?php
					//query to return all notebooks with user id of current user
					$sql = "SELECT notebook_name, notebook_id FROM notebooks WHERE user_id = " . $_SESSION['user_id'] . ";";
					$result = mysqli_query($dbc, $sql);
					$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

					//add an option for every notebook that the user has
					for($i = 0; $i < count($result); $i++) {
						echo'<option value="' . $result[$i]['notebook_id'] . '">' . $result[$i]['notebook_name'] . '</option>';
					}
				?>
			</select></td>
		</tr>
		<tr>
			<td><label>Image:</label></td>
			<td><label class="upload_image"><input type="file" name="image" accept=".jpg, .jpeg, .png">Upload Image</label></td>
		</tr>
		<tr>
			<td><label>Species:</label></td>
			<td><input type="text" name="species"></td>
		</tr>
		<tr>
			<td><label>Location:</label></td>
			<td><input type="text" name="location"></td>
		</tr>
		<tr>
			<td><label>Date:</label></td>
			<td><input type="date" name="date"></td>
		</tr>
		<tr>
			<td><label>Notes:</label></td>
			<td><textarea rows="8" cols="35" name="notes"></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Add Observation" name="add_observation"></td>
		</tr>
	</table>
</form>

<?php include("footer.php"); ?>