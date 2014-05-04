<?php

	session_start();
 	/*	 Step #1: Open connection to the MySQL database */
	$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
	mysql_select_db("database_project") or die("Database not selected");     
	
?>

<html>
<head>

<title>Students Registered for a given course</title>
</head>

    <body>
    <h1>WELCOME STAFF</h1><br/>




<h4> INFORMATION ABOUT THE STUDENTS REGISTERED IN A COURSE </h4> 
  
    	<form method="get" name="view_students" action="view_section.php" >
		<?php
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
	
		?>
		<table>
			
			<tr>
				<td>
					<label id="lblCourseNumber" title="Course Number" >Course Number</label>
				</td>
				<td>
					<input id="txtCourseNumber" name="courseNumber" type="text" size = "6"  value="<?php echo "$courseNumber";?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label id="lblSectionNumber" title="Section Number" >Section Number</label>
				</td>
				<td>
					<input id="txtSectionNumber" name="sectionNumber" type="text" size = "6" value="<?php echo "$sectionNumber";?>" />
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="btnViewStudents" value="View Students" />
				</td>
			</tr>
		</table>
		
		  
		    <?php
		  $where = "";
				if(!empty($courseNumber)){
					$where .= " AND  E.COURSEID LIKE '%". $courseNumber."%'";
				}
				if(!empty($sectionNumber)){
					$where .= " AND E.SECTIONNO = '".$sectionNumber."'";
				}
				//$netId	=	$_SESSION['netId'];
				//echo $netId;
			    $query = "SELECT G.SID AS SID,s.fname as FNAME,s.lname as LNAME,g.grade as GRADE,g.number_grade as NUMBER_GRADE
FROM grade_report G, STUDENT S, SECTION E
WHERE G.SID =S.SID AND G.SECTIONID = E.SECTIONID  
			    		"
						;
						
						
		    if(!empty($where)){
				$query .=  $where;
				
				
			

			if(!empty($query)){
				$result = mysql_query($query);}
			//echo $query;
			while($row = mysql_fetch_assoc($result)) {
		?>
		<table border="1">  
				<tr>
					<th>SID</th>
					<th>NAME</th>
				    <th>NUMBER_GRADE</th>
				    <th>GRADE</th>
				</tr>
				
				<tr>
					<td><?php print $row['SID']?></td>
				    <td><?php print $row['FNAME']?> <?php print $row['LNAME']?></td>
				    <td><?php print $row['NUMBER_GRADE']?></td>
				    <td><?php $row['GRADE'] != NULL ? print $row['GRADE'] : "0"?></td>
				</tr>    	
				<?php } }?>
				</table>
				
		
				</form>
    </body>

    
</html>
		  