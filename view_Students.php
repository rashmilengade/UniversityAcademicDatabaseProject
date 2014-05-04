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
        	<form method="get" name="view_students" action="view_Students.php" >
<table border="1">
	<tr>
		<td>SELECT</td>
		<td>CLASS NO</td>
		<td>SECTION NO</td>
		<td>COURSE NO</td>
		<td>COURSE NAME</td>
	</tr>
    <?php 
   $SSN = $_SESSION["SSN"];
   $fname = $_SESSION["fname"];
   $lname = $_SESSION["lname"];
  echo "Welcome ".$fname." ".$lname;?> 
 <p><a href = "login.php">LOGOUT</a> 
<br/><br/>

  <?php 
  $query1 = "SELECT S.SECTIONID AS SECTIONID,S.SECTIONNO AS SECTIONNO,S.COURSEID AS COURSEID,C.COURSENAME AS COURSENAME 
			FROM SECTION S,COURSE C 
			WHERE C.COURSEID = S.COURSEID AND S.INSTRUCTORSSN = '".$SSN."'";

   if(!empty($query1)){
   
   	$result1 = mysql_query($query1);
   	while($row1 = mysql_fetch_assoc($result1)) {
   		?>
   			
   					<tr>
   						 <td><input type="checkbox" name="selectedSection[]" value="<?php print $row1['SECTIONID']?>"/></td>
   						<td><?php print $row1['SECTIONID']?></td>
   					    <td><?php print $row1['SECTIONNO']?> </td>
   					   <td><?php print $row1['COURSEID']?> </td>
   					   <td><?php print $row1['COURSENAME']?> </td>
   					    
   					</tr>    	
   					<?php }} 
   					?>
   		
   	

	</table>
	
	<br/>
<input type="submit" name="btnViewStudents" value="View Students" />

<br/>
<br/>

<?php 
			if(!empty($_GET["selectedSection"]))
			{
									$selectedSection = $_GET["selectedSection"];
								if(sizeof($selectedSection) > 0 )
								{
										for($i = 0; $i<sizeof($selectedSection) ; $i++)
										{
											
											
											$sQuery = "SELECT G.SID AS SID,S.FNAME AS FNAME,S.LNAME AS LNAME 
														FROM GRADE_REPORT G,STUDENT S WHERE G.SID = S.SID AND G.SECTIONID ='".$selectedSection[$i]."'";
											
											$result1=mysql_query($sQuery);
											
											?>
											<table border="1">
											<tr>
												<td>SID</td>
												<td>NAME</td>
											</tr>
										<?php 	while($row = mysql_fetch_assoc($result1)) {
											?>
											<tr>
											<td><?php print $row['SID']?></td>
											<td><?php print $row['FNAME']?> <?php print $row['LNAME']?></td>
											</tr>
										<?php }}
								}
  					
			}?>
   
</table>


</form>
</body>
</html>
