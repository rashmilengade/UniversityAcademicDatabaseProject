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
<th>Thesis ID</th>
<th>Thesis Name</th>
<th>Thesis Description</th>
<th>Guide Name</th>
</tr>
<?php 
$SID= $_SESSION["SID"];
$query="SELECT T.THESISID AS THESISID,T.THESISNAME AS THESISNAME,T.THESISDESC AS THESISDESC,S.FNAME AS FNAME,S.LNAME AS LNAME 
 			FROM THESIS T,STAFF S 
 			WHERE T.SSN = S.SSN AND SID = '".$SID."'";
if(!empty($query))
{
	$result = mysql_query($query);
	while($row=mysql_fetch_assoc($result))
	{?>
		<tr>
		<td><?php print $row['THESISID']?></td>
		<td><?php print $row['THESISNAME']?></td>
		<td><?php print $row['THESISDESC']?></td>
		<td><?php print $row['FNAME']?> <?php print $row['LNAME']?></td>
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