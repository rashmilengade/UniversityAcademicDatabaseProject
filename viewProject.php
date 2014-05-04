<?php

	session_start();
 	/*	 Step #1: Open connection to the MySQL database */
	$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
	mysql_select_db("database_project") or die("Database not selected");     
	
?>
<html>
<head></head>
<body>
<h4>Project Details :</h4>
<table border = "1">
<tr>
<th>Project Name</th>
<th>Project Description</th>
</tr>
<?php 
$SID= $_SESSION["SID"];
$query="SELECT PROJECTNAME,PROJECTDESC FROM PROJECT WHERE SID = '".$SID."'";
if(!empty($query))
{
	$result = mysql_query($query);
	while($row=mysql_fetch_assoc($result))
	{?>
		<tr>
		<td><?php print $row['PROJECTNAME']?></td>
		<td><?php print $row['PROJECTDESC']?></td>
		</tr>
		
<?php	}
}
?>
</table>
<br/>
<br/>
<br/>
<a href = "mainStudent.php">BACK</a>
</body>
</html>