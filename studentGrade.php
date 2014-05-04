<html>
<head><title>VIEW YOUR GRADES</title></head>
<body>

<?php
	
		session_start();
		$link = mysql_connect('localhost', 'root', 'lakers');
		mysql_select_db("database_project") or die("Cannot select the database");     
		$SID= $_SESSION["SID"];
		$fname = $_SESSION["fname"];
		$lname = $_SESSION["lname"];
		echo "WELCOME ".$fname." ".$lname;
		 ?>
		
	<form method="get" name="Drop_form" action="viewSchedule.php" >	

                        		
	
	
        <?php                 
                        if(!empty($SID))
                        {
                        	$result=doquery($SID);
                        	queryresults($result);
                        }
                        
		   ?>
                        	


	
	<?php 
	function doquery($SID)
	{
				
			$query = "SELECT S.COURSEID AS COURSEID,S.SECTIONNO AS SECTIONNO,C.COURSENAME AS COURSENAME,G.NUMBER_GRADE AS NUMBER_GRADE,G.GRADE AS GRADE
                                		FROM GRADE_REPORT G,SECTION S,COURSE C
                                		WHERE	G.SECTIONID = S.SECTIONID AND S.COURSEID = C.COURSEID AND G.SID = '".$SID."'";
				
			if(!empty($query))
			{
					$result = mysql_query($query);
					if(!empty($result))
					{
						return($result);
					}
			}
		
		
	}
	
	function queryresults($result)
	{
		if(mysql_num_rows($result) > 0) {
	?>
		
		<table border = "1" align = "centre">
		<tr>
		
			<th>COURSE NO</th>
			<th>SECTION NO </th>
			<th>COURSE NAME</th>
			<th>MARKS</th>
			<th>GRADE</th>
		</tr>
		<?php

		while($row = mysql_fetch_assoc($result)) { ?>
                <tr>
		                                                      
		                                                        <td><?php print $row['COURSEID']?> </td>
		                                                        <td><?php print $row['SECTIONNO']?></td>
		                                                        <td><?php print $row['COURSENAME']?></td>
		                                                        <td><?php print $row['NUMBER_GRADE']?></td>
		                                                        <td><?php print $row['GRADE']?></td>
		                                                      </tr>
		                               
		<?php }?>
		</table>
<?php }}?>	
<p>
<a href = "mainStudent.php">BACK</a>
</p>
</form>	
</body>
</html>