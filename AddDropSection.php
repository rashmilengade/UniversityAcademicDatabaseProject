<html>
<head><title>DROP YOUR SECTION</title></head>
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
		
	<form method="get" name="Drop_form" action="AddDropSection.php" >	

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
                        if(array_key_exists("selectedSection", $_GET)){
                                $selectedSection[] = $_GET["selectedSection"];
                        }else{
                                $selectedSection[] = "";
                        }
                        
?>
                        		
	
	
        <?php                 
                        if(!empty($SID))
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
                        			
                        		
                        	
                        			if(mysql_num_rows($result) > 0) {
	?>
		
		<table>
		<tr>
		<th>CHECK</th>
		<th>STUDENT NAME</th>
		<th>CLASS NO </th>
		<th>COURSE NO</th>
		<th>SECTION NO</th>
		<th>ROOM</th>
		<th>DAY TIME</th>
		<th>INSTRUCTOR</th>
		</tr>
		<?php

		while($row = mysql_fetch_assoc($result)) { ?>
                <tr>
		                                                       <td><input type="checkbox" name="selectedSection[]" value="<?php print $row['SECTIONID'].",".$row['SID']?>"/></td>
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
	
                  <?php }}}}
                        
								if(!empty($_GET["selectedSection"])){
									$selectedSection = $_GET["selectedSection"];
									echo sizeof($selectedSection);
								if(sizeof($selectedSection) > 0 )
								{
									echo "hello";	
									for($i = 0; $i<sizeof($selectedSection) ; $i++)
										{
											echo $selectedSection[$i];
											$value = explode(",", $selectedSection[$i]);
											echo $value[0];
											echo $value[1];
											$dQuery = "DELETE FROM GRADE_REPORT WHERE  SECTIONID = '".$value[0]."' AND SID = '".$value[1]."'";
											echo $dQuery;
											mysql_query($dQuery);
											
											echo "Course Dropped..!!";
											
										}
								}
  						}
		   ?>
                        	

<p>	<input type="submit" name="Drop" value="Drop" /> </p>
	

<p>
<a href = "mainStudent.php">BACK</a>
</p>
</form>	
</body>
</html>