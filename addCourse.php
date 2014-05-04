<html>
<head><title>ADD NEW SECTION</title></head>
<body>
<h1>Welcome Student</h1><br/>
<h3>Add a New course</h3>
<?php
	
		session_start();
		$link = mysql_connect('localhost', 'root', 'lakers');
		mysql_select_db("database_project") or die("Cannot select the database");     
?>

<form method="get" name="Drop_form" action="addCourse.php" >	
 	Check for available courses: <a href = "Sample2.php"> Click Here </a>

<?php
	if(array_key_exists("SID", $_GET)) {	
		$SID = $_GET["SID"];
	}else {
		$SID = "";
	}
	if(array_key_exists("classNumber", $_GET)) {
		$classNumber = $_GET["classNumber"];
	}else {
		$classNumber = "";
	}
	if(array_key_exists("courseNumber", $_GET)) {
		$courseNumber = $_GET["courseNumber"];
	}else {
		$courseNumber = "";
	}
	if(array_key_exists("sectionNumber", $_GET)) {
		$sectionNumber = $_GET["sectionNumber"];
	}else {
		$sectionNumber = "";
	}
	if(array_key_exists("semester", $_GET)) {
		$semester = $_GET["semester"];
	}else {
		$semester = "";
	}
	if(array_key_exists("year", $_GET)) {
		$year = $_GET["year"];
	}else {
		$year = "";
	}
	
?>
<table>

	<tr>
		<td>
			<label id="lblSid" title="Student ID">Student ID</label>
		</td>
		<td>
			<input name="SID" type="text" value="<?php echo "$SID";?>" size="60"/>
		</td>
	</tr>
	
	<tr>
		<td>
			<label id="lblclassNumber" title="Class Number">Class Number</label>
		</td>
		<td>
			<input name="classNumber" type="text" value="<?php echo "$classNumber";?>" size="60"/>
		</td>
	</tr>
	<tr>
		<td>
			<label id="lblcourseNumber" title="Course Number">Course Number</label>
		</td>
		<td>
			<input name="courseNumber" type="text" value="<?php echo "$courseNumber";?>" size="60"/>
		</td>
	</tr>
	
	<tr>
		<td>
			<label id="lblsectionNumber" title="Section Number">Section Number</label>
		</td>
		<td>
			<input name="sectionNumber" type="text" value="<?php echo "$sectionNumber";?>" size="60"/>
		</td>
	</tr>
	
	<tr>
		<td>
			<label id="lblSemester" title="Semester">Semester</label>
		</td>
		<td>
			<input name="semester" type="text" value="<?php echo "$semester";?>" size="60"/>
		</td>
	</tr>
	<tr>
		<td>
			<label id="lblYear" title="Year">Year</label>
		</td>
		<td>
			<input name="year" type="text" value="<?php echo "$year";?>" size="60"/>
		</td>
	</tr>
		<tr>
		<td>
		<input type="submit" value="ADD">
		</td>
	</tr>
</table>
 	
 <?php 
 if(!empty($SID) & !empty($classNumber) & !empty($courseNumber) & !empty($sectionNumber) & !empty($semester) & !empty($year))
 {
 	$open = "O";
 	$sectionexist = "SELECT SECTIONID,INSTRUCTORSSN FROM SECTION WHERE SECTIONID =  '".$classNumber."' AND SECTIONNO =  '".$sectionNumber."' AND COURSEID =  '".$courseNumber."' AND SEMESTER =  '".$semester."' AND YEAR =  '".$year."' AND STATUS = '".$open."'";
 	
 	$sectionresult = mysql_query($sectionexist);
 	$row = mysql_fetch_assoc($sectionresult);
 	$SSN = $row["INSTRUCTORSSN"];
 	
 	if(mysql_num_rows($sectionresult) > 0)
 	{
 		$studentexist = "SELECT SID FROM STUDENT WHERE SID = '".$SID."' ";
 		
 		$studentresult = mysql_query($studentexist);
 		$row = mysql_fetch_assoc($studentresult);
 		if(mysql_num_rows($studentresult)>0)
 		{
 			$studentregistered = "SELECT SID FROM GRADE_REPORT WHERE SID = '".$SID."' ";
 			
 			$registeredresult = mysql_query($studentregistered);
 			$row = mysql_fetch_assoc($registeredresult);
 			if(mysql_num_rows($registeredresult)>0)
 			{
 						
 						$insertquery = "INSERT INTO GRADE_REPORT VALUES ('".$SID."','".$classNumber."',NULL,NULL,'".$SSN."')";
 						
 						$insertqueryresult = mysql_query($insertquery);
 						
 						if($insertqueryresult > 0)
 						{
 							echo "Student ".$SID." registered into course ".$courseNumber." ".$sectionNumber." successfully.. ";
 						}
 						 
 			}
 			else
			{
				echo "Student already registered !!!!";
			}
 		}
 		else 
 		{
 			echo " Student does not exist !!!";
 		}
 	}
 	else 
 	{
 		echo "Course not offered in the given semester !!!";
 	}
 }
 
 
 
 
 ?>
 
 
 <p><a href = "mainStudent.php">BACK</a></p>
 </form>
 </body>
 </html>