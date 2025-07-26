<?php
session_start();
if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
$firstname = $_SESSION['FirstName'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Study Organizer</title>
	<style type="text/css">
		a
		{
			text-decoration: none;
			color: black;
		}
		img
		{
			
			border-radius: 200px;
		}
		h1
		{
			font-family:"arial","sans-serif;";
			font-size: 60pt;
			
		}
	</style>
</head>
<body bgcolor="lightgreen">
	<header>
	<div class="navbar">
	<a href="#" class="logo">Study Organiser</a>
	<ul class="nav">
			<li><a href="ass6.php">Assignments</a></li>
			<li><a href="testexam.php">Test</a></li>
			<li><a href="others.php">Other Tasks</a></li>
			<li><a href="checklist.php">Checklist</a></li>
			<li><a href="#">About</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>
	</header>
	<br><br><br>
	<h1 style="padding-left: 440px">Hi <?php echo $firstname; ?> 
	</h1>
	<img src="https://images.theconversation.com/files/45159/original/rptgtpxd-1396254731.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=754&fit=clip" border="0.5" width="400px" height="400px" align="right">
	<br>
	<p style="font-family: arial;padding-left: 200px; padding-bottom: 50px;">Schedule your tasks and organize your academics</p>
<div class="banner-area" id="home">
</div>
<div class="about-area" id="about">
	<div class="text-part1">
		<h1>About Us</h1>
		<p>Study Organiser is platform for students to organize their tasks 
		<br>
		 
		</p>
</div>





</body>
</html>
