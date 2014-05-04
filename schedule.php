<html>
<head><title>SEARCH YOUR SECTION</title></head>
<body>
	<?php
	
		session_start();
		$link = mysql_connect('localhost', 'root', 'lakers');
		mysql_select_db("database_project") or die("Cannot select the database");     
		$fname = $_SESSION["fname"];
		$lname = $_SESSION["lname"];
		$SID = $_SESSION["SID"];
				echo "WELCOME ".$fname." ".$lname;  ?>
	

<h3>CLASS SCHEDULE</h3>
		
	
<form method="get" name="addDropSection_form" action="AddDropSection.php" >

<?php
			if(array_key_exists("studentId", $_GET)){
				$SID = $_GET["studentId"];
			}else{
				$SID = "";}
			if(array_key_exists("year", $_GET)){
				$year = $_GET["year"];
			}else{
				$year = "";
			}
?>
<table>
			
			<tr>
				<td>
					<label id="lblYear" title="Year" ><b>Year</b></label>
				</td>
				<td>
					<input id="txtYear" name="year" type="text" value="<?php echo "$year";?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="semester" value="FALL">FALL
				</td>
				<td>
					<input type="radio" name="semester" value="SPRING">SPRING
				</td>
				<td>
					<input type="radio" name="semester" value="SUMMER">SUMMER
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="schedule" value="My Class Schedule" />
				</td>
			</tr>
		</table>
	
</form>
</body>
</html>