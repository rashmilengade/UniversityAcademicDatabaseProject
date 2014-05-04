<html>
<head><title>SEARCHING FOR A CLASSES</title></head>
<body>

<?php

	session_start();
 	/*	 Step #1: Open connection to the MySQL database */
	$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
	mysql_select_db("database_project") or die("Database not selected");     
	
?>

<h3> Search for a Course</h3>

<form method="get" name="Sample_form" action="Sample2.php" >


<?php
	if(array_key_exists("courseName", $_GET)) {	
		$courseName = $_GET["courseName"];
	}else {
		$courseName = "";
	}
	if(array_key_exists("courseNumber", $_GET)) {
		$courseNumber = $_GET["courseNumber"];
	}else {
		$courseNumber = "";
	}
	if(array_key_exists("instructor", $_GET)) {
		$instructor = $_GET["instructor"];
	}else {
		$instructor = "";
	}
	if(array_key_exists("classTime", $_GET)) {
		$classTime = $_GET["classTime"];
	}else {
		$classTime = "";
	}
?>
<table>

	<tr>
		<td>
			<label id="lblcourses" title="Class Search Criteria">Class Search Criteria</label>
		</td>
	</tr>
	<tr>
		<td>
			<input type="radio" name="semester" value="Fall">FALL
		</td>
		<td>
			<input type="radio" name="semester" value="Spring">SPRING
		</td>
		<td>
			<input type="radio" name="semester" value="Summer">SUMMER
		</td>
	</tr>
	
	<tr>
		<td>
			<label id="lblcoursename" title="Course Name">Course Name</label>
		</td>
		<td>
			<input name="courseName" type="text" value="<?php echo "$courseName";?>" size="60"/>
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
			<label id="lblinstructor" title="Instructor">Instructor</label>
		</td>
		<td>
			<input name="instructor" type="text" value="<?php echo "$instructor";?>" size="60"/>
		</td>
	</tr>
	<tr>
		<td>
			<label id="lblclassTime" title="Class Time">Class Time</label>
		</td>
		<td>
			<input name="classTime" type="text" value="<?php echo "$classTime";?>" size="60" />
		</td>
		</tr>
		<tr>
		<td>
		<input type="submit" value="SEARCH">
		</td>
		<td>
		<input type=reset value= "CLEAR" onClick="document.SAMPLE2.SearchString.focus();">
		</td>
		<td>
	
<a href = "mainStudent.php">Back</a>		
		</td>
	</tr>
</table>
<br/>


<?php
	    	$where = "";
	    	if(!empty($_GET["semester"]))
	    	{
	    		$where .= " AND S.SEMESTER LIKE '%". $_GET["semester"]."%'";
	    	}
	    	if(!empty($_GET["courseName"])){
				$where .= " AND C.COURSENAME LIKE '%". $_GET["courseName"]."%'";
			}
			if(!empty($_GET["courseNumber"])){
				$where .= " AND C.COURSEID LIKE '%". $_GET["courseNumber"]."%'";
			}
			if(!empty($_GET["instructor"])){
				$where .= " AND F.SSN IN (SELECT SSN FROM STAFF WHERE FNAME LIKE '%".$_GET["instructor"]."%' OR LNAME LIKE '%".$_GET["instructor"]."%')";
			}
			
			if(!empty($_GET["classTime"])){
				$classTimeArray = $_GET["classTime"];
				$splitArray = explode(" ", $classTimeArray);
				if(!empty($splitArray[0])){
					if(strpos($splitArray[0], ",")>0){
						$daysArray = explode(",", $splitArray[0]);
						foreach ($daysArray as &$day){
							$where .= " AND  LECTURE_DAY like '%".$day."%'";
						}
					}else if(strpos($splitArray[0], "-")>0){
						$timeArray = explode("-", $splitArray[0]);
						$where .= " AND '".$timeArray[0]."' >= S.START_TIME and '".$timeArray[1]."' <= S.END_Time";		
					}else if (strpos($splitArray[0], ":")>0){
						$where .= " AND '".$splitArray[0]."' = S.START_TIME or '".$splitArray[0]."' = S.END_Time";
					}else{
						$where .= " AND  LECTURE_DAY like '%".$splitArray[0]."%'";
					}
				}
				if(!empty($splitArray[1])){
					if(strpos($splitArray[1], ",")>0){
						$daysArray = explode(",", $splitArray[1]);
						foreach ($daysArray as &$day){
							$where .= " AND  LECTURE_DAY like '%".$day."%'";
						}
					}else if(strpos($splitArray[1], "-")>0){
						$timeArray = explode("-", $splitArray[1]);
						$where .= " AND '".$timeArray[0]."' >= S.START_TIME and '".$timeArray[1]."' <= S.END_Time";
					}else if (strpos($splitArray[1], ":")>0){
						$where .= " AND '".$splitArray[1]."' = S.START_TIME or '".$splitArray[1]."' = S.END_Time";
					}else{
						$where .= " AND  LECTURE_DAY like '%".$splitArray[1]."%'";
					}
				}
				
				
			}
 
		    
		    if(!empty($where)){
		    	$query = "SELECT S.STATUS AS CLASS_STATUS,S.SEMESTER AS SEMESTER,S.YEAR AS YEAR,S.SECTIONID AS CLASS_NO,S.COURSEID AS COURSE_NO,S.SECTIONNO AS SECTION_NO,C.COURSENAME AS COURSE_NAME,S.LECTURE_DAY AS LECTURE_DAY,S.START_TIME AS
		    	
CLASS_START_TIME,S.END_TIME AS CLASS_END_TIME,S.LOCATION AS CLASS_LOCATION,F.FNAME AS INSTRUCTOR_FNAME,F.LNAME AS INSTRUCTOR_LNAME,C.CDESCRIPTION AS CDESCRIPTION,S.CREDIT_HOURS AS CLASS_CREDIT_HOURS
FROM SECTION S, COURSE C, STAFF F
WHERE  F.SSN = S.INSTRUCTORSSN AND S.COURSEID = C.COURSEID";
		    	$query .=  $where;

		    if(!empty($query))
		    $result = mysql_query($query);
		    if(mysql_num_rows($result) > 0) { ?>

<table border = "1">
<tr>
	<th><h4>STATUS</h4></th>
	<th><h4>SEM</h4></th>
	<th><h4>YEAR</h4></th>
	<th><h4>CLASS_NO</h4></th>
	<th><h4>COURSE_NO</h4></th>
	<th><h4>SECTION_NO</h4></th>
	<th><h4>COURSE NAME</h4></th>
	<th><h4>TIME</h4></th>
	<th><h4>LOCATION</h4></th>
	<th><h4>INSTRUCTOR </h4></th> 
	<th><h4>DESCRIPTION</h4></th>
	</tr>
<?php 
while($row = mysql_fetch_assoc($result))
{
?>

	<tr>
	<td><?php print $row["CLASS_STATUS"];?></td>
	<td><?php print $row["SEMESTER"];?></td>
	<td><?php print $row["YEAR"];?></td>
	<td><?php print $row["CLASS_NO"];?></td>
	<td><?php print $row["COURSE_NO"];?></td>
	<td><?php print $row["SECTION_NO"];?></td>
	<td><?php print $row["COURSE_NAME"];?></td>
	<td> <?php print $row["LECTURE_DAY"];?> <?php print $row["CLASS_START_TIME"];?> <?php print $row["CLASS_END_TIME"];?></td>
	<td> <?php print     $row["CLASS_LOCATION"];?></td>
	<td><?php print $row["INSTRUCTOR_FNAME"];?> <?php print $row["INSTRUCTOR_LNAME"];?></td>
	<td><?php print $row["CDESCRIPTION"];?> <?php print "Number of Credit hours : "; print $row["CLASS_CREDIT_HOURS"];?></td>
	</tr>
<?php } ?>

</table>
<?php }}?>

</form>
</body>
</html>