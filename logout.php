<?php include("header.php"); ?>
<h1>Logging you out. . .</h1>

<?php 
	//destroy session
	session_destroy();

	//redirect user back to home
	header("Location: home.php");
?>

<?php include("footer.php"); ?>