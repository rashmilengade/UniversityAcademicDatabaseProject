
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
$SID = $_SESSION["SID"];
$fname = $_SESSION["fname"];
$lname = $_SESSION["lname"];
echo "WELCOME ".$fname." ".$lname;
  ?>
  <br/>
<a href ="login.php">LOGOUT </a></p>
<br/>
<br/>
<br/>

<p> 
<a href ="Sample2.php">View offered Courses </a></p>
<p>
<a href ="vSchedule.php">View Registered Courses</a> </p>
<p><a href ="addCourse.php">Add New Course</a></p>

<p><a href ="schedule.php">Drop Registered Courses</a> </p>
<p> <a href ="studentGrade.php">View my Grades</a></p>
<p>
<a href ="viewProject.php">View Project Details </a></p>
<p>

<a href ="viewThesis.php">View Thesis Details </a></p>

</body>
</html>