<?php include("header.php"); ?>

<h1 class="heading">Observations</h1>

<!--form handling for delete observation-->
<?php
	//check if delete observation was pressed
	if(isset($_POST['delete_observation'])) {
		$sql = "DELETE FROM observations WHERE observation_id = " . $_POST['observation_id'] . ";";

		//run the query
		mysqli_query($dbc, $sql);
	}
?>

<!--form handling for add observation-->
<?php
	//check if add observation button was pressed
	if(isset($_POST['add_observation'])) {
		//make file path for uplaoded image
		 $filePath = "UserImages/" . $_FILES["image"]["name"];

		 //move image into folder
		 move_uploaded_file($_FILES["image"]["tmp_name"], $filePath);
		
		

		$sql = "INSERT INTO observations VALUES (NULL, '" . $_POST['notebook_id'] . "', '" . mysqli_real_escape_string($dbc, $filePath) . "', '" . mysqli_real_escape_string($dbc, $_POST['species']) . "', '" . mysqli_real_escape_string($dbc, $_POST['location']) . "', '". $_POST['date'] ."', '". mysqli_real_escape_string($dbc, $_POST['notes']) ."');";

		//run the query
		mysqli_query($dbc, $sql);
	}
?>

<!--form handling for notebooks-->
<?php
	//if notebook id is set, display notebooks
	if(isset($_POST['notebook_id'])) {
		//return all rows with the submiteed notebook id
		$sql = "SELECT * FROM observations WHERE notebook_id = " . $_POST['notebook_id'] . ";";
		$result = mysqli_query($dbc, $sql);
		$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		//now display the observations
		echo '<div class="observations_grid">';
			for($i = 0; $i < count($result); $i++) {
				echo'<div>
					<table class="observations_table center">
						<tr>
							<td rowspan="3" width="200px">
								<img alt="Image of observation" class="observation_image" src="' . $result[$i]['image'] . '">
							</td>
							<td class="observation_notes text_left"><p>Species: ' . $result[$i]['species'] . '</p></td>
							<td rowspan="3" class="observation_notes text_left" width="500px"><p id="notes">' . $result[$i]['notes'] . '</p></td>
						</tr>
						<tr>
							<td class="observation_notes text_left"><p>Date: ' . $result[$i]['date_created'] . '</p></td>
						</tr>
						<tr>
							<td class="observation_notes text_left"><p>Location: ' . $result[$i]['location'] . '</p></td>
						</tr>

						<form action="observations.php" method="post"><tr>
							<input type="hidden" name="notebook_id" value="' . $result[$i]['notebook_id'] . '">
							<input type="hidden" name="observation_id" value="' . $result[$i]['observation_id'] . '">
							<td colspan="3"><input type="submit" name="delete_observation" value="Delete Observation"></td>
						</tr></form>
					</table>
				</div>
				<br>';
			}
		echo '</div>';
	}
?>

<?php include("footer.php"); ?>