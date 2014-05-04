<html>
<head><title>VIEW YOUR SECTION</title></head>
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
                        
                        if(array_key_exists("semester", $_GET)){
                        	$semester = $_GET["semester"];
                        }else{
                        	$semester = "";
                        }
                        if(array_key_exists("year", $_GET)){
                                $year = $_GET["year"];
                        }else{
                                $year = "";
                        }
                       
?>
                        		
	
	
        <?php                 
                        if(!empty($SID))
                        {
                        	$result=doquery($SID,$_GET["semester"],$year);
                        	queryresults($result);
                        }
                        
		   ?>
                        	


	
	<?php 
	function doquery($SID,$semester,$year)
	{
		if(!empty($SID))
		{
				
			$valid = "true";
			if($valid == "true")
			{
				$where = "";
				
				if(!empty($_GET["semester"])){
					$where .= " AND S.SEMESTER   = '".$_GET["semester"]."'";
				}
				if(!empty($year)){
					$where .= " AND S.YEAR = '".$year."'";
				}
		
				$query = "SELECT G.SID AS SID, T.FNAME AS TFNAME,T.LNAME AS TLNAME,S.SECTIONID AS SECTIONID,S.COURSEID AS COURSEID,S.SECTIONNO AS SECTIONNO,S.LOCATION AS LOCATION,S.LECTURE_DAY AS LECTURE_DAY,S.START_TIME AS START_TIME,S.END_TIME AS END_TIME,F.FNAME AS FFNAME, F.LNAME AS FLNAME
                                		FROM GRADE_REPORT G,STUDENT T,SECTION S,STAFF F
                                		WHERE	G.SID = T.SID AND G.SECTIONID = S.SECTIONID AND S.INSTRUCTORSSN = F.SSN AND G.SID = '".$SID."'";
				if(!empty($where))
				{
					$query .=  $where;
					 
					if(!empty($query))
					{
						$result = mysql_query($query);
					}
				}
			}
		}
		if(!empty($result))
		{
			return($result);
		}
}
		
		
	
	
	function queryresults($result)
	{
		if(mysql_num_rows($result) > 0) {
	?>
		
		<table border = "1">
		<tr>
		
		<th>STUDENT NAME</th>
		<th>CLASS NO </th>
		<th>COURSE NO</th>
		<th>SECTION NO</th>
		<th>ROOM</th>
		<th>DAY/TIME</th>
		<th>INSTRUCTOR</th>
		</tr>
		<?php

		while($row = mysql_fetch_assoc($result)) { ?>
                <tr>
		                                                      
		                                                        <td><?php print $row['TFNAME']?> <?php print $row['TLNAME']?></td>
		                                                        <td><?php print $row['SECTIONID']?></td>
		                                                        <td><?php print $row['COURSEID']?></td>
		                                                        <td><?php print $row['SECTIONNO']?></td>
		                                                        <td><?php print $row['LOCATION']?></td>
		                                                        <td><?php print $row['LECTURE_DAY']?> <?php print $row['START_TIME']?> <?php print $row['END_TIME']?></td>
		                                                        <td><?php print $row['FFNAME']?> <?php print $row['FLNAME']?></td>
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