
<?php

	session_start();
 	/*	 Step #1: Open connection to the MySQL database */
	$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
	mysql_select_db("database_project") or die("Database not selected");     
	
?>
<html>

<head></head>

<body>

<?php 
$SSN = $_SESSION["SSN"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];
echo "WELCOME ".$fname." ".$lname;
  ?>



<p> 
<a href ="Sample2.php">View Courses </a></p>
<p>
<a href ="view_Students.php">View Students Registered in Courses</a> </p>
<p>
<a href ="updateGrade.php">Update Student Grade</a></p>



</body>
</html>