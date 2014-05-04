<?php

session_start();
/*	 Step #1: Open connection to the MySQL database */
$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
mysql_select_db("database_project") or die("Database not selected");

?>

<html>
<head>

<title>Update grade of Students in a course</title>
</head>

    <body>
        	<form method="get" name="updateGrade" action="updateGrade.php" >
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
<a href = "login.php">LOGOUT</a> 
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
											
											
											$sQuery = "SELECT G.SID AS SID,S.FNAME AS FNAME,S.LNAME AS LNAME,G.NUMBER_GRADE AS NUMBER_GRADE,G.GRADE AS GRADE 
														FROM GRADE_REPORT G,STUDENT S WHERE G.SID = S.SID AND G.SECTIONID ='".$selectedSection[$i]."'";
											
											$result1=mysql_query($sQuery);
											
											?>
											<table border="1">
											<tr>
												<td>SELECT</td>
												<td>SID</td>
												<td>NAME</td>
												<td>NUMBER_GRADE</td>
												<td>GRADE</td>
											</tr>
										<?php 	while($row = mysql_fetch_assoc($result1)) {
											?>
											<tr>
											
											<td><?php print $row['SID']?></td>
											<td><?php print $row['FNAME']?> <?php print $row['LNAME']?></td>
											<td><input id="numberGrade" name="numberGrade" type="text" value="<?php print $row['NUMBER_GRADE']?>"/></td>
											<td><input id="grade" name="grade" type="text" value="<?php print $row['GRADE']?>"/></td>
											<td><input type="checkbox" name="selectedSection1[]" value="<?php print $row["SID"].",".$_GET["numberGrade"].",".$_GET["grade"]?>"/></td>
											</tr>
										<?php }}
								}?>
								
	
   
</table>

<input type="submit" value="UPDATE">
<?php		}?>
<?php 			if(!empty($_GET["selectedSection1"]))
			{
									$selectedSection1 = $_GET["selectedSection1"];
									
									
								if(sizeof($selectedSection1) > 0 )
								{
										for($i = 0; $i<sizeof($selectedSection1) ; $i++)
										{
											
											echo $selectSection1[$i];
											$x = explode(",",$selectedSection1[$i]);
											echo $x[0];
											echo $x[1];
											echo $x[2];
											$sQuery = "UPDATE GRADE_REPORT SET NUMBER_GRADE = '".$x[1]."',GRADE = '".$x[2]."' WHERE SID = '".$x[0]."'";
											
											$result1=mysql_query($sQuery);
											if(!empty($result1))
											{
												echo "Grades updated..!!";
											}
										}}
								}
?>
</form>
</body>
</html>
