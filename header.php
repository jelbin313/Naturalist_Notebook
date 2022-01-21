<!DOCTYPE html>
<html>
	<head>
		<title>Naturalist's Notebook</title>

		<!--link to stylesheet-->
		<link rel="stylesheet" type="text/css" href="styles.css">

		<!--link for the font-->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap" rel="stylesheet">

		<!--include database connection file-->
		<?php include('mysqli_connect.php'); ?>

		<!--start a session-->
		<?php session_start(); ?>

	</head>
	<body>
		<div id="heading">
			<h1 id="title" class="inline_block">Naturalist's Notebook</h1>
      		<?php
      			//if user is logged in, display name and signout button
      			if(isset($_SESSION['username'])) {
      				echo '<div id="logout_corner" class="inline_block">';
						echo '<img class="block center" src="login.png" width="50px" height="50px">';
						echo '<h3 class="text_center">' . $_SESSION['username'] . '<h3>';
						echo '<a class="block" href="logout.php"><button>Logout</button></a>';
					echo '</div>';
      			}

      			//otherwise display symbol and login
      			else {
					echo '<div id="login_corner" class="inline_block">';
						echo '<img class="block center" src="login.png" width="50px" height="50px">';
						echo '<a class="block" href="login.php"><button>Login</button></a>';
					echo '</div>';
      			}
      		?>
		</div>
		<hr>
		<div>
			<ul>
      			<li class="inline_block navbar"><a href="home.php"><button>Home</button></a></li>

      			<!--check if user is logged in to decide which buttons to display-->
      			<?php
      				//if a user is logged in, display buttons as links to pages
      				if(isset($_SESSION['username'])) {
      					echo '<li class="inline_block navbar"><a href="notebooks.php"><button>Notebooks</button></a></li>';
      					echo '<li class="inline_block navbar"><a href="add_observation.php"><button>New Observation</button></a></li>';

      					//if admin is logged in, display admin page button
      					if($_SESSION['username'] == 'admin') {
      						echo '<li class="inline_block navbar"><a href="admin.php"><button>Admin</button></a></li>';
      					}
      				}

      				//if user is not logged in, link buttons to login page
      				else {
      					echo '<li class="inline_block navbar"><a href="login.php"><button>Notebooks</button></a></li>';
      					echo '<li class="inline_block navbar"><a href="login.php"><button>New Observation</button></a></li>';
      				}
      			?>
    		</ul>
    	</div>
    	<hr>